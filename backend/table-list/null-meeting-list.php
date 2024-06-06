<?php
include(__DIR__."/../connection/ajans-con.php");

$query = $conn->query("SELECT randevu_id, musteri_id, randevu_gidecegi_ulke,randevu_seyahat_tarihi,randevu_tarihi_saati FROM randevu ORDER BY randevu_tarihi_saati ASC");
if ($conn->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);

?>
