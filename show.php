<?php
session_start();

require_once("conn.php");
$uid=$_SESSION["uid"];
$maxc_id=$_GET["m"];

$total=0; //計算單項商品總額
$totall=0; //計算訂單總額


try
{   //抓客戶剛成立的訂單
    $sql="select product.product_id,product_name,product_price,quantity from cart,customer,product 
            where cart.uid=customer.uid and cart.product_id=product.product_id and cart.c_id={$maxc_id} and customer.uid={$uid}";
 
    $result=$db->query($sql);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
         
}
catch(PDOException $e)
{
    echo "Connection failed: ".$e->getMessage();
    $db=null;
}

$db=null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container col-md-8 col-md-offset-4">      
                <table class="table table-hover">      
                    <thead>
                        <tr>
                            <th scope="col" style="background-color:#DCDCDC;">圖片</th>
                            <th scope="col" style="background-color:#DCDCDC;">產品名稱</th>
                            <th scope="col" style="background-color:#DCDCDC;" >產品價格</th>
                            <th scope="col" style="background-color:#DCDCDC;">數量</th>
                            <th scope="col" style="background-color:#DCDCDC;">總計</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $show=array();
                    while($show=$result->fetch(PDO::FETCH_ASSOC)){
                        
                        $total=intval($show["product_price"])*intval($show["quantity"]);
                        $totall+=$total;         
                        echo "<tr><td><img  src=\"img/img"."{$show["product_id"]}".".jpg\"width=\"200\" height=\"100\"></td>"
                             ."<td align=\"center\">"."{$show["product_name"]}"."</td>"
                             ."<td align=\"center\">$"."{$show["product_price"]}"."</td>"
                             ."<td align=\"center\">"."{$show["quantity"]}"."</td>"
                             ."<td align=\"center\">"."{$total}"."</td></tr>";
                    } 
                     echo "<tr><td>總金額</td><td></td><td></td><td></td><td>$"."{$totall}"."</td></tr>";   
                     echo  "</tbody>
                        </table>
                    </div>" ; 
                    setcookie("cart","",time()-3600);
                    setcookie("totall","",time()-3600);
                    setcookie("item","",time()-3600);
                    $db=null;
                    ?>
<div> <a href="index.php">返回首頁</a></div>
    
</body>
</html>