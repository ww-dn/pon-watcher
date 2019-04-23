<?php
if (isset($_GET['p']) AND $_GET['p'] == '41') {
  ?>
  <button class="uk-button uk-button-primary" onclick="backupfs()">Создать архив файлов</button>
  <button class="uk-button uk-button-primary" onclick="backupdb()">Создать архив БД</button>
  <button class="uk-button uk-button-primary" onclick="backupall()">Создать полный архив</button>
  <div class="uk-section uk-section-muted" id="files-list">
  <?php
    echo ls_backup_dir();
  ?>
  </div>
  <script>
    function backupfs() {
    $.ajax
    ({
      type: "GET",
      url: "/connectors/backup/backup.php",
      data: {"backup":"create_fs"},
      success: function(html) {
        toastr["success"]("Архив успешно создан!");
        $('#files-list').empty();
        $("#files-list").html(html);
      },
      failure: function(html) {
        toastr["error"]("Произошла ошибка при создании архива!");
      }
    });
  }

  function backupdb() {
    $.ajax
    ({
      type: "GET",
      url: "/connectors/backup/backup.php",
      data: {"backup":"create_db"},
      success: function(html) {
        toastr["success"]("Архив успешно создан!");
        $('#files-list').empty();
        $("#files-list").html(html);
      },
      failure: function(html) {
        toastr["error"]("Произошла ошибка при создании архива!");
      }
    });
  }

  function backupall() {
    $.ajax
    ({
      type: "GET",
      url: "/connectors/backup/backup.php",
      data: {"backup":"create_all"},
      success: function(html) {
        toastr["success"]("Архив успешно создан!");
        $('#files-list').empty();
        $("#files-list").html(html);
      },
      failure: function(html) {
        toastr["error"]("Произошла ошибка при создании архива!");
      }
    });
  }

  </script>
  <?php
}
elseif (isset($_GET['backup']) AND $_GET['backup'] == 'create_fs') {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/function.php');
  $ret = backup_fs();
  print_r($ret);
}

elseif (isset($_GET['backup']) AND $_GET['backup'] == 'create_db') {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/function.php');
  $ret = backup_db();
  print_r($ret);
}

elseif (isset($_GET['backup']) AND $_GET['backup'] == 'create_all') {
  @include(dirname(dirname(dirname(__FILE__))) . '/config.core.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/mysql.class.php');
  @include(dirname(dirname(dirname(__FILE__))) . '/core/function.php');
  backup_fs();
  $ret = backup_db();
  print_r($ret);
}
?>