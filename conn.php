<?php

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'shopping';
$db=new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
$db->exec("set names utf8");


?>