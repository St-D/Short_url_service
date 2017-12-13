<?php
/*~~~ Страница с логом из БД ~~~*/
include "auth_db.php";
create_table();
global $DB_CON; // указатель на соединение
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Log</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="font-Awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/bootstrap.js"></script>
</head>
<body >


<p class="container">

<div class="btn-group pull-right" id="btn_top">

    <a type="button" class="btn btn-default btn-xs" href="about.php" >
        <i class="fa fa-info"></i>&nbsp;About Us</a>

    <a type="button" class="btn btn-default btn-xs" href="for_web_masters.php">
        <i class="fa fa-cogs"></i>&nbsp;For Web Masters</a>

    <a type="button" class="btn btn-default btn-xs" href="index.php">
        <i class="fa fa-link"></i>&nbsp;Main page</a>
</div>

<div id="header_show_log">
<p>Usage statistics <span id="for_line"> Short URL</span> service </p>
</div>

<?php

echo "
<table class='table table-bordered table-condensed' id='stat_table'>
    <thead><tr>
        <th>Real URL</th>
        <th>Short URL</th>
        <th>Creation Date</th>
        <th>Last Use Date</th>
        <th>REFER count</th>
    </tr></thead>
    <tbody style='font-weight: 600;'>
";
$all_stats = $DB_CON->getInd('id','SELECT * FROM ?n', 'URLs');

foreach ( $all_stats as $stats)
{
    echo "<tr>";


    echo "<td><a href=".$stats['Long_u']." target='_blank'>".$stats['Long_u']."</td>";
    echo "<td><a href=".'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/r/?".'&u='.$stats['Short_u']." target='_blank'>".
        'http://'.$_SERVER['HTTP_HOST']."/PHP_PJ/Home_work_Umb/r/?".'&u='.$stats['Short_u']."</td>";
    echo "<td>".$stats['Date_create']."</td>";
    echo "<td>".$stats['Date_link']."</td>";
    echo "<td>".$stats['Short_count']."</td>";


    echo "</tr>";
}

echo "

    </tbody>
</table>
";
?>

<div class="pull-left" id="">

    <a type="button" class="btn btn-default btn-sm" href="">
        <i class="fa fa-refresh"></i>&nbsp;Update</a>
</div>


</body>
</html>
