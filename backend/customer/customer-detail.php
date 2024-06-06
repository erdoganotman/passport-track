<?php
include(__DIR__.'/../connection/ajans-con.php'); // Veritabanı bağlantı dosyanızı buraya ekleyin

$customerId = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($customerId)) {
    // Müşteri sorgusu
    $query = "SELECT * FROM musteri WHERE musteri_id = ?";
    $stmt = $conn->prepare($query);   
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Eğer müşteri detayları bulunduysa
    if ($result->num_rows > 0) {
        $customerDetails = $result->fetch_assoc();
    } else {
        $customerDetails = null; // Müşteri bulunamazsa null olarak ayarla
    }
    $stmt->close();

    // Randevu sorgusu
    $query3 = "SELECT * FROM randevu WHERE musteri_id = ?";
    $stmt3 = $conn->prepare($query3);
    $stmt3->bind_param("i", $customerId);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    
    // Eğer randevu detayları bulunduysa
    if ($result3->num_rows > 0) {
        $customerDetails3 = $result3->fetch_assoc();
    } else {
        $customerDetails3 = array(); // Randevu bulunamazsa boş dizi olarak ayarla
    }
    $stmt3->close();

    // Ödeme sorgusu
    $query2 = "SELECT * FROM odeme WHERE musteri_id = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $customerId);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    
    // Eğer ödeme detayları bulunduysa
    if ($result2->num_rows > 0) {
        $customerDetails2 = $result2->fetch_assoc();
    } else {
        $customerDetails2 = array(); // Ödeme bulunamazsa boş dizi olarak ayarla
    }
    $stmt2->close();
} else {
    $customerDetails = null; // Geçerli bir müşteri ID'si yoksa null olarak ayarla
    $customerDetails3 = array(); // Geçerli bir müşteri ID'si yoksa boş dizi olarak ayarla
    $customerDetails2 = array(); // Geçerli bir müşteri ID'si yoksa boş dizi olarak ayarla
}
?>
