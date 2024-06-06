<?php
include(__DIR__."/../connection/ajans-con.php"); // Veritabanı bağlantı dosyanızı buraya ekleyin
$nodeId = isset($_GET['id']) ? $_GET['id'] : '';
if (!empty($nodeId)) {
    // Müşteri sorgusu
    $query = "SELECT * FROM notlar WHERE id = ?";
    $stmt = $conn->prepare($query);   
    $stmt->bind_param("i", $nodeId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Eğer müşteri detayları bulunduysa
    if ($result->num_rows > 0) {
        $nodeDetails = $result->fetch_assoc();
    } else {
        $nodeDetails = null; // Müşteri bulunamazsa null olarak ayarla
    }
    $stmt->close();
}
?>