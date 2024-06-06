<?php
include(__DIR__.'/../connection/ajans-con.php');

if(isset($_POST['node-update'])) {
    $id = $_POST['id'];
    
    // Boş olmayan değerlerin kontrolü ve atanması
    $notlar = !empty($_POST['notlar']) ? $_POST['notlar'] : '';

    // SQL sorguları
    $sql1 = "";
    
    if(!empty($notlar)) {
        $sql1 = "UPDATE notlar SET ";
        if(!empty($notlar)) $sql1 .= "notlar = '$notlar', ";
        $sql1 = rtrim($sql1, ', '); // Son virgülü kaldır
        $sql1 .= " WHERE id = '$id'";
    }
    // Sorguları sırasıyla çalıştırma
    if((empty($sql1) || mysqli_query($conn, $sql1))) {
        echo 'success';
    } else {
        echo "error: " . mysqli_error($conn); // Hata mesajını gösterme
    }
}
?>
