<?php
session_start();
$SN="sql200.infinityfree.com";
$UN="if0_43272224";
$PW="YYx3ZeUsheQYmW";
$DN="if0_43272224_text";
$con=new mysqli($SN,$UN,$PW,$DN);
if ($con->connect_error){
  die("failed".$con->connect_error);
}
echo "<style>
    .user-info{
	font-family: FZShuTi;
	font-size: 24px;
    font-weight: bold;
	}
</style>";
echo "<div class='user-info'>";
echo"<p>Welcome ".$_SESSION["username"]."</p>";
$sql="select balance from user where username ='".$_SESSION["username"]."';";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
    echo "<p>balance:$".$row["balance"]."</p>";
	$_SESSION["balance"]=$row["balance"];
  }
echo "</div>";

$product_prices = array();
$sql="select productname,price from products;";
$result=$con->query($sql);
while($row=$result->fetch_assoc()){
    $product_prices[$row["productname"]] = $row["price"];
}
?>
<html>
<head>
  <title>purchasing page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #333;
      margin: 0;
      padding: 20px;
    }
    .header {
      text-align: center;
      background-color: #4a90e2;
      color: white;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    .products {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }
    .product {
      background-color: white;
      border-radius: 8px;
      padding: 15px;
      width: 250px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
	  cursor: pointer;
    }
    .product img {
      width: 200px;
      height: 200px;
      object-fit: cover;
      border-radius: 5px;
    }
    .product-name {
      font-weight: bold;
      color: #2c3e50;
      margin-top: 30px;
      font-size: 24px;
    }
    .other-products {
      margin-top: 30px;
      background-color: #ff7e5f;
      color: white;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
    }
    .logoutbackground {
      position: absolute;
      top: 10px; 
      right: 10px;
      margin: 0;
}
    .logout {
      background-color: #4a90e2;
      color: white; 
      padding: 8px 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 24px;
      font-family: Arial, sans-serif;
}
    .logout:hover {
      text-decoration: underline;
}
    .reloadbackground {
      position: absolute;
      top: 73px;
      left: 250px;
      margin: 0;
}
    .reload {
      background-color: #28a745;
      color: white; 
      padding: 2px 8px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 15px;
      font-family: Arial, sans-serif;
}
    .reload:hover {
      text-decoration: underline;
}
  </style>
</head>
<body>
  <p class="logoutbackground">
    <button class="logout" onclick="window.location.href='logout.php'">	
    logout
    </button>
  </p>
  <p class="reloadbackground">
    <button class="reload" onclick="window.location.href='reload/reloadui.php'">	
    reload
    </button>
  </p>
  <p class="header">
    Selling product
  </p>
  <div class="products">
  <div class="product" onclick="handleProductClick('Piano')">
    <img src="https://tw.yamaha.com/zh/files/gp_product_s6x_e2001c69a206b3c88c8ad1ebcd8ca40f.jpg?impolicy=resize&imwid=396&imhei=396" class="product img">
    <div class="product-name">piano</div>
  </div>
  <div class="product" onclick="handleProductClick('Violin')">
    <img src="https://www.tomleemusic.com.hk/cdn/shop/products/bd33ecf49496f1362e829160c566c8c7_0429ce26-4b9e-4eeb-bd88-babb84852d3d.jpg?v=1623168981" class="product img">
    <div class="product-name">violin</div>
	</div>
  <div class="product" onclick="handleProductClick('Guitar')">
    <img src="https://guitartogo-music.com/wp-content/uploads/%E5%BB%A3%E5%91%8A%E7%94%A8_Lowden_F-32C.jpg" class="product img">
    <div class="product-name">guitar</div>
  </div>
  </div>
  <p class="other-products">
    Product introduction:
  </p>
  <form id="productForm" method="post" action="buyproduct.php" style="display: none;">
    <input type="hidden" id="selectedProduct" name="selectedProduct">
  </form>
    <script>
    const productPrices=<?php echo json_encode($product_prices);?>;
    const userBalance=<?php echo $_SESSION["balance"];?>;
    function handleProductClick(productName) {
        const productPrice = productPrices[productName];
		const userConfirmed = confirm(`Product: ${productName}\nprice: $${productPrice}\nbalance: $${userBalance}\n\nConfirmed to buy?？`);
		if (userConfirmed) {
        if (userBalance < productPrice) {
            alert(`Insufficient balance！`);
            return false;
        }
            alert(`success！You have bought ${productName}`);
            document.getElementById('selectedProduct').value = productName;
            document.getElementById('productForm').submit();
        }
    }
    </script>
</body>
</html>
<?php
echo
"<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
</style>";
$sql="select productname,price,description,`file path`,product_status from products;";
$result=$con->query($sql);
if($result->num_rows>0){
  echo"<table>".
    "<tr>".
      "<th>"."name"."</th>".
      "<th>"."price"."</th>".
      "<th>"."description"."</th>".
	  "<th>"."sound"."</th>".
	  "<th>"."product status"."</th>".
    "</tr>";
  while($row=$result->fetch_assoc()){
	$file_path=$row["file path"];
	$status = $row["product_status"];
	if ($status == 'onsale') {
        $color = 'green';
    } else if ($status == 'offsale') {
        $color = 'red';
	}
    echo"<tr>".
      "<td>".$row["productname"]."</td>".
      "<td>"."$".$row["price"]."</td>".
      "<td>".$row["description"]."</td>".
	  "<td><audio controls><source src='".$file_path."' type='audio/mp3'></audio></td>".
      "<td style='color:".$color."'>".$status."</td>".
	  "</tr>";
  }
  echo"</table>";
}else{
  echo"Null";
}
$con->close();
?>