<?php
session_start();

require_once("conn.php");



if (isset($_POST["btnHome"]))
{
	header("Location: index.php");
	exit();
}

if (isset($_POST["btnOK"]))
{
    $sUserName = $_POST["txtUserName"];
    $sUserPass = $_POST["txtPassword"];
	if (trim($sUserName) != "" && trim($sUserPass) != "")  //驗證帳號密碼
	{
		$sql="select * from customer where username =\"{$sUserName}\" ";
		echo $sql;
		$testAccout=$db->query($sql);
		$testAccoutResult=$testAccout->fetch(PDO::FETCH_NUM);
        if($testAccoutResult[1]==$sUserName && $testAccoutResult[2]==$sUserPass)
        {
            $_SESSION['userName'] = $testAccoutResult[1];
            echo "<script language='javascript'>alert('登入成功 ! ');location.href='index.php';</script>";
        }else{
            echo "<script language='javascript'>alert('帳號或密碼有誤! 請再輸入一次。 ');location.href='login.php';</script>";
        }	
	}else{
        echo "<script language='javascript'>alert('帳號或密碼空白! 請再輸入一次。 ');location.href='login.php';</script>";
    }
}



?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Lab - Login</title>
</head>
<body>
	<form id="form1" name="form1" method="post" action="">
		<table width="300" border="0" align="center" cellpadding="5"
			cellspacing="0" bgcolor="#F2F2F2">
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><font
					color="#FFFFFF">會員系統 - 登入</font></td>
			</tr>
			<tr>
				<td width="80" align="center" valign="baseline">帳號</td>
				<td valign="baseline"><input type="text" name="txtUserName"
					id="txtUserName" /></td>
			</tr>
			<tr>
				<td width="80" align="center" valign="baseline">密碼</td>
				<td valign="baseline"><input type="password" name="txtPassword"
					id="txtPassword" /></td>
			</tr>
			<tr>
				<td colspan="2" align="center" bgcolor="#CCCCCC"><input
					type="submit" name="btnOK" id="btnOK" value="登入" /> <input
					type="reset" name="btnReset" id="btnReset" value="重設" /> <input
					type="submit" name="btnHome" id="btnHome" value="回首頁" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
