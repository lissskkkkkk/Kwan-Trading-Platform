<?php
session_start();
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$selectedProduct=$_POST['selectedProduct'];
$username=$_SESSION["username"];
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
  die("failed".$con->connect_error);
}
$sql="select balance from user where username='".$username."';";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
	$balance=$row["balance"];
  }
$sql="select price from products where productname='".$selectedProduct."';";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
	$price=$row["price"];
  }
$newbalance=$balance-$price;
$sql="UPDATE `user` SET `balance`='".$newbalance."' where username='".$username."';";
$result=$con->query($sql);
$sql="INSERT INTO `transactionrecords`(`username`, `productname`) VALUES ('".$username."','".$selectedProduct."')";
$result=$con->query($sql);
$con->close();
header("Location:userpage.php");
?>
