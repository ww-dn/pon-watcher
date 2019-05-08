<?php
## ------ SNMP BDCOM --------------------------
function bdcom_get_id_onu($oltip, $snmppas) {
  $id_onu = snmprealwalk($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.10.1.1.26');
  return $id_onu;
}
function bdcom_get_mac_onu($oltip, $snmppas, $uidonu) {
  $mac_onu = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.10.1.1.3.'.$uidonu);
  $mac_onu = explode(':', $mac_onu);
  $mac_onu = end($mac_onu);
  $mac_onu = trim($mac_onu);
  $mac_onu = str_replace (" ", ":", $mac_onu);
  return $mac_onu;
}
function bdcom_get_iface($oltip, $snmppas, $uidonu) {
  $iface_onu = snmpget($oltip, $snmppas, '.1.3.6.1.2.1.2.2.1.2.'.$uidonu);
  $iface_onu = explode(' ', $iface_onu);
  $iface_onu = end($iface_onu);
  $iface_onu = str_replace("\"", "", $iface_onu);
  return $iface_onu;
}
function bdcom_get_onu_port_cooper($oltip, $snmppas, $uidonu) {
  $port_onu = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.12.1.1.8.'.$uidonu.'.1');
  $port_onu = explode('INTEGER: ', $port_onu);
  $port_onu = end($port_onu);
  return $port_onu;
}
function bdcom_get_laser_level($oltip, $snmppas, $uidonu) {
  $laser_level = snmp2_get($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.108.1.3.'.$uidonu);
  $laser_level = explode('INTEGER: ', $laser_level);
  $laser_level = end($laser_level);
  $laser_level = (int) $laser_level;
  $laser_level = ($laser_level/10);
  return $laser_level;
}

function bdcom_reboot_onu($oltip, $snmppas, $uidonu) {
  $rebootonu = snmpset($oltip, $snmppas, '1.3.6.1.4.1.3320.101.10.1.1.29.'.$uidonu, 'i', '0');
}

function bdcom_reboot_olt($oltip, $snmppas) {
  $rebootonu = snmpset($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.184.7.0', 'i', '1');
}

function bdcom_save_config($oltip, $snmppas) {
  snmpset($oltip, $snmppas, '.1.3.6.1.4.1.3320.20.15.1.1.0', 'i', '1');
  snmpset($oltip, $snmppas, '.1.3.6.1.4.1.3320.20.15.1.1.0', 'i', '2');
}

function bdcom_get_num_sfp($oltip, $snmppas, $uidonu) {
  $iface_onu = bdcom_get_iface($oltip, $snmppas, $uidonu);
  $iface_opt = explode(":", $iface_onu);
  $iface_opt = reset($iface_opt);
  $get_range_port = snmprealwalk($oltip, $snmppas, '.1.3.6.1.2.1.2.2.1.2');
  $num_opt_port = "";
  foreach ($get_range_port as $key => $val) {
    $nam_opt_port_t = explode(' ', $val);
    $nam_opt_port = end($nam_opt_port_t);
    $nam_opt_port = str_replace("\"", "", $nam_opt_port);
    if ( $nam_opt_port == $iface_opt ){
      $num_opt_port = explode('.', $key);
      $num_opt_port = end($num_opt_port);
      break;
    }
  }
  return $num_opt_port;
}

function bdcom_unbind_onu($oltip, $snmppas, $num_opt_port, $mac_onu10) {
  $unb = snmpset($oltip, $snmppas, '.1.3.6.1.4.1.3320.101.11.1.1.2.'.$num_opt_port.$mac_onu10, 'i', '0');
}

function bdcom_olt_uptime($oltip, $snmppas) {
  $uptime = snmpget($oltip, $snmppas, '.1.3.6.1.2.1.1.9.1.4.1');
  $uptime = explode('Timeticks: ', $uptime);
  $uptime = end($uptime);
  return $uptime;
}

function bdcom_olt_temp($oltip, $snmppas) {
  $temp = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.181.1.1.7.1');
  $temp = explode('INTEGER: ', $temp);
  $temp = end($temp);
  return $temp;
}

function bdcom_olt_cpu5m ($oltip, $snmppas) {
  $cpu5m = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.109.1.1.1.1.5.1');
  $cpu5m = explode('Gauge32: ', $cpu5m);
  $cpu5m = end($cpu5m);
  return $cpu5m;
}

function bdcom_olt_cpu1m ($oltip, $snmppas) {
  $cpu1m = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.109.1.1.1.1.4.1');
  $cpu1m = explode('Gauge32: ', $cpu1m);
  $cpu1m = end($cpu1m);
  return $cpu1m;
}

function bdcom_olt_cpu5s ($oltip, $snmppas) {
  $cpu5s = snmpget($oltip, $snmppas, '.1.3.6.1.4.1.3320.9.109.1.1.1.1.3.1');
  $cpu5s = explode('Gauge32: ', $cpu5s);
  $cpu5s = end($cpu5s);
  return $cpu5s;
}

function bdcom_olt_sysinfo ($oltip, $snmppas) {
  $sysinfo = snmpget($oltip, $snmppas, '.1.3.6.1.2.1.1.1.0');
  $sysinfo = explode('STRING: ', $sysinfo);
  $sysinfo = end($sysinfo);
  return $sysinfo;
}
?>