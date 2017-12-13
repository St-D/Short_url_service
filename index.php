<?php
//error_reporting( E_ERROR ); // сообщения об ошибках откл
//подключаем файл обработки GET
//include "short_url_refer.php";
include "r.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Free Short url service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="font-Awesome/css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/ajax_proc.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>
<h6></h6>

<p class="container">

<div class="btn-group pull-right" id="btn_top">

    <a type="button" class="btn btn-default btn-xs" href="about.php" >
        <i class="fa fa-info"></i>&nbsp;About Us</a>

    <a type="button" class="btn btn-default btn-xs" href="for_web_masters.php">
        <i class="fa fa-cogs"></i>&nbsp;For Web Masters</a>

    <a type="button" class="btn btn-default btn-xs" href="show_log.php">
        <i class="fa fa-hdd-o"></i>&nbsp;Show Log</a>

</div>



<h2>Free Service Generate A <span id="for_line"> Short URL</span></h2>


<div class="row">

    <form method="POST" id="formForAjaxReq" action="" >
        <p><strong>Enter URL here:</strong><br>
            <input type="url" name="l_url" placeholder="long URL" class="form-control" value=""/><br>


        <p><strong>Enter for check desired short URL here:</strong><br>
            <input type="url" name="s_url" placeholder="short URL" class="form-control" value=""/><br>


            <!--<input type="button" id="btnSub1" value="Отправить" class="btn btn-default"/> -->

            <button type="button" class="btn btn-default" id ='btnSub'>
                <span class="fa fa-arrow-circle-right" style="color: red;"></span>&nbsp;Отправить</button>

            <button type="reset" class="btn btn-default" id ='reset_btn'>
                <span class="fa fa-refresh" style="color: red;"></span>&nbsp;Сбросить</button>

    </form>


    <br>

    <div id="res_form"></div>
    <div id="add_btn_form"></div>
    <div id="error_area"></div>

</div>

</body>
</html>