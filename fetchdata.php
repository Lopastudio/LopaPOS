<?php
$jsonData = file_get_contents('products.json');
header('Content-Type: application/json');
echo $jsonData;
?>
