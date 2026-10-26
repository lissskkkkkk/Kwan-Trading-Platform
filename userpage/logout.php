<?php
session_start();
unset($_SESSION["username"]);
if (!isset($_SESSION["username"])){
	echo"success";
}
header("Location: ../login/loginui.html");
session_start();
session_unset();
session_destroy();
?>