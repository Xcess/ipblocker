<?php
$n = htmlspecialchars($_GET["n"]);
if(!is_numeric($n)) {
    header('HTTP/1.1 400 Bad Request');
    echo('ERROR: n should be numeric.');
    exit(0);
}
echo $n * $n;
?>

