<?php
$query = new dbmysql();

$select_olts = $query->result("SELECT * FROM olts");
$num_rows = $query->fetch_row($select_olts);
echo "<br>";
if ($num_rows > "0") {
    $row=Array();
    echo "<div class='uk-flex'>";
    while (is_array($row = $query->fetch_assoc($select_olts))) {
      echo "<a href='/?p=21&oltid=".$row['id']."'>";
      echo "<div class='uk-card uk-card-default uk-card-body uk-card-hover uk-margin-left uk-text-center'>";
      echo "<h6>".$row['name']."</h6>";
      echo long2ip($row['ip']);
      echo "</div></a>";
    }
    echo "</div>";
}
?>