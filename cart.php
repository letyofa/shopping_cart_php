<?php
session_start();
if(isset($_POST["addCart"])){
    addCart();
}
if(isset($_GET["changeQuantity"]) && isset($_GET["id"])){
    changeCart();
}

if(isset($_GET["del"])){
    delCart();
}


//加入購物車
function addCart(){                    
    if(isset($_SESSION["userName"])){ 

        $id=$_POST["product_id"];

        $cart= !empty($_COOKIE["cart"]) ? unserialize($_COOKIE["cart"]) : array();
           
        if($cart==null){ //第一筆加入購物車
            $cart[$id]["id"] = $_POST["product_id"];
            $cart[$id]["name"] = $_POST["product_name"];
            $cart[$id]["quantity"] = $_POST["quantity"];
            $cart[$id]["price"] = $_POST["product_price"];
            $total=$_POST["quantity"]*$_POST["product_price"];
            $cart[$id]["total"]=$total; 
            setcookie("totall",$total,time()+3600);
            setcookie("item",1,time()+3600);
        }else{
            if(isset($cart[$id]["id"])){  //之前加入過購物車
                $cart[$id]["quantity"]+= $_POST["quantity"];
                $total=intval($cart[$id]["quantity"]) * intval($cart[$id]["price"]);
                $cart[$id]["total"]=$total;

                foreach($cart as $v1){     //計算總金額、項目
                    $totalArr[]= $v1["total"];
                    $itemArr[]= $v1["id"];
                }
                $count=sizeof($itemArr);
                $i=sizeof($totalArr);
                for($j=0;$j<$i;$j++){
                    $totall+=$totalArr[$j];
                }
                setcookie("totall",$totall,time()+3600);
                setcookie("item",$count,time()+3600);                               
            }else{ //該商品第一次加入購物車
                $cart[$id]["id"] = $_POST["product_id"];
                $cart[$id]["name"] = $_POST["product_name"];
                $cart[$id]["quantity"] = $_POST["quantity"];
                $cart[$id]["price"] = $_POST["product_price"];
                $total=$_POST["quantity"]*$_POST["product_price"];
                $cart[$id]["total"]=$total;

                $_COOKIE["totall"]+=$cart[$id]["total"];
                $_COOKIE["item"]+=1;
                setcookie("totall",$_COOKIE["totall"],time()+3600);
                setcookie("item",$_COOKIE["item"],time()+3600);
            }
        }                  
        setcookie("cart",serialize($cart),time()+3600*24);
        header("Location: index.php");
    }else{
        echo "<script>alert('請先登入!');location.href='login.php';</script>";
    }    
}



//變更數量
function changeCart(){                  
    $cart= unserialize($_COOKIE["cart"]);
    $totall=0;
    $quantity=$_GET["changeQuantity"];
    $id=$_GET["id"];
    $cart[$id]["quantity"] = $quantity;
    $total=$quantity*$cart[$id]["price"];
    $cart[$id]["total"]=$total; 
    
    foreach($cart as $v1){
        $totalArr[]= $v1["total"];
        $itemArr[]= $v1["id"];
    }

    $count=sizeof($itemArr);
    $i=sizeof($totalArr);

    for($j=0;$j<$i;$j++){
        $totall+=$totalArr[$j];
    }

    setcookie("totall",$totall,time()+3600);
    setcookie("item",$count,time()+3600);  
    setcookie("cart",serialize($cart),time()+3600*24);   
    header("Location: order.php");
                    
}

//刪除單項商品
function delCart(){
    $cart= unserialize($_COOKIE["cart"]);
    $id=$_GET["del"];
    $totall=$cart[$id]["total"];
    unset($cart[$id]);

    setcookie("totall",$_COOKIE["totall"]-$totall,time()+3600);
    setcookie("item",$_COOKIE["item"]-1,time()+3600);  
    setcookie("cart",serialize($cart),time()+3600*24);   
    header("Location: order.php");

}
  
?>