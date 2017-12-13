<?php
/* ~~~ Обработка переадресации через GET запрос ~~~ */
/* контсрукция сделана для применения такого синтаксиса http://example.com/r?u=1A0jRO */

//для получения ссылки на соединение:
include "../auth_db.php";
create_table();
global $DB_CON;

if(isset($_GET['u']))

// если переменная через GET установлена:
{
    if(strlen($_GET['u']) == 6)
        // проверка на длинну ( задана при генерации URL
        // через суперглобальные массивы не завадавлось)
    {
        //запрос к БД на поиск по короткому URL:
        $url_sql_string = $DB_CON->getRow("SELECT * FROM ?n WHERE ?n = ?s",
            'URLs', 'Short_u', $_GET['u']);
        if($url_sql_string)
            // переадресация по ссылке
        {
            header("location: ".$url_sql_string['Long_u']);

            // увеличим счётчик посещений на 1 и дату использования:
            $DB_CON->query("UPDATE ?n SET ?n = ?i, ?n = ?s WHERE ?n = ?s",
                'URLs',
                'Short_count', $url_sql_string['Short_count'] + 1,
                'Date_link', date("Y-m-d"),
                'Short_u', $_GET['u']);
        }
        else
            // на начальную
        {
            //header("location: ".'http://'.$_SERVER['HTTP_HOST']."index.php");
            header("location: ".'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/index.php");
            exit();
        }
    }
    else
        // если короткая ссылка не прошла первичную валидацию
    {
        header("location: ".'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/index.php");
        exit();
    }
}

?>