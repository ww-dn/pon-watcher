<?php
if (isset($_GET['p']) AND $_GET['p'] == '51') {
?>
<form id="calc" class="uk-form-horizontal" method="POST" action="">
  <div class="uk-margin">
  <label class="uk-form-label">Тип SFP</label>
    <select class="uk-select uk-form-width-small" name="sfp">
      <option value="5">SFP C+</option>
      <option value="7">SFP C++</option>
    </select>
  </div>
  <div class="uk-margin">
    <label class="uk-form-label">Длинна опт. кабеля, км.</label>
    <input type="text" class="uk-input uk-form-width-medium" name="fiber" value="0">
  </div>
  <div class="uk-margin">
    <label class="uk-form-label">Кол-во мех. соед., шт.</label>
    <input type="text" class="uk-input uk-form-width-medium" name="meh" value="0">
  </div>
  <div class="uk-margin">
    <div id="add">
    
    </div>
  </div>
</form>
<div class="uk-margin">
    <button id="send" class="uk-button uk-button-default">Посчитать</button>
  </div>

<div id="result" class="uk-text-large">

</div>

<div class="uk-margin">
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl595()">Ответвитель 5/95</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl1090()">Ответвитель 10/90</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl1585()">Ответвитель 15/85</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl2080()">Ответвитель 20/80</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl2575()">Ответвитель 25/75</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl3070()">Ответвитель 30/70</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl3565()">Ответвитель 35/65</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl4060()">Ответвитель 40/60</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addcoupl4555()">Ответвитель 45/55</button>
</div>

<div class="uk-margin">
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv12()">Делитель 1/2</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv13()">Делитель 1/3</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv14()">Делитель 1/4</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv16()">Делитель 1/6</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv18()">Делитель 1/8</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv110()">Делитель 1/10</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv112()">Делитель 1/12</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv116()">Делитель 1/16</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv124()">Делитель 1/24</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv132()">Делитель 1/32</button>
<button class="uk-button uk-button-primary uk-margin-top" onclick="addotv136()">Делитель 1/36</button>
</div>

<script>
function addcoupl595() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 5/95 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="0.3">Проход</option> \
    <option value="13">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl1090() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 10/90 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="0.5">Проход</option> \
    <option value="10">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl1585() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 15/85 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="0.8">Проход</option> \
    <option value="8.3">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl2080() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 20/80 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="1">Проход</option> \
    <option value="7">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl2575() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 25/75 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="1.5">Проход</option> \
    <option value="6.3">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl3070() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 30/70 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="1.7">Проход</option> \
    <option value="5.4">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl3565() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 35/65 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="2">Проход</option> \
    <option value="4.7">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl4060() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 40/60 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="2.2">Проход</option> \
    <option value="4">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addcoupl4555() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Делитель 45/55 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <select class="uk-select uk-form-width-medium" name="' + rund + '"> \
    <option value="2.8">Проход</option> \
    <option value="3.7">Отвод</option> \
  </select> \
</div>';
  add.appendChild(addDiv);
}

function addotv12() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/2 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="3.6" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv14() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/4 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="7.2" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv18() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/8 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="11.4" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv13() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/3 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="6.1" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv16() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/6 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="8.5" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv110() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/10 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="11.8" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv112() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/12 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="12.5" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv116() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/16 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="15" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv124() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/24 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="16.5" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv132() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/32 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="17.5" readonly> \
</div>';
  add.appendChild(addDiv);
}

function addotv136() {
  var addDiv = document.createElement('div');
  var rund = Math.floor(Math.random() * (99999 - 999)) + 999;
  addDiv.id = rund;
  addDiv.innerHTML = '<div id="' + rund + '" class="uk-margin"> \
  <label class="uk-form-label">Ответвитель 1/36 <span onclick="delelement(\'' + rund + '\')" class="uk-text-danger" uk-icon="icon: close"></span></label> \
  <input type="text" class="uk-input uk-form-width-medium" name="' + rund + '" value="20" readonly> \
</div>';
  add.appendChild(addDiv);
}

function delelement(id) {
  var elem = document.getElementById(id);
  add.removeChild(elem);
}

$( document ).ready(function() {
  $("#send").click(
    function() {
      sendForm('result', 'calc', '/connectors/calc/calc_res.php')
    }
  );
});

function sendForm(result_form, form, url) {
  $.ajax({
    url: url,
    type: "POST",
    dataType: "html",
    data: $("#"+form).serialize(),
    success: function(resp) {
      $('#result').html(resp);
    },
    error: function(resp) {
      toastr["error"]("Произошла ошибка при подсчете!");
    }
  });
}
</script>
<?php
}
?>