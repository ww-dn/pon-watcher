<?php
if (isset($_GET['p']) AND $_GET['p'] == '42') {
?>
<p>Текущая версия системы: <?php 
  @include(dirname(dirname(dirname(__FILE__))) . '/ver.php');
  echo $ver;
  ?> </p>
<p>
  <button class="uk-button uk-button-primary" onclick="checkupd()">Проверить обновления</button>
</p>

<div id="res-upd"></div>

<script>
    function checkupd() {
    $.ajax
    ({
      type: "GET",
      url: "/connectors/update/check.php",
      data: {"upd":"check"},
      success: function(html) {
        $('#res-upd').empty();
        $("#res-upd").html(html);
      },
      failure: function(html) {
        toastr["error"]("Произошла ошибка при создании архива!");
      }
    });
  }
</script>
<?php
}
?>