<?php

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

<script>
  var lat = <?=$onu_lat?>;
  var lon = <?=$onu_lon?>;

map = new L.Map('map', {
  center: new L.LatLng(lat, lon),
  zoom: 16,
  layers: new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: 'Map data <a target="_blank" href="http://www.openstreetmap.org">OpenStreetMap.org</a> contributors, ' +
    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
    })
});

L.marker([lat, lon]).addTo(map)

var popup = L.popup();

function onMapClick(e) {
  var lat = e.latlng.lat.toFixed(6);
  var lon = e.latlng.lng.toFixed(6);
  popup
      .setLatLng(e.latlng)
      .setContent('Изменение метки <br>' +
       '<span>Координаты метки: ' + lat + ' ' + lon + '</span>' +
       '<button onClick="savepoint(' + lat + ',' + lon + ')">Сохранить метку</button>' + '<p id="result">&nbsp;</p>')
      .openOn(map);
}
map.on('click', onMapClick);

function savepoint(latc, lonc){
        var oltid = <?=$row_olt['id']?>;
        var onuid = <?=$row_onu['uidonu']?>;
        var result;
        $.ajax({
            type: "POST",
            url: "/connectors/telemetria.php",
            dataType: "text",
            data: "&f=saveonupoint"
                + "&oltid=" + oltid
                + "&onuid=" + onuid
                + "&lat=" + latc
                + "&lon=" + lonc,
            success: function(data) {
                $("#result").append(data);
            }
        });
        return result;
    }
</script>