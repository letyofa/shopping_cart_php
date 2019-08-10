<?php
session_start();

require_once("conn.php");

if(isset($_SESSION["userName"])){     //判斷使用者
  $userStatus=$_SESSION["userName"];
}else{
  $userStatus="Guest"; 
}

$flag=0;     //判斷購物車顯示
if(isset($_COOKIE["totall"])&&isset($_COOKIE["item"])){
  $flag=1;         
}

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
        <th scope="col" style="background-color:#DCDCDC;" aligh="center">產品名稱</th>
        <th scope="col" style="background-color:#DCDCDC;" aligh="center">產品介紹</th>
        <th scope="col" style="background-color:#DCDCDC;" aligh="center">產品價格</th>
        <th scope="col" style="background-color:#DCDCDC;" aligh="center">數量</th>
        <th scope="col" style="background-color:green;">
        <h4>Welcom! <?= $userStatus ?></h4>
        <?php if(!isset($_SESSION["userName"])){ ?>
        <a href="login.php" >登入</a> <?php }else{ ?>
        <a href="logout.php" >登出</a>
        <?php } ?> 
        </th>
      </tr>
    </thead>
      <?php //輸出資料內容
      $result = $db->query("select * from product");
      while ($row=$result->fetch())
      {
        $product_id=$row['product_id'];
        $product_name=$row['product_name'];
        $product_desc=$row['product_desc'];
        $product_price=$row['product_price'];
      ?>
    <form action="cart.php" enctype="multipart/form-data" method="post">
    <tbody>
        <tr>
          <th scope="row" >
          <input type="hidden" name="product_id" value="<?= $product_id?>">
          <img src="img/img<?= $row["product_id"]?>.jpg" width="200" height="100">
          </th>
          <td aligh="center"><input type="hidden" name="product_name" value="<?= $product_name?>"><?= $row["product_name"] ?></td>
          <td><?= $row['product_desc']; ?></td>
          <td aligh="center"><input type="hidden" name="product_price" value="<?= $product_price ?>">$<?= $row['product_price'] ?></td>
          <td><select name="quantity">
          <?php
            for($i=1;$i<=20;$i++){ 
              echo "<option value=\"{$i}\">{$i}</option>";
            } ?></select></td>
          <td><input type="submit" name="addCart" value="加入購物車" /></td>
        </tr>                  
    </tbody> 
    </form>
      <?php } ?>       
  </table>     
</div>
<div>
  <form action="order.php" enctype="multipart/form-data" method="post">
      <label for="money">$<?php if($flag==0){echo "0";}else{echo $_COOKIE["totall"];}?></label>&nbsp;&nbsp;
      <label for="item">(<?php if($flag==0){echo "0";}else{echo $_COOKIE["item"];}?>)</label>
      <br />
      <input type="submit" name="Checkout" value="結帳" />
  </form>
</div>  

</body>
</html>
<?php $db=null; ?>