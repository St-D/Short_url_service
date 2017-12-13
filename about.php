<?php
/*~~~ Страница с контактной информацией ~~~*/

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
<body>


<p class="container">

<div class="btn-group pull-right" id="btn_top">

    <a type="button" class="btn btn-default btn-xs" href="index.php" >
        <i class="fa fa-link"></i>&nbsp;Main page</a>

    <a type="button" class="btn btn-default btn-xs" href="for_web_masters.php">
        <i class="fa fa-cogs"></i>&nbsp;For Web Masters</a>

    <a type="button" class="btn btn-default btn-xs" href="show_log.php">
        <i class="fa fa-hdd-o"></i>&nbsp;Show Log</a>
</div>

<h4 id="header_show_log">for all inquiries regarding advertising and website operation please contact:
<span id="for_line"> stastastas@mail.ru</span></h4>



<?php
 echo "<h4 style='margin-right: 15%; margin-left: 90%; margin-top: 10%'>".date("d.m.Y")."</h4>";
?>



</body>
</html>
