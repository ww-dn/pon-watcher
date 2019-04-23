<?php
if (isset($_GET['p']) AND $_GET['p'] == '21') {
  if (isset($_GET['oltid'])) {
    $query = new dbmysql();
    $query_olt = new dbmysql();
    $select_onus = $query->result("SELECT onu.id_olt, onu.uidonu, onu.iface, onu.mac, onu.boxid, onu.last_laser_lvl, boxs.id, boxs.num_box FROM `onu`, `boxs` WHERE `id_olt` = ".$_GET['oltid']." AND boxs.id = onu.boxid ORDER BY `onu`.`uidonu` ASC");
    $num_row_onu = $query->fetch_row($select_onus);
    
    if ($num_row_onu > "0") {
    $select_olt = $query_olt->result("SELECT * FROM `olts` WHERE `id` = ".$_GET['oltid']);
    $row_olt = $query_olt->fetch_assoc($select_olt);
    include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt['vendor'] . ".function.php");
    echo "<div class='d-flex flex-column'>";
    echo "<h3>" . $row_olt['name'] . " - " . long2ip($row_olt['ip']) . "</h3>";
    ?>
      <table class="uk-table uk-table-striped">
      <thead>
        <tr>
          <th>id</th>
          <th>Статус</th>
          <th>Интерфейс</th>
          <th>MAC</th>
          <th>№ муфты</th>
          <th>Уровень</th>
        </tr>
      </thead>
      <tbody>
    <?php
    $row_onu = Array();
    while (is_array($row_onu = $query->fetch_assoc($select_onus))) {
      echo "<tr>";
      echo "<th>".$row_onu['uidonu']."</th>";
      echo "<td>" . get_status_onu($row_onu['last_laser_lvl']) . "</td>";
      echo "<td>".$row_onu['iface']."</td>";
      echo "<td><a href='/?p=22&oltid=".$_GET['oltid']."&onuid=".$row_onu['uidonu']."'>".$row_onu['mac']."</a></td>";
      echo "<td>".$row_onu['num_box']."</td>";
      echo "<td>".$row_onu['last_laser_lvl']."</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    }
    else {
      echo "Нет данных.";
    }
  }
  else {
    echo "Не выбран OLT";
  }
}
else {
    echo "<h2>Прямой доступ к странице запрещен</h2>";
}
?>