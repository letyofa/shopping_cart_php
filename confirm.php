<?php
session_start();

require("conn.php");


$cart=unserialize($_COOKIE["cart"]);

$result = $db->exec("select max(c_id) from cart ");
var_dump($result);





    
$db=null;
?>




