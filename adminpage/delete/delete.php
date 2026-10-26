<?php
echo"
<style>
body{background-color:#f5f5f5;}
table{width:100%;border-collapse:collapse;}
th{background-color:#4CAF50;color:white;padding:10px;}
td{border:1px solid #ddd;padding:8px;}
tr:nth-child(even){background-color:#f2f2f2;}
button{background-color:#4CAF50;color:white;padding:10px 20px;border:none;}
</style>";
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
  die("failed".$con->connect_error);
}
if(isset($_POST['delete'])){
  $delete_sql = "DELETE FROM products WHERE productname = '".$_POST['delete']."'";
  $con->query($delete_sql);
}
$sql="select productname,price,description,`file path`,product_status from products;";
$result=$con->query($sql);
echo "<form method='post' action=''>";
if($result->num_rows>0){
  echo"<table>".
    "<tr>".
      "<th>"."name"."</th>".
      "<th>"."price"."</th>".
      "<th>"."description"."</th>".
	  "<th>"."file path"."</th>".
	  "<th>"."product status"."</th>".
    "</tr>";
  while($row=$result->fetch_assoc()){
    echo"<tr>".
      "<td>".$row["productname"]."</td>".
      "<td>".$row["price"]."</td>".
      "<td>".$row["description"]."</td>".
	  "<td>".$row["file path"]."</td>".
	  "<td>".$row["product_status"]."</td>".
	  "<td>"."<label><input type='radio' name='delete' value='".$row["productname"]."'></label>"."</td>".
    "</tr>";
  }
  echo"</table>";
  echo"<button type='submit'>submit</button>";
  echo"</form>";
}else{
  echo"Null";
}
$con->close();
?>