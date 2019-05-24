<?php
@include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
@include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
if (isset($_GET['info'])) {
  $query_olt_info = new dbmysql();
  $select_olt_info = $query_olt_info->result("SELECT * FROM `olts` WHERE `id`=".$_GET['id']);
  $num_rows_olt_info = $query_olt_info->fetch_row($select_olt_info);
  
  $row_olt_info = Array();
  $row_olt_info = $query_olt_info->fetch_assoc($select_olt_info);
  include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt_info['vendor'] . ".function.php");
  $olt_uptime = $row_olt_info['vendor']."_olt_uptime";
  $olt_temp = $row_olt_info['vendor']."_olt_temp";
  $olt_cpu = $row_olt_info['vendor']."_olt_cpu";
  $olt_sysinfo = $row_olt_info['vendor']."_olt_sysinfo";
?>
<div class="uk-modal-dialog">
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Информация OLT-а</h5>  
    </div>
    <div class="uk-modal-body">
    <div class="uk-description-list">
      <dt>Модель:</dt>
      <dd><?=$olt_sysinfo(long2ip($row_olt_info['ip']), $row_olt_info['snmppas'])?></dd>
      <dt>Uptime:</dt>
      <dd><?=$olt_uptime(long2ip($row_olt_info['ip']), $row_olt_info['snmppas'])?></dd>
      <dt>Температура платы:</dt>
      <dd><?=$olt_temp(long2ip($row_olt_info['ip']), $row_olt_info['snmppas'])?></dd>
      <dt>Загрузка CPU:</dt>
      <dd><?=$olt_cpu(long2ip($row_olt_info['ip']), $row_olt_info['snmppas'])?></dd>
    </div>
    </div>
    <div class="uk-modal-footer">
        <button type="button" class="uk-modal-close-default" uk-close>Закрыть</button>
    </div>
  </div> 
<?php
}
?>