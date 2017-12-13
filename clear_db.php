<?php
/*
 * для очистики записей БД старше чем 15 дней.
 * установить в запуск через cron не реже чем каждые 15 дней.
 *
 */
include "auth_db.php";
create_table();
global $DB_CON; // указатель на соединение

$cur_date = date("Y-m-d");

$DB_CON->query("DELETE FROM ?n WHERE ?s - INTERVAL ?i DAY > ?n",
    'URLs',
    date("Y-m-d"),
    15,
    'Date_create');


exit();
?>