<?php
if (isset($_GET['p']) AND $_GET['p'] == '31') {
  $query_boxs = new dbmysql();
  $select_boxs = $query_boxs->result("SELECT * FROM `boxs`");
  
  $num_row_boxs = $query_boxs->fetch_row($select_boxs);
  if ($num_row_boxs >= "0") {
    
?>
    
    <table class="table table-hover">
      <thead>
        <tr>
          <th>id</th>
          <th>№ муфты</th>
          <th>Кол-во роз.</th>
          <th>Координаты</th>
        </tr>
      </thead>
      <tbody>
    
<?php
    $row_boxs = Array();
    while (is_array($row_boxs = $query_boxs->fetch_assoc($select_boxs))) {
      echo "<tr>";
      echo "<td>".$row_boxs['id']."</td>";
      echo "<td>".$row_boxs['num_box']."</td>";
      echo "<td>".$row_boxs['sum_roz']."</td>";
      echo "<td>".$row_boxs['lat']." ".$row_boxs['lon']."</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }
}
else { 
  echo "Прямой доступ к странице запрещен!";
}
?>