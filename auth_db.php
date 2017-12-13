<?php
//header("Content-Type: text/html; charset=utf-8");
/* ~~~ФУНКЦИИ И КОНСТАНТЫ ДЛЯ РАБОТЫ С БД~~~ */
include "SafeMySQL.php";

// Данные для подключения должны быть корректные
// !!! пустая DB должна быть создана заранее !!!
$USER = "root";                 // пользователь базы данных MySQL
//$USER = "stas";                 // ХОСТ
$PASS = "127812PHP";            // пароль для доступа к серверу MySQL
//$PASS = "127812PHP@";            // ХОСТ
$DB = "long_short_urls";       // название СОЗДАНОЙ базы данных
$DT = "URLs";                  // таблица URL


// указатель на соединение:
$DB_CON = new SafeMySQL(
    array(
        'user'      => $USER,
        'pass'      => $PASS,
        'db'        => $DB,
        'charset'   => 'utf8')
                        );

/*
 * Date_create  - дата создания записи для очистки на 15 день после создания;
 * Date_link    - дата последнего обрщения для отображения в логе;
*/
function create_table()
    /* Создаем таблицу в БД */
    {
        global $DB_CON, $DT ;

        try {
                $DB_CON->query("CREATE TABLE ?n (?n INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                ?n CHAR(?i), ?n CHAR(?i),?n INT, ?n DATE, ?n DATE)",
                                $DT, 'id', 'Long_u', '254', 'Short_u', '254', 'Short_count', 'Date_create', 'Date_link');
            }
        catch (Exception $e)
            {/*
                echo 'при попытке созадть таблицу с учетками: '. $e->getMessage() .'<br />';
                echo 'Error :' . $e->getMessage() . '<br />';
                echo 'Code :' . $e->getCode() . '<br />';
                echo 'File :' . $e->getFile() . '<br />';
                echo 'Line :' . $e->getLine() . '<br />';
                exit();*/
            }

    }
?>

