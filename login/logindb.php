<?php
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$username=$_POST['username'];
$password=$_POST['password'];
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
    die("failed".$con->connect_error);
}
$sql="select type from user where username='".$username."'and password='".$password."';";
$result = $con->query($sql);
if ($result->num_rows>0){
    $row=$result->fetch_assoc();
    $userType=$row['type'];
    if($userType=="admin"){
		session_start();
        $_SESSION["username"]=$username;
        header("Location:../adminpage/adminpage.php");
		$con->close();
		exit();
    }elseif($userType=="user") {
		session_start();
        $_SESSION["username"]=$username;
		$con->close();
        header("Location:../userpage/userpage.php");
        exit();
	}
}else{
	$con->close();
    die("
	<div 
	style='text-align:center;
	padding:20px;
	font-family:Arial;'>
	<p style='color:#ff3333;
	font-size:18px;'>
	user is not existed</p>
	<a href='loginui.html' 
	style='color:#0066cc;
	text-decoration:none;
	padding:10px;
	border:1px solid #4da6ff;
	border-radius:5px;'>
	click to go back
	</a>
	</div>");
}
?>
