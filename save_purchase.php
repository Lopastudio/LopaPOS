<?php
$rawData = file_get_contents('php://input');
$purchaseData = json_decode($rawData, true);
if ($purchaseData) {
    $filePath = 'purchase_info.json';
    if (!file_exists($filePath)) {
        file_put_contents($filePath, '[]');
    }
    $existingData = file_get_contents($filePath);
    $existingPurchaseData = json_decode($existingData, true);
    $existingPurchaseData[] = $purchaseData;
    $jsonData = json_encode($existingPurchaseData, JSON_PRETTY_PRINT);
    if (file_put_contents($filePath, $jsonData) !== false) {
        echo "Purchase information saved successfully.";
    } else {
        echo "Failed to save purchase information.";
    }
} else {
    echo "No purchase data received.";
}
?>
