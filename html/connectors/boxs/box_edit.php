<?php
@include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
@include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_box_edit = new dbmysql();
  $select_boxs_edit = $query_box_edit->result("SELECT * FROM `boxs` WHERE `id`=".$_GET['id']);
  $num_rows_box_edit = $query_box_edit->fetch_row($select_boxs_edit);
  
  $row_box_edit = Array();
  $row_box_edit = $query_box_edit->fetch_assoc($select_boxs_edit);
  if ($row_box_edit['lat'] == '') {
    $box_lat = MAPS_DEF_LAT;
  }
  else {
    $box_lat = $row_box_edit['lat'];
  }
    
  if ($row_box_edit['lon'] == '') {
    $box_lon = MAPS_DEF_LON;
  }
  else {
    $box_lon = $row_box_edit['lon'];
  }
?>

<div class="uk-modal-dialog">
<div class="uk-modal-header">
  <h5 class="uk-modal-title">Редактировать бокс № <?=$row_box_edit['num_box']?></h5>  
</div>
<div class="uk-modal-body">
  <form id="editbox" method="POST" action="/connectors/boxs/boxs_conf.php">
    <input type="hidden" name="edit">
    <input type="hidden" name="idbox" value="<?=$_GET['id']?>">
    <div class="uk-margin">
      <label class="uk-form-label" for="numRoz">Кол-во розеток</label>
      <div class="uk-form-controls">
        <input type="text" class="uk-input uk-form-width-medium" placeholder="Кол-во розеток" id="numRoz" name="numroz" value="<?=$row_box_edit['sum_roz']?>">
      </div>
    </div>
  </form>
  <div class="uk-margin" id="map"></div>
</div>
<div class="uk-modal-footer">
  <button type="submit" form="editbox" class="uk-button uk-button-default">Сохранить</button>
  <button type="button" class="uk-modal-close-default" uk-close>Закрыть</button>
</div>
</div>
 
<?php
include (dirname(dirname(dirname(__FILE__))) . '/core/maps/' . MAPS . '/map_box.php');
?>