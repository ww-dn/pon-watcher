<?php
if (isset($_POST['sfp'])) {
  $res = $_POST['sfp'];
  foreach ($_POST as $key => $val) {
    $res = $res - $val;
  }
  $res = $res + $_POST['fiber'];
  $res = $res + $_POST['sfp'];
  $res = $res + $_POST['meh'];
  
  $fiber = $_POST['fiber'] * 0.36;
  $meh = $_POST['meh'] * 0.5;
  $res = $res - $fiber - $meh;
  
  echo "Сигнал: $res";
}
?>