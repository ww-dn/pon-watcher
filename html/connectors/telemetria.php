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
$q_find_onu = new dbmysql();
$q_insert = new dbmysql();
$select_olt = $query->result("SELECT * FROM olts");
$num_row_onu = $query->fetch_row();
if ($num_row_onu >= '1') {
$row_olt = Array();
while (is_array($row_olt = $query->fetch_assoc($select_olt))) {
include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt['vendor'] . ".function.php");
$olt_ip = long2ip($row_olt['ip']);
$get_id_onu = $row_olt['vendor']."_get_id_onu";
$get_iface = $row_olt['vendor']."_get_iface";
$get_mac_onu = $row_olt['vendor']."_get_mac_onu";
$ids_onu = $get_id_onu($olt_ip, $row_olt['snmppas']);  
if (count($ids_onu) > 0) {
  foreach($ids_onu as $key => $type) {
    $id_onu = explode('10.1.1.26.', $key);
    $id_onu = end($id_onu); // Узнаем id интерфейса на OLT-e
    $iface = $get_iface($olt_ip, $row_olt['snmppas'], $id_onu); // Узнаем интерфейс онушки на ОЛТе
    $mac = $get_mac_onu($olt_ip, $row_olt['snmppas'], $id_onu); // Узнаем MAC
    $select_uidonu = $q_find_onu->result("SELECT `id`, `uidonu` FROM `onu` WHERE `uidonu` = '".$id_onu."'");
    $num_row = $q_find_onu->fetch_row($select_uidonu);
    //print_r($num_row);
    if ($num_row == '0') {
      $insert_new_onu = $q_insert->result("INSERT INTO onu (id_olt, uidonu, iface, mac) VALUES ('".$row_olt['id']."', '".$id_onu."', '".$iface."', '".$mac."')");
    }
  }
  echo "OK";
}
}
}
}
if (isset($_GET['f']) AND $_GET['f'] == 'ping') {
  $query = new dbmysql();
  $q_onu_select = new dbmysql();
  $query_update = new dbmysql();
  $select_olt = $query->result("SELECT * FROM `olts`");
  $num_row_olt = $query->fetch_row();
  if ($num_row_olt >= '1') {
  $row_olt = Array();
  while (is_array($row_olt = $query->fetch_assoc($select_olt))) {
    print_r($row_olt['id']);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt['vendor'] . ".function.php");
    $select_onu = $q_onu_select->result("SELECT * FROM `onu` WHERE `id_olt` = ".$row_olt['id']);
    $num_row_onu = $q_onu_select->fetch_row();
    $olt_ip = long2ip($row_olt['ip']);
    $get_laser_level = $row_olt['vendor']."_get_laser_level";
    if ($num_row_onu >= '1') {
      $row_onu = Array();
      while (is_array($row_onu = $q_onu_select->fetch_assoc($select_onu))) {
        $laser_level = $get_laser_level($olt_ip, $row_olt['snmppas'], $row_onu['uidonu']);
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