<?php
if (isset($_GET['p']) AND $_GET['p'] == '11') {
$query = new dbmysql();
$select_olts = $query->result("SELECT * FROM olts");
$num_rows = $query->fetch_row($select_olts);
echo "<div class='uk-padding'>";
echo "<button class='uk-button uk-button-primary' type='button' uk-toggle='target: #modalAdd'>Добавить OLT</button>";
if ($num_rows > "0") {
    $row=Array();
    ?>
<table class="uk-table">
    <thead>
      <tr>
        <th>id</th>
        <th>ip</th>
        <th>Имя</th>
        <th>Локация</th>
        <th>Действия</th>
      </tr>
    </thead>
    <tbody>
    <?php
    while (is_array($row = $query->fetch_assoc($select_olts))) {
        echo "<tr>";
        echo "<th>".$row['id']."</th>";
        echo "<td>".long2ip($row['ip'])."</td>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['location']."</td>";
        echo "<td><a href='javascript:void(0);' onclick=\"openedit('".$row['id']."')\" uk-icon='icon: cog' uk-tooltip='Редактировать'></a>&nbsp; &nbsp;<a href='javascript:void(0);' onclick=\"saveconf('".$row['id']."')\" uk-icon='icon: cloud-upload' uk-tooltip='Сохранить'></a>&nbsp; &nbsp;<a href='javascript:void(0);' onclick=\"openreboot('".$row['id']."')\" uk-icon='icon: refresh' uk-tooltip='Reboot'></a>&nbsp; &nbsp;<a href='/connectors/olt/olts_conf.php?del&id=".$row['id']."' uk-icon='icon: trash' class='uk-text-danger' uk-tooltip='Удалить'></a></td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
<?php
}
?>
<!-- Modal add-->
<div id="modalAdd" uk-modal>
  <div class="uk-modal-dialog">
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Добавить OLT</h5>  
    </div>
    <div class="uk-modal-body">
        <form id="addolt" method="POST" action="/connectors/olt/olts_conf.php">
        <input type="hidden" name="add">
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Имя" id="nameOlt" name="nameolt">
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="IP" id="ip" name="ipolt">
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Размещение" id="location" name="locationolt">
        </div>
        <div class="uk-margin">
          <select id="vendor" class="uk-select uk-form-width-small" name="vendorolt">
            <option selected value="bdcom">bdcom</option>
          </select>
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="snmp password" id="snmp" name="snmppassolt">
        </div>
        </form>
        <div class="uk-margin"></div>
    </div>
    <div class="uk-modal-footer">
        <button type="submit" form="addolt" class="uk-button uk-button-default">Добавить</button>
        <button type="button" class="uk-modal-close-default" uk-close>Закрыть</button>
    </div>
  </div>
</div>


  <div id="loader" class="uk-flex-top" uk-modal="bg-close: false">
      <div class="uk-modal-dialog uk-margin-auto-vertical uk-padding-small uk-text-center">
        <div uk-spinner="ratio: 2"></div>
      </div>
  </div>  


<!-- Modal edit-->
<div id="oltEdit" uk-modal>

</div>

<div id="oltReboot" uk-modal>

</div>

<script>
function openedit(oltid) {
    var boxid = boxid,
        modal = UIkit.modal('#oltEdit', {
          escClose: false,
          bgClose: false
        });
    modal.show();
    $.ajax
    ({
      type: "GET",
      url: "/connectors/olt/olt_edit.php",
      data: {"edit":'1',"id":oltid},
      success: function(html) {
        $('#oltEdit').empty();
        $("#oltEdit").html(html);
      }
    });
  }

  function openreboot(oltid) {
    var boxid = boxid,
        modal = UIkit.modal('#oltReboot', {
          escClose: false,
          bgClose: false
        });
    modal.show();
    $.ajax
    ({
      type: "GET",
      url: "/connectors/olt/olt_edit.php",
      data: {"reboot":'1', "id":oltid},
      success: function(html) {
        $('#oltReboot').empty();
        $("#oltReboot").html(html);
      }
    });
  }

  function saveconf(oltid) {
    $.ajax
    ({
      type: "GET",
      url: "/connectors/olt/olts_conf.php",
      data: {"save":'1', "id":oltid},
      beforeSend: function() {
        UIkit.modal("#loader").show();
      },
      
      success: function(html) {
        toastr["success"]("Конфигурация сохранена!");
      },
      error: function(html) {
        toastr["error"]("Произошла ошибка при сохранении!");
      },
      complete: function() {
        UIkit.modal("#loader").hide();
      }
    });
  }
</script>
<?php
}

else if (isset($_POST['add'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_add = new dbmysql();
  $query_add->result("INSERT INTO `olts` (`ip`, `name`, `location`, `vendor`, `snmppas`) VALUES (INET_ATON('".$_POST['ipolt']."'), '".$_POST['nameolt']."', '".$_POST['locationolt']."', '".$_POST['vendorolt']."', '".$_POST['snmppassolt']."')");
  header("Location: /?p=11");
}

else if (isset($_POST['edit'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_add = new dbmysql();
  $query_add->result("UPDATE `olts` SET  `ip` = INET_ATON('".$_POST['ipolt']."'), `name` = '".$_POST['nameolt']."', `location` = '".$_POST['locationolt']."', `vendor` = '".$_POST['vendorolt']."', `snmppas` = '".$_POST['snmppassolt']."'");
  header("Location: /?p=11");
}

else if (isset($_GET['del'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_add = new dbmysql();
  $query_add->result("DELETE FROM `onu` WHERE `onu`.`id_olt` = ".$_GET['id']."");
  $query_add->result("DELETE FROM `olts` WHERE `olts`.`id` = ".$_GET['id']."");
  header("Location: /?p=11");
}

else if (isset($_POST['reboot'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $_POST['vend'] . ".function.php");
  $reboot_olt =  $_POST['vend']."_reboot_olt";
  $reboot_olt($_POST['oltip'], $_POST['snmppassoltreboot']);
  header("Location: /?p=11");
}

elseif (isset($_GET['save']) AND $_GET['save'] == '1') {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_olt_save = new dbmysql();
  $select_olt_save = $query_olt_save->result("SELECT * FROM `olts` WHERE `id`=".$_GET['id']);
  $num_rows_olt_save = $query_olt_save->fetch_row($select_olt_save);
  $row_olt_save = Array();
  $row_olt_save = $query_olt_save->fetch_assoc($select_olt_save);
  include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt_save['vendor'] . ".function.php");
  $save_config = $row_olt_save['vendor']."_save_config";
  $ret = $save_config(long2ip($row_olt_save['ip']), $row_olt_save['snmppas']);
  print_r($ret);
}

elseif (isset($_POST['unbindonu']) AND $_POST['unbindonu'] == '1') {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/function.php');
  $q_olt = new dbmysql();
  $q_onu = new dbmysql();
  $q_onu_del = new dbmysql();
  $select_olt = $q_olt->result("SELECT * FROM `olts` WHERE `id`=".$_POST['oltid']);
  $num_rows_olt = $q_olt->fetch_row($select_olt);
  $row_olt = Array();
  $row_olt = $q_olt->fetch_assoc($select_olt);
  include_once($_SERVER['DOCUMENT_ROOT'] . "/core/snmp/" . $row_olt['vendor'] . ".function.php");
  $select_onu = $q_onu->result("SELECT * FROM `onu` WHERE `uidonu` = ".$_POST['uidonu']." AND `id_olt` = ".$_POST['oltid']."");
  $row_onu = array();
  $row_onu = $q_onu->fetch_assoc($select_onu);
  $get_num_sfp = $row_olt['vendor']."_get_num_sfp";
  $unbind_onu = $row_olt['vendor']."_unbind_onu";
  $mac10 = mac210($row_onu['mac']);
  $num_sfp = $get_num_sfp(long2ip($row_olt['ip']), $row_olt['snmppas'], $row_onu['uidonu']);
  $unbind_onu(long2ip($row_olt['ip']), $row_olt['snmppas'], $num_sfp, $mac10);
  $q_onu_del->result("DELETE FROM `onu` WHERE `onu`.`id` = ".$row_onu['id']."");
}
?>