<?php
############################
##
##  Опрос онушек на ОЛТ-ах
##
############################
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
@include(dirname(dirname(__FILE__)) . '/config.core.php');
@include(dirname(dirname(__FILE__)) . '/core/mysql.class.php');
@include(dirname(dirname(__FILE__)) . '/core/function.php');
if (isset($_GET['f']) AND $_GET['f'] == 'checknew') {
$query = new dbmysql();
$select_olt = $query->result("SELECT * FROM olts");
$num_row_onu = $query->fetch_row();
if ($num_row_onu >= '1') {
$row_olt = Array();
while (is_array($row_olt = $query->fetch_assoc($select_olt))) {
$ids_onu = get_id_onu(long2ip($row_olt['ip']), $row_olt['snmppas']);
if (count($ids_onu) > 0) {
  foreach($ids_onu as $key => $type) {
    $id_onu = explode('10.1.1.26.', $key);
    $id_onu = end($id_onu); // Узнаем id интерфейса на OLT-e
    $iface = get_iface(long2ip($row_olt['ip']), $row_olt['snmppas'], $id_onu); // Узнаем интерфейс онушки на ОЛТе
    $mac = get_mac_onu(long2ip($row_olt['ip']), $row_olt['snmppas'], $id_onu); // Узнаем MAC
    $select_uidonu = $query->result("SELECT `id`, `uidonu` FROM onu WHERE 'uidonu' = '".$id_onu."'");
    $num_row = $query->fetch_row($select_uidonu);
    if ($num_row == '0') {
      $insert_new_onu = $query->result("INSERT INTO onu (id_olt, uidonu, iface, mac) VALUES ('".$row_olt['id']."', '".$id_onu."', '".$iface."', '".$mac."')");
    }
  }
  echo "OK";
}
}
}
}
if (isset($_GET['f']) AND $_GET['f'] == 'ping') {
  $query = new dbmysql();
  $query_update = new dbmysql();
  $select_olt = $query->result("SELECT * FROM `olts`");
  $num_row_onu = $query->fetch_row();
  if ($num_row_onu >= '1') {
  $row_olt = Array();
  while (is_array($row_olt = $query->fetch_assoc($select_olt))) {
    $select_onu = $query->result("SELECT * FROM `onu` WHERE `id_olt` = ".$row_olt['id']);
    $num_row_onu = $query->fetch_row();
    if ($num_row_onu >= '1') {
      $row_onu = Array();
      while (is_array($row_onu = $query->fetch_assoc($select_onu))) {
        $laser_level = get_laser_level(long2ip($row_olt['ip']), $row_olt['snmppas'], $row_onu['uidonu']);
        $oltid = $row_olt['id'];
        $uidonu = $row_onu['uidonu'];
        $upd_laser_lvl = $query_update->result("UPDATE onu SET last_laser_lvl = '$laser_level' WHERE id_olt = $oltid AND uidonu = $uidonu");
      }
    }
  }
  }
}
if (isset($_POST['f']) AND $_POST['f'] == 'saveonupoint') {
    $savepoint = new dbmysql();
    $savetodb = $savepoint->result("UPDATE onu SET lat = '".$_POST['lat']."', lon = '".$_POST['lon']."' WHERE id_olt = '".$_POST['oltid']."' AND uidonu = '".$_POST['onuid']."'");
    if ($savetodb) {
        echo "Сохранено";
    }
}
if (isset($_POST['f']) AND $_POST['f'] == 'saveboxpoint') {
    $savepoint = new dbmysql();
    $savetodb = $savepoint->result("UPDATE boxs SET lat = '".$_POST['lat']."', lon = '".$_POST['lon']."' WHERE id = '".$_POST['boxid']."'");
    if ($savetodb) {
        echo "Сохранено";
    }
}
?>