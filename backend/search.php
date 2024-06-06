<?php
include('connection/ajans-con.php');

$arama = isset($_POST['musteri_adi']) ? $_POST['musteri_adi'] : '';

if (empty($arama)) {
    // Eğer arama yapılacak bir değer yoksa, bir şey yapma
} else {
    $arama = '%' . $arama . '%';

    $query = "SELECT * FROM musteri WHERE musteri_adi LIKE ? OR musteri_soyadi LIKE ? OR musteri_tc LIKE ? OR musteri_pasaport_no LIKE ?";
   
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $arama, $arama, $arama, $arama);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Eğer arama sonuçları varsa
    $stmt->close();
}
?>
