<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: ../login/loginui.html');
    exit();
}
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
    die("failed".$con->connect_error);
}
function check_admin_permission($con) {
    $username = $_SESSION['username'];
    $sql = "SELECT type FROM user WHERE username = '".$username. "';"; 
    $result=$con->query($sql);
    if ($result->num_rows === 0) {
        return false;
    }
    $user = $result->fetch_assoc();
    return ($user['type'] === 'admin');
}
if (!check_admin_permission($con)) {
    http_response_code(403); 
    die("Insufficient permissions! You do not have access to this page.");
}
echo "<style>
body{background-color:#f0f0f0;font-family:Arial;}
p{color:blue;}
div{background-color:white;margin:10px;padding:15px;border-radius:5px;}
a{color:green;text-decoration:none;font-size:18px;}
a:hover{color:red;}
</style>";
echo "Welcome, admin " . $_SESSION['username'];
echo"<html>
  <body>
  <div>
  <a href='delete/delete.php'>delete</a>
  </div>
  <div>
  <a href='insert/insert.html'>insert</a>
  </div>
  <div>
  <a href='query/query.php'>query</a>
  </div>
  </body>
</html>"
?>