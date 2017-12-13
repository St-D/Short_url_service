<?php
include "auth_db.php";
create_table();
global $DB_CON; // указатель на соединение

/* ~~~ОБРАБОТКА AJAX ПРИ ЗАПРОСЕ URL~~~ */

/*--- Массив JSON по умолчанию ---*/
function create_json_arr($l_url = 'long_URL', $s_url = 'short_URL', $db_error ='error_def',
                         $data_for_debug = 'JSON_request_successfully')
    //так как-то удобней массив JSON формировать
{
    $result = array
    (
        "l_url" => $l_url,
        "s_url" => $s_url,
        "db_er" => $db_error,
        "debug" => $data_for_debug
    );
    //header('Content-type: application/json');
    echo json_encode($result);
    exit();
};
/*--------------------------------*/

/*---Генерация короткой ссылки----*/
function generate_short_url($num_of_char)
    // на вход длина короткой ссылки
{

    $arr = array
    (
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o',
        'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E',
        'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'V',
        'W', 'X', 'Y', 'Z', 'F', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
    );

    do
    {
        $short_url = "";

        for ($i = 0; $i < $num_of_char; $i++) {
            $random = rand(0, count($arr) - 1);
            $short_url .= $arr[$random];
        }
        //проверим нет ли УЖЕ такого url:
        global $DB_CON;
        $get_short_url = $DB_CON->getRow("SELECT ?n FROM ?n WHERE ?n = ?s",
            'Short_u','URLs', 'Short_u', $short_url);

    }
    while($get_short_url);

    return $short_url;

};
/*--------------------------------*/


function main()
{
    global $DB_CON; // указатель на соединение

// проверка условий заполнености форм:
//~~~~~~~~~~~~~~~~~~заполнены оба поля~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    if (trim($_POST["l_url"]) != "" && trim($_POST["s_url"]) != "")
    {
        //валидация на URL (false, если не прошла):
        $long_url = filter_var($_POST["l_url"], FILTER_VALIDATE_URL);
        $short_url = $_POST["s_url"];

        //парс строки короткого url после "="
        $short_url = substr(strstr($short_url, '='), 1, strlen($short_url));

        if ($long_url)
        {
            // если валидацию прошел, то поиск и сравнение данных в БД:
            $url_sql_string = $DB_CON->getRow("SELECT * FROM ?n WHERE ?n = ?s",
                'URLs', 'Long_u', $long_url);

            if ($long_url == $url_sql_string['Long_u'] && $short_url == $url_sql_string['Short_u'])
            // оба поля совпали с данными БД:
            {
                $er_status = 20;
                $debug_status = 'URL адреса валидны';
            }
            else
            {
                $er_status = 2;
                $debug_status = 'поле заполнено некорректно';
            }
        }
        else
            // валидация длинного URL по фильтру не прошла:
        {
            $er_status = 2;
            $debug_status = 'поле заполнено некорректно';
        }

        create_json_arr($l_url = $long_url, $s_url = $short_url, $db_error = $er_status,
            $data_for_debug = $debug_status);
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~~только длинный URL~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    elseif (trim($_POST["l_url"]) != "" && trim($_POST["s_url"]) == "")
    {
        //валидация на URL (false, если не прошла):
        $long_url = filter_var($_POST["l_url"], FILTER_VALIDATE_URL);

        if ($long_url)
        // если валидацию прошел:
        {
            // проверим, есть ли такая запись в БД:
            $url_sql_string = $DB_CON->getRow("SELECT ?n FROM ?n WHERE ?n = ?s",
                'Short_u', 'URLs', 'Long_u', $long_url);
            if ($url_sql_string)
            {
                //$short_url = 'http://'.$_SERVER['HTTP_HOST']."/r/?".'&u='.$url_sql_string['Short_u'];
                $short_url = 'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/r/?".'&u='.$url_sql_string['Short_u'];
                $er_status = 0;
                $debug_status = 'отправлен короткий URL из БД';
            }
            else
            //если записи в БД нет:
            {

                // сделаем http запрос по URL:
                if (get_headers($long_url, 1))
                {
                    //генерация короткой ссылки
                    $generated_url = generate_short_url(6);
                    //как GET для переадрессации:
                    //$short_url = 'http://'.$_SERVER['HTTP_HOST'].'&u='.$generated_url;
                    //$short_url = 'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/r/?".'&u='.$generated_url;
                    $short_url = 'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/r/?".'&u='.$generated_url;
                    //$short_url = generate_short_url(8);

                    $er_status = 0;
                    $debug_status = 'отправлен короткий URL';

                    // сделаем запись:
                    $DB_CON->query("INSERT INTO ?n(?n, ?n, ?n) VALUES (?s, ?s, ?s)",
                        'URLs','Long_u','Short_u', 'Date_create', $long_url, $generated_url, date("Y-m-d") );

                }
                else
                {
                    $er_status = 3;
                    $debug_status = 'сайт не отвечает / не существует';
                    $short_url = 'ND';

                }
            }
        }
        else // валидацию не прошел:
        {
            $er_status = 2;
            $debug_status = 'длинный URL не прошел валидацию';
            $short_url = 'ND';
        }

        create_json_arr($l_url = $long_url, $s_url = $short_url, $db_error = $er_status,
            $data_for_debug = $debug_status);
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~только поле с коротким URL~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    elseif (trim($_POST["l_url"]) == "" && trim($_POST["s_url"]) != "")
    {
        // проверим, есть ли такая запись в БД:
        $short_url = $_POST["s_url"];
        //парс строки короткого url после "="
        $short_url = substr(strstr($short_url, '='), 1, strlen($short_url));

        $url_sql_string = $DB_CON->getRow("SELECT ?n FROM ?n WHERE ?n = ?s",
            'Long_u', 'URLs', 'Short_u', $short_url);

        if ($url_sql_string)
        {
            $long_url = $url_sql_string['Long_u'];
            $er_status = 10;
            $debug_status = 'отправлен длинный URL из БД';
        }
        else
        {
            $long_url = 'ND';
            $er_status = 4;
            $debug_status = 'Возможно этот URL был сгенерирован очень давно или другим сайтом';
        }

        create_json_arr($l_url = $long_url, $s_url = $short_url, $db_error = $er_status,
            $data_for_debug = $debug_status);
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

//~~~~~~~~~~~~~~~~~~пустые поля~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
else //если поля пустые
{
    $er_status = 1;
    $debug_status = 'Поля не заполнены / предложить заполнить поле / фокус на поле с длинным URL';
    $short_url = 'ND';
    $long_url = 'ND';

    create_json_arr($l_url = $long_url, $s_url = $short_url, $db_error = $er_status,
        $data_for_debug = $debug_status);
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
};

// запуск main():

main();
exit();

?>