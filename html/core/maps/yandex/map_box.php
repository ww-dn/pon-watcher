<?php
?>

<script type="text/javascript">
    // Функция ymaps.ready() будет вызвана, когда
    // загрузятся все компоненты API, а также когда будет готово DOM-дерево.
    ymaps.ready(init);
    function init(){ 
        var lat = <?=$box_lat?>;
        var lon = <?=$box_lon?>;
        // Создание карты.    
        var myMap = new ymaps.Map("map", {
            center: [lat, lon],
            zoom: 17
        });
        var myPlacemark = new ymaps.Placemark([lat, lon]);
        myMap.geoObjects.add(myPlacemark);
        
        myMap.events.add('click', function (e) {
        if (!myMap.balloon.isOpen()) {
            var coords = e.get('coords');
            myMap.balloon.open(coords, {
                contentHeader:'Изменение метки',
                contentBody:'<span>Координаты метки: ' + [
                    coords[0].toPrecision(6),
                    coords[1].toPrecision(6)
                    ].join(', ') + '</span>',
                contentFooter:'<p id="result">&nbsp;</p> ' + '<button onClick="savepoint(' + [coords[0].toPrecision(6), coords[1].toPrecision(6)] + ')">Сохранить метку</button> '
            });
        }
        else {
            myMap.balloon.close();
        }
    });
    }
    
    function savepoint(latc, lonc){
        var boxid = <?=$row_box_edit['id']?>;
        var result;
        $.ajax({
            type: "POST",
            url: "/connectors/telemetria.php",
            dataType: "text",
            data: "&f=saveboxpoint"
                + "&boxid=" + boxid
                + "&lat=" + latc
                + "&lon=" + lonc,
            success: function(data) {
                //$("#result").append(data);
                $('#result').empty();
                $("#result").html(data);
            }
        });
        return result;
    }
</script> 