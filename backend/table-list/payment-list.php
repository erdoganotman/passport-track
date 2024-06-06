<?php
include(__DIR__."/../connection/ajans-con.php");

$query = $conn->query("SELECT odeme_id, musteri_id, alinan_para, odeyecegi_para FROM odeme");
if ($conn->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);
mysqli_close($conn);
?>
