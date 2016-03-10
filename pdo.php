<?php
define("DB_HOST","localhost");
define("DB_NAME","demapi");
define("DB_USER","root");
define("DB_PASSWD","");

$pdo = new PDO ( 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
