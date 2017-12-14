<?php
/* ~~~Страничка с описанием API~~~ */
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

    <a type="button" class="btn btn-default btn-xs" href="about.php" >
        <i class="fa fa-info"></i>&nbsp;About Us</a>

    <a type="button" class="btn btn-default btn-xs" href="index.php" >
        <i class="fa fa-link"></i>&nbsp;Main page</a>

    <a type="button" class="btn btn-default btn-xs" href="show_log.php">
        <i class="fa fa-hdd-o"></i>&nbsp;Show Log</a>
</div>

<h4 id="header_show_log"><span>short url</span> API<br>
    <span id="for_line"> Our API is simple, clear and free.</span></h4>


<h4>
    <p class="lead" style="margin-left: 5%; color: whitesmoke"">
        Currently, API is in development.
        However , some of the features it is still possible to use NOW!
    </p>
</h4>


<p class="lead" style="margin-left: 5%; color: whitesmoke"">Here is a simple example on Python.
    Use the preinstalled library<code>requests</code>:
</p>

<pre style="margin-left: 15%;">
<p style="margin-left: 10%;">
#  -*- coding: cp1251 -*-  #
# Python 3.x.x

import requests

api_url = 'http://sh.h1n.ru/api.php'

param_dict = {
    "long":     "https://tproger.ru/translations/regular-expression-python/",
    "short":    ""
                }

res = requests.get(api_url, params=param_dict)

print(res.status_code)
print(res.headers['Content-Type'])
print(res.url)

for k, v in res.json().items():
    print(k, "\t = \t", v)
</p>
</pre>

<p class="lead" style="margin-left: 5%; color: whitesmoke">... below is the result of the script :</p>

<pre style="margin-left: 15%;">
<p style="margin-left: 10%;">
# status_code
200

# header
application/json

# URL
http://sh.h1n.ru/api.php?long=https%3A%2F%2Ftproger.ru%2Ftranslations%2Fregular-expression-python%2F&short=

# JSON response:
    # long URL
l_url 	 = 	 https://tproger.ru/translations/regular-expression-python/
    # short URL
s_url 	 = 	 http://sh.h1n.ru/r/?&u=A2a97s
    # DB query error
db_er 	 = 	 0
    # debug Info
debug 	 = 	 Short_URL_FROM_DB
</p>
</pre>

<p class="lead" style="margin-left: 5%; margin-bottom: 20%; color: whitesmoke">
    ... So simply with Python !!! </p>



</body>
</html>

