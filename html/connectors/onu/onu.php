<?php
if (isset($_GET['p']) AND $_GET['p'] == '22') {
  if (isset($_GET['onuid'])) {
    $query = new dbmysql();
    $query_onu = new dbmysql();
    $select_olt = $query->result("SELECT * FROM `olts` WHERE `id` = '".$_GET['oltid']."'");
    $row_olt = Array();
    $row_olt = $query->fetch_assoc($select_olt);
    $select_onu = $query_onu->result("SELECT onu.id as oid, onu.id_olt, onu.uidonu, onu.iface, onu.mac, onu.boxid, onu.roz, onu.last_laser_lvl, onu.lat as olat, onu.lon as olon, boxs.id as bid, boxs.num_box, boxs.sum_roz, boxs.lat as blat, boxs.lon as blon FROM `onu`,`boxs` WHERE `onu`.`id_olt` = ".$_GET['oltid']." AND `onu`.`uidonu` = ".$_GET['onuid']." AND `boxs`.`id` = `onu`.`boxid`");
    $row_onu = Array();
    $row_onu = $query_onu->fetch_assoc($select_onu);
    $port_cooper_onu = get_onu_port_cooper(long2ip($row_olt['ip']), $row_olt['snmppas'], $_GET['onuid']);
    $laser_level = get_laser_level(long2ip($row_olt['ip']), $row_olt['snmppas'], $_GET['onuid']);
    
    if ($row_onu['olat'] == '') {
        $onu_lat = MAPS_DEF_LAT;
    }
    else {
        $onu_lat = $row_onu['olat'];
    }
    
    if ($row_onu['olon'] == '') {
        $onu_lon = MAPS_DEF_LON;
    }
    else {
        $onu_lon = $row_onu['olon'];
    }
    
    echo "<div class='uk-card uk-card-body'><a href='javascript:history.back()' class='uk-icon-button' uk-icon='icon: reply; ratio: 2' uk-tooltip='Вернуться назад'> </a></div>";
    echo "<div class='uk-card uk-card-default uk-card-hover uk-margin'>";
    echo "<div class='uk-card-body'>";
    echo "<b>MAC:</b> ".$row_onu['mac']."<br>";
    echo "<b>Медный порт:</b> ";
    if ($port_cooper_onu == "1") {
      echo "<span uk-icon='server' class='uk-text-success'> UP </span><br>";
    }
    else {
      echo "<span uk-icon='server' class='uk-text-danger'> DOWN </span><br>";
    }
    echo "<b>Опт. уровень:</b> " . $laser_level . " dBm <br>";
    echo "<b>Муфта:</b> " . $row_onu['num_box'] . "<br>";
    echo "<b>Розетка:</b> " . $row_onu['roz'] . "<br>";
    echo "</div> <div class='uk-card-footer'>";
    echo "<a href='/connectors/onu/onu.php?reboot&uid=" . $_GET['onuid'] . "&oltip=" . long2ip($row_olt['ip']) . "&snmppas=" . $row_olt['snmppas'] . "&oltid=" . $row_olt['id'] . "' uk-icon='icon: refresh; ratio: 2' uk-tooltip='Перезагрузить ONU'></a>";
    echo "</div></div>";
################
    echo "<div class='uk-card'>";
    echo "<button class='uk-button uk-button-default uk-margin-right' uk-toggle='target: #modalMap'><span uk-icon='location'></span> Посмотреть на карте</button>";
    echo "<button class='uk-button uk-button-default' uk-toggle='target: #modalBox'><span uk-icon='social'></span> Разместить в муфте</button>";
    echo "</div>";
### Окно карты
?>

<!-- Modal map -->
<div id="modalMap" uk-modal>
  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Карта расположения</h5>
    </div>
    <div class="uk-modal-body"> 
      <div class="uk-margin" id="map"></div>
    </div>
    <div class="uk-modal-footer">
    </div>
  </div>
</div>

<!-- Modal box -->
<div id="modalBox" uk-modal>
  <div class="uk-modal-dialog">
  <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Бокс</h5>
    </div>
    <div class="uk-modal-body">
        <form id="box" method="POST" action="/connectors/boxs/boxs_conf.php">
          <input type="hidden" name="boxolt">
          <input type="hidden" name="idonu" value="<?=$row_onu['oid']?>">
          <input type="hidden" name="uidonu" value="<?=$row_onu['uidonu']?>">
          <input type="hidden" name="idolt" value="<?=$row_onu['id_olt']?>">
          <div class="uk-margin">
          <label class="uk-form-label" for="numBox">Номер бокса</label>
          <div class="uk-form-controls">
          <select id="numBox" class="uk-select uk-form-width-small" name="numbox">
          <?php
            $query_box = new dbmysql();
            $select_box = $query_box->result("SELECT * FROM `boxs`");
            $num_row_boxs = $query->fetch_row();
            if ($num_row_boxs > '0') {
              $row_box = Array();
              while (is_array($row_box = $query_box->fetch_assoc($select_box))) {
                if ($row_box['id'] == $row_onu['boxid']) {
                  echo "<option selected value='".$row_box['id']."'>".$row_box['num_box']."</option>";
                }
                else {
                  echo "<option value='".$row_box['id']."'>".$row_box['num_box']."</option>";
                }
              }
            }
          ?>
            
          </select>
          </div>
        </div>
        <div class="uk-margin">
          <label for="numRoz" class="uk-form-label">Розетка</label>
          <div class="uk-form-controls">
          <input type="text" class="uk-input uk-form-width-small" id="numRoz" name="numroz" value="<?=$row_onu['roz']?>">
          </div>
        </div>
        </form>
      </div>
      <div class="uk-modal-footer">
        <button type="submit" form="box" class="uk-button uk-button-default">Сохранить</button>
      </div>
  </div>
</div>

<?php
include (dirname(dirname(dirname(__FILE__))) . '/core/maps/' . MAPS . '/map_onu.php');
}
  else {
    echo "Не выбрана ONU";
  }
}

else if (isset($_GET['reboot'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/function.php');
  reboot_onu($_GET['oltip'], $_GET['snmppas'], $_GET['uid']);
  header("Location: /?p=22&oltid=".$_GET['oltid']."&onuid=".$_GET['uid']);
}

else {
  echo "<h2>Прямой доступ к странице запрещен</h2>";
}
?>