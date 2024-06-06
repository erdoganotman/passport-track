<?php
include(__DIR__.'/../connection/ajans-con.php');

$query = $conn->query("SELECT musteri_id, musteri_adi, musteri_soyadi, musteri_tc, musteri_dogum_tarihi, musteri_pasaport_no FROM musteri");
if ($conn->error > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);

// Veritabanı bağlantısını burada kapatın

?>