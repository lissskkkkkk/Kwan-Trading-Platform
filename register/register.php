<?php
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$tel=$_POST['tel'];
$birthday=$_POST['birthday'];
$gender=$_POST['gender'];
$interested="";
$interestedlist=$_POST['interested'];
foreach($interestedlist as $i){
    $interested=$interested.$i." ";
    }
$country=$_POST['country'];
$message=$_POST['message'];
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
  die("failed".$con->connect_error);
}
$sql="select username from user where username='".$username."';";
$result=$con->query($sql);
if ($result->num_rows > 0) {
    $con->close();
	die("
	<div 
	style='text-align:center;
	padding:20px;
	font-family:Arial;'>
	<p style='color:#ff3333;
	font-size:18px;'>
	User already exists. Please register again</p>
	<a href='register.html' 
	style='color:#0066cc;
	text-decoration:none;
	padding:10px;
	border:1px solid #4da6ff;
	border-radius:5px;'>
	click to go back
	</a>
	</div>");
}else{
$sql="INSERT INTO `user`(`username`, `password`,`balance`,`email`, `tel`, `date`, `gender`, `interested`, `country`, `message`, `type`) VALUES ('".$username."','".$password."',1000000.00,'".$email."','".$tel."','".$birthday."','".$gender."','".$interested."','".$country."','".$message."','user');";
$result=$con->query($sql);
echo"success";
$con->close();
header("Location: ../login/loginui.html");
exit();
}
?>
