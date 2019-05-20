<?php
if (isset($_GET['upd']) AND $_GET['upd'] == 'check') {

  function get_dat_rel() {
    $curlInit = curl_init('https://api.github.com/repos/ww-dn/pon-watcher');
    curl_setopt($curlInit,CURLOPT_HEADER,false);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($curlInit, CURLOPT_USERAGENT, "php-app"); 
    $resp = curl_exec($curlInit);
    curl_close($curlInit);
    $resp = json_decode($resp);
    $response = $resp->{'updated_at'};
    return $response;
  }

  function get_changelog() {
    $curlInit = curl_init('https://api.github.com/repos/ww-dn/pon-watcher/contents/changelog');
    curl_setopt($curlInit,CURLOPT_HEADER,false);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    curl_setopt ($curlInit, CURLOPT_USERAGENT, "php-app"); 
    $resp = curl_exec($curlInit);
    curl_close($curlInit);
    $resp = json_decode($resp);
    $content = $resp->{'content'};
    $content = base64_decode($content);
    $content = nl2br($content);
    return $content;
  }

  $up_date = get_dat_rel();
  $changelog = get_changelog();
  echo "<p>Дата обновления репозитория: " . $up_date . "</p>";
  echo "<p>Что нового: </p>";
  print_r($changelog);
  
}
?>