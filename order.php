<?php
session_start();

$cart=!empty($_COOKIE["cart"])?unserialize($_COOKIE["cart"]):array(); 

if(!isset($_SESSION["userName"])){  //判斷是否登入，以及購物車內有無商品
  echo "<script>alert(\"請先登入\");location.href='login.php'</script>";
}else{
    if($cart==null){
      echo "<script>alert(\"購物車無商品\");location.href='index.php';</script>";
    }      
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
      function change($changeQuantity,$id){   
        
        location.href="cart.php?id="+$id+"&changeQuantity="+$changeQuantity;
      }                     
    </script>
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
            <th scope="col" style="background-color:green;"> <a href="logout.php" >登出</a></th>
          </tr>
        </thead>
        
        <tbody>        
          <?php 
            $cart=unserialize($_COOKIE["cart"]);           
            foreach($cart as $v1){            
              echo "<tr><td><img  src=\"img/img"."{$v1["id"]}".".jpg\"width=\"200\" height=\"100\"></td>"
                   ."<td align=\"center\">"."{$v1["name"]}"."</td>"
                   ."<td align=\"center\">$"."{$v1["price"]}"."</td>"
                   ."<td align=\"center\">"."<select name=\"changeQuantity\"  onchange=\"change(this.options[this.options.selectedIndex].value,{$v1["id"]});\" >" 
          ?>         
          <?php 
            for($i=1;$i<=20;$i++){
              if($i==$v1["quantity"]){
                echo "<option value=\"{$i}\" selected>{$i}</option>";
              }else{
                echo "<option value=\"{$i}\">{$i}</option>";
              }
            }
          ?>         
          <?php
              echo "</select>"."</td>"
                   ."<td align=\"center\">$"."{$v1["total"]}"."</td>"
                   ."<td align=\"center\">"."<a href=\"cart.php?del={$v1["id"]}\">刪除</a>"."</td>"
                   ."</tr><br>";                   
            }
          ?>          
                                     
        </tbody>
        <form action="confirm.php" enctype="multipart/form-data" method="post">  
         <tr><td>總金額</td><td></td><td></td><td></td><td>$<?= $_COOKIE["totall"]?></td></tr>
         <tr><td><a href="index.php">繼續購物</a></td><td></td><td></td><td></td><td><input type="submit" name="confirm" id="confirm" value="確定結帳"></td></tr>          
        </form>
    </table>     
</div>   
</body>
</html>