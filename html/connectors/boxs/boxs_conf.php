<?php
if (isset($_GET['p']) AND $_GET['p'] == '32') {
  $query_box = new dbmysql();
  $select_boxs = $query_box->result("SELECT * FROM `boxs`");
  $num_rows = $query_box->fetch_row($select_boxs);
  echo "<div class='uk-padding'>";
  echo "<button class='uk-button uk-button-primary' type='button' uk-toggle='target: #modalAdd'>Добавить бокс</button>";
  if ($num_rows > "0") {
    $row_box = Array();
  ?>
    <table class="uk-table uk-table-striped">
    <thead>
      <tr>
        <th>id</th>
        <th>номер бокса</th>
        <th>кол-во розеток</th>
        <th>Локация</th>
        <th>Действия</th>
      </tr>
    </thead>
    <tbody>
  <?php
    while (is_array($row_box = $query_box->fetch_assoc($select_boxs))) {
      echo "<tr>";
      echo "<th>".$row_box['id']."</th>";
      echo "<td>".$row_box['num_box']."</td>";
      echo "<td>".$row_box['sum_roz']."</td>";
      echo "<td>".$row_box['lat']." ".$row_box['lon']."</td>";
      echo "<td><a href='javascript:void(0);' onclick=\"openedit('".$row_box['id']."')\" uk-icon='icon: cog' uk-tooltip='Редактировать'></a>&nbsp; &nbsp;<a href='/connectors/boxs/boxs_conf.php?del&boxid=".$row_box['id']."' class='uk-text-danger' uk-tooltip='Удалить' uk-icon='icon: trash'></a></td>";
      echo "</tr>";
    }
  ?>
    </tbody>
    </table>
    
  <?php
  }
  else {
    echo "<br>Записей не найдено";
  }
  ?>
<!-- Modal -->
<div id="modalAdd" uk-modal>
  <div class="uk-modal-dialog">
    <div class="uk-modal-header">
      <h5 class="uk-modal-title">Добавить бокс</h5>  
    </div>
    <div class="uk-modal-body">
        <form id="addbox" method="POST" action="/connectors/boxs/boxs_conf.php">
        <input type="hidden" name="add">
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Номер бокса" id="numBox" name="numbox">
        </div>
        <div class="uk-margin">
          <input type="text" class="uk-input uk-form-width-medium" placeholder="Кол-во розеток" id="numRoz" name="numroz">
        </div>
        </form>
        <div class="uk-margin"></div>
    </div>
    <div class="uk-modal-footer">
        <button type="submit" form="addbox" class="uk-button uk-button-default">Добавить</button>
        <button type="button" class="uk-modal-close-default" uk-close>Закрыть</button>
    </div>
  </div>
</div>
<!-- ------------------------------------------------- -->
<div id="boxEdit" uk-modal>

</div>
<!-- End Modal -->
</div>

<?php
if ( MAPS == 'yandex' ) {
?>
<script src="https://api-maps.yandex.ru/2.1/?apikey=<?=MAPS_YA_API_KEY?>&lang=ru_RU" type="text/javascript">
</script>
<?php
}
elseif ( MAPS == 'osm' ) {
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
<?php
}
?>
<script>
$(document).ready(function(){
    $('.openEdit').on('click',function(){
        var dataURL = $(this).attr('data-href');
        $('.editBoxModal').load(dataURL,function(){
            $('#modalEdit').modal.show();
        });
    }); 
});

function openedit(boxid) {
    var boxid = boxid,
        modal = UIkit.modal('#boxEdit', {
          escClose: false,
          bgClose: false
        });
    modal.show();
    $.ajax
    ({
      type: "GET",
      url: "/connectors/boxs/box_edit.php",
      data: {"id":boxid},
      success: function(html) {
        $('#boxEdit').empty();
        $("#boxEdit").html(html);
      }
    });
  }
</script>
<?php
}

if (isset($_POST['add'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_add = new dbmysql();
  $query_add->result("INSERT INTO `boxs` (num_box, sum_roz) VALUES ('".$_POST['numbox']."', '".$_POST['numroz']."')");
  header("Location: /?p=32");
}

if (isset($_GET['del'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_add = new dbmysql();
  $query_add->result("UPDATE `onu` SET `boxid` = '0', `roz` = NULL WHERE `boxid` = ".$_GET['boxid']."");
  $query_add->result("DELETE FROM `boxs` WHERE `id` = ".$_GET['boxid']."");
  header("Location: /?p=32");
}

if (isset($_POST['boxolt'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_box = new dbmysql();
  $query_box->result("UPDATE `onu` SET `boxid` = '".$_POST['numbox']."', `roz` = '".$_POST['numroz']."' WHERE `onu`.`id` = ".$_POST['idonu'].";");
  header("Location: /?p=22&oltid=".$_POST['idolt']."&onuid=".$_POST['uidonu']."");
}

if (isset($_POST['edit'])) {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  $query_box = new dbmysql();
  $query_box->result("UPDATE `boxs` SET `sum_roz` = '".$_POST['numroz']."' WHERE `boxs`.`id` = ".$_POST['idbox'].";");
  header("Location: /?p=32");
}
?>
