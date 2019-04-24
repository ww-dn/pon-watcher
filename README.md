# pon-watcher
**v0.4.1-beta**

**Требования**
* php7(на меньших версиях не проверялось), mysql, nginx(apache)

* php-snmp

* php-mysqli

**Начало работы**

* Развернуть дамп БД

* web_root директория html

* Отредактировать файл config.core.php

MAPS_YA_API_KEY - Вписать свой api ключ yandex карт

MAPS_DEF_LAT, MAPS_DEF_LON - вписать долготу, широту по умолчания

* Отредактипровать файл /core/mysql.conf.php

Вписать параметры подключения к БД

**Что уже умеет:**

* Загрузка ONU из OLT-ов в локальную БД для упрощения дальнейшего использования

* Добавление муфт, привязка к муфтам и розеткам в них ONU, размещение муфт на карте (Yandex)

* Просмотр информации об ONU

* Размещение ONU на карте (Yandex)

* Перезагрузка ONU

* Перезагрузка OLT

______________________________________________________

**Таблица боксов** - 0 бокс технический, необходим для нормальной работы системы

**Загрузить (обновить) список ОНУ-шек с ОЛТ-а**

По крону можно запускать раз 1-2 часа (можно больше/меньше, на свое усмотрение)

`wget pw.local/connectors/telemetria.php?f=checknew`


**Обновить сигналы ОНУ-шек**

Запускать по крону раз в 1 час (на свое усмотрение)

`wget pw.local/connectors/telemetria.php?f=ping`