<h1>PATH TEST</h1>
<?php
echo 'Document root: путь> '.$_SERVER['DOCUMENT_ROOT'].'<br>';
echo 'script path:> '.$_SERVER['SCRIPT_FILENAME'].'<br>';
echo 'Script name:> '.$_SERVER['SCRIPT_NAME'].'<br>';
echo 'PHP_VER:> '.phpversion().'<br>';
echo 'PHP_VER:> '.phpinfo().'<br>';
?>