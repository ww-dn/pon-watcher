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

?>