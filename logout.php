<?php
session_start();
unset($_SESSION["userName"]);
setcookie("cart","",time()-3600);
setcookie("totall","",time()-3600);
setcookie("item","",time()-3600);
echo "<script language='javascript'>alert('登出成功!');location.href='index.php';</script>"; 


?>