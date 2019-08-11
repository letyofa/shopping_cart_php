<?php
session_start();

require_once("conn.php");
$uid=$_SESSION["uid"];

$cart=unserialize($_COOKIE["cart"]);

$result = $db->query("select max(c_id) from cart,customer where cart.uid=customer.uid and customer.uid={$uid}"); //取該位顧客訂單最新一筆id
$c_id=array();
while( $row = $result->fetch(PDO::FETCH_ASSOC) ) {
    $c_id[] = $row; 
  }
$maxc_id=$c_id[0]["max(c_id)"]+1; 


$count=count($cart);
$cou=0;

foreach($cart as $v1){ 
    try
    {   //加入資料庫
        $sql="insert into cart 
               values(\"{$maxc_id}\",\"{$uid}\",\"{$v1["id"]}\",\"{$v1["quantity"]}\",current_timestamp)";
    
        $db->exec($sql);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $cou++;
        if($cou==$count){    //全部做完跳到顯示訂單網頁
            header("Location: show.php?m={$maxc_id}");
        }
    }
    catch(PDOException $e)
    {
        echo "Connection failed: ".$e->getMessage();
    }

}




$db=null;
?>




