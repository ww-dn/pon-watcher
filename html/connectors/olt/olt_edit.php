<?php
@include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
@include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_olt_edit = new dbmysql();
  $select_olt_edit = $query_olt_edit->result("SELECT * FROM `olts` WHERE `id`=".$_GET['id']);
  $num_rows_olt_edit = $query_olt_edit->fetch_row($select_olt_edit);
  
  $row_olt_edit = Array();
  $row_olt_edit = $query_olt_edit->fetch_assoc($select_olt_edit);
  ?>

<div class="uk-modal-dialog">
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Изменить настройки OLT-а</h5>  
    </div>
    <div class="uk-modal-body">
        <form id="editolt" method="POST" action="/connectors/olt/olts_conf.php">
        <input type="hidden" name="edit">
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Имя" id="nameOlt" name="nameolt" value="<?=$row_olt_edit['name']?>">
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="IP" id="ip" name="ipolt" value="<?=long2ip($row_olt_edit['ip'])?>">
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Размещение" id="location" name="locationolt" value="<?=$row_olt_edit['location']?>">
        </div>
        <div class="uk-margin">
          <select id="vendor" class="uk-select uk-form-width-small" name="vendorolt">
            <option selected value="bdcom">bdcom</option>
          </select>
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="snmp password" id="snmp" name="snmppassolt" value="<?=$row_olt_edit['snmppas']?>">
        </div>
        </form>
        <div class="uk-margin"></div>
    </div>
    <div class="uk-modal-footer">
        <button type="submit" form="editolt" class="uk-button uk-button-default">Изменить</button>
        <button type="button" class="uk-modal-close-default" uk-close>Закрыть</button>
    </div>
  </div>  
?>