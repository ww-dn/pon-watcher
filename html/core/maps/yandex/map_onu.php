<script src="https://api-maps.yandex.ru/2.1/?apikey=<?=MAPS_YA_API_KEY?>&lang=ru_RU" type="text/javascript">
    </script>
<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);
    function init(){ 
        var lat = <?=$onu_lat?>;
        var lon = <?=$onu_lon?>;
        // Создание карты.    
        var myMap = new ymaps.Map("map", {
            // Координаты центра карты.
            // Порядок по умолчанию: «широта, долгота».
            // Чтобы не определять координаты центра карты вручную,
            // воспользуйтесь инструментом Определение координат.
            center: [lat, lon],
            // Уровень масштабирования. Допустимые значения:
            // от 0 (весь мир) до 19.
            zoom: 17
        });
        var myPlacemark = new ymaps.Placemark([lat, lon]);
        myMap.geoObjects.add(myPlacemark);
        
        myMap.events.add('click', function (e) {
        if (!myMap.balloon.isOpen()) {
            var coords = e.get('coords');
            myMap.balloon.open(coords, {
                contentHeader:'Изменение метки',
                contentBody:'<p>Координаты метки: ' + [
                    coords[0].toPrecision(6),
                    coords[1].toPrecision(6)
                    ].join(', ') + '</p>',
                contentFooter:'<button onClick="savepoint(' + [coords[0].toPrecision(6), coords[1].toPrecision(6)] + ')">Сохранить метку</button> '
                            + '<span id="result"></span>'
            });
        }
        else {
            myMap.balloon.close();
        }
    });
    }
    
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