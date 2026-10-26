<?php
session_start();
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$reload=$_POST['reload'];
$newbalance=$_SESSION["balance"]+$reload;
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
  die("failed".$con->connect_error);
}
$sql="UPDATE `user` SET `balance`= ".$newbalance." WHERE username='".$_SESSION["username"]."';";
$con->query($sql);
echo"success";
$sql="select balance from user where username='".$_SESSION["username"]."';";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
	$_SESSION["balance"]=$row["balance"];
  };
$con->close();
header("Location: reloadui.php");
exit;
?>
