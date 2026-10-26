<?php
echo '<style>
p { color: red; }
table { 
    border-collapse: collapse;
    width: 100%;
    margin: 10px 0;
}
th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
    color: black;
}
tr:nth-child(even) {
    background-color: #e6e6e6;
}
tr:hover {
    background-color: #d4d4d4;
}
</style>';
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
    die("failed".$con->connect_error);
}
$sql="SELECT 
    tr.Transactionid,
    tr.Transactiontime,
    tr.productname,
    u.ID AS user_id,
    u.username,
    u.email
FROM `transactionrecords` tr
INNER JOIN `user` u ON tr.username = u.username
ORDER BY tr.Transactionid;";
$result = $con->query($sql);
if ($result->num_rows>0){
    echo"<table>".
    "<tr>".
      "<th>"."Transactionid"."</th>".
      "<th>"."Transactiontime"."</th>".
      "<th>"."productname"."</th>".
	  "<th>"."user_id"."</th>".
	  "<th>"."username"."</th>".
	  "<th>"."email"."</th>".
    "</tr>";
  while($row=$result->fetch_assoc()){
    echo"<tr>".
      "<td>".$row["Transactionid"]."</td>".
      "<td>".$row["Transactiontime"]."</td>".
      "<td>".$row["productname"]."</td>".
	  "<td>".$row["user_id"]."</td>".
	  "<td>".$row["username"]."</td>".
	  "<td>".$row["email"]."</td>".
    "</tr>";
	}
}else{
	$con->close();
}
?>
