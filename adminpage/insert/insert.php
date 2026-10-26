<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SN="sql200.infinityfree.com";
    $UN="if0_43272224";
    $PW="YYx3ZeUsheQYmW";
    $DN="if0_43272224_text";

    $productname = $_POST['productname'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
	$file_path = $_POST['file_path'] ?? '';
	$product_status = $_POST['product_status'] ?? '';

    $con = new mysqli($SN, $UN, $PW, $DN);
    if ($con->connect_error){
        die("failed".$con->connect_error);
    }

    $sql = "INSERT INTO products(productname, price, description,`file path`,product_status) VALUES ('".$productname."','".$price."','".$description."','".$file_path."','".$product_status."');";
    $result = $con->query($sql);

    echo "success";
    $con->close();
}
?>
