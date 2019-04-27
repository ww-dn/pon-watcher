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

?>