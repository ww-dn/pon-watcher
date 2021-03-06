<?php
function get_status_onu($last_laser_onu) {
    $status_onu = "";
    if ($last_laser_onu == "-6553.5" OR $last_laser_onu == "0") {
        $status_onu = "<span class='uk-label uk-label-danger'>down</span>";
    }
    else {
        $status_onu = "<span class='uk-label uk-label-success'>up</span>";
    }
    return $status_onu;
}

function backup_fs() {
  $scr_arch = "cd " . $_SERVER['DOCUMENT_ROOT'] . " && tar -cvzf " . $_SERVER['DOCUMENT_ROOT'] . "/backup/files_" . date("Ymd-Hi") . ".tar.gz --exclude=./backup .";
  exec($scr_arch);
  $ls = ls_backup_dir();
  return $ls;
}

function backup_db() {
  //$scr_arch = "cd " . $_SERVER['DOCUMENT_ROOT'] . " && tar -cvzf " . $_SERVER['DOCUMENT_ROOT'] . "/backup/" . date("Ymd_Hi") . ".tar.gz --exclude=./backup .";
  $scr_arch = "mysqldump -u " . MY_USERNAME . " -p" . MY_PASSWORD . " " . MY_DB . " | gzip > " . $_SERVER['DOCUMENT_ROOT'] . "/backup/base_" . date("Ymd-Hi") . ".sql.gz";
  exec($scr_arch);
  $ls = ls_backup_dir();
  return $ls;
}

function ls_backup_dir() {
  $directory = $_SERVER['DOCUMENT_ROOT'] . "/backup/" ;
  $scanned_directory = array_diff(scandir($directory), array('..', '.', '.htaccess'));
  foreach ($scanned_directory as $val) {
    $ls .= $val."<br>";
  }
  return $ls;
}

function mac210($mac) {
  $mac_ar = explode(":", $mac);
  $mac10 = "";
  foreach ($mac_ar as $val) {
    $mac10 .= ".".hexdec($val);
  }
  return $mac10;
}

/*
## ------ SNMP BDCOM --------------------------
function get_id_onu($oltip, $snmppas) {
  $id_onu = snmprealwalk($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.10.1.1.26');
  return $id_onu;
}
function get_mac_onu($oltip, $snmppas, $uidonu) {
  $mac_onu = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.10.1.1.3.'.$uidonu);
  $mac_onu = explode(':', $mac_onu);
  $mac_onu = end($mac_onu);
  $mac_onu = trim($mac_onu);
  $mac_onu = str_replace (" ", ":", $mac_onu);
  return $mac_onu;
}
function get_iface($oltip, $snmppas, $uidonu) {
  $iface_onu = snmpget($oltip, $snmppas, '.1.3.6.1.2.1.2.2.1.2.'.$uidonu);
  $iface_onu = explode(' ', $iface_onu);
  $iface_onu = end($iface_onu);
  $iface_onu = str_replace("\"", "", $iface_onu);
  return $iface_onu;
}
function get_onu_port_cooper($oltip, $snmppas, $uidonu) {
  $port_onu = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.12.1.1.8.'.$uidonu.'.1');
  $port_onu = explode('INTEGER: ', $port_onu);
  $port_onu = end($port_onu);
  return $port_onu;
}
function get_laser_level($oltip, $snmppas, $uidonu) {
  $laser_level = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.108.1.3.'.$uidonu);
  $laser_level = explode('INTEGER: ', $laser_level);
  $laser_level = end($laser_level);
  $laser_level = ($laser_level/10);
  return $laser_level;
}

function reboot_onu($oltip, $snmppas, $uidonu) {
  $rebootonu = snmpset($oltip, $snmppas, '1.3.6.1.4.1.3320.101.10.1.1.29.'.$uidonu, 'i', '0');
}

function reboot_olt($oltip, $snmppas) {
  $rebootonu = snmpset($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.184.7.0', 'i', '1');
}
*/
?>