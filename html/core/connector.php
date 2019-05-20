<?php

if (!isset($_GET['p'])) {
    include(CONNECTORS_PATH . '/main.php');
}
else if ($_GET['p'] == '11') {
    include(CONNECTORS_PATH . '/olt/olts_conf.php');
}
else if ($_GET['p'] == '21') {
    include(CONNECTORS_PATH . '/olt/olt.php');
}
else if ($_GET['p'] == '22') {
    include(CONNECTORS_PATH . '/onu/onu.php');
}
else if ($_GET['p'] == '31') {
    include(CONNECTORS_PATH . '/boxs/boxs.php');
}
else if ($_GET['p'] == '32') {
    include(CONNECTORS_PATH . '/boxs/boxs_conf.php');
}
else if ($_GET['p'] == '41') {
    include(CONNECTORS_PATH . '/backup/backup.php');
}
else if ($_GET['p'] == '42') {
    include(CONNECTORS_PATH . '/update/upd.php');
}
else if ($_GET['p'] == '51') {
    include(CONNECTORS_PATH . '/calc/calc.php');
}

?>