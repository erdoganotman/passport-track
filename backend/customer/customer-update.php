<?php
include(__DIR__.'/../connection/ajans-con.php');
if(isset($_POST['user-update'])) {
    $musteri_id = $_POST['musteri_id'];
    
    // Boş olmayan değerlerin kontrolü ve atanması
    $musteri_adi = !empty($_POST['musteri_adi']) ? $_POST['musteri_adi'] : '';
    $musteri_soyadi = !empty($_POST['musteri_soyadi']) ? $_POST['musteri_soyadi'] : '';
    $musteri_tc = !empty($_POST['musteri_tc']) ? $_POST['musteri_tc'] : '';
    $musteri_dogum_tarihi = !empty($_POST['musteri_dogum_tarihi']) ? $_POST['musteri_dogum_tarihi'] : '';
    $musteri_pasaport_no = !empty($_POST['musteri_pasaport_no']) ? $_POST['musteri_pasaport_no'] : '';
    $randevu_gidecegi_ulke = !empty($_POST['randevu_gidecegi_ulke']) ? $_POST['randevu_gidecegi_ulke'] : '';
    $randevu_seyahat_tarihi = !empty($_POST['randevu_seyahat_tarihi']) ? $_POST['randevu_seyahat_tarihi'] : '';
    $randevu_tarihi_saati = !empty($_POST['randevu_tarihi_saati']) ? $_POST['randevu_tarihi_saati'] : '';
    $alinan_para = !empty($_POST['alinan_para']) ? $_POST['alinan_para'] : '';
    $odeyecegi_para = !empty($_POST['odeyecegi_para']) ? $_POST['odeyecegi_para'] : '';

    // SQL sorguları
    $sql1 = "";
    $sql2 = "";
    $sql3 = "";

    if(!empty($musteri_adi) || !empty($musteri_soyadi) || !empty($musteri_tc) || !empty($musteri_dogum_tarihi) || !empty($musteri_pasaport_no)) {
        $sql1 = "UPDATE musteri SET";
        if(!empty($musteri_adi)) $sql1 .= " musteri_adi = '$musteri_adi',";
        if(!empty($musteri_soyadi)) $sql1 .= " musteri_soyadi = '$musteri_soyadi',";
        if(!empty($musteri_tc)) $sql1 .= " musteri_tc = '$musteri_tc',";
        if(!empty($musteri_dogum_tarihi)) $sql1 .= " musteri_dogum_tarihi = '$musteri_dogum_tarihi',";
        if(!empty($musteri_pasaport_no)) $sql1 .= " musteri_pasaport_no = '$musteri_pasaport_no',";
        $sql1 = rtrim($sql1, ','); // Son virgülü kaldır
        $sql1 .= " WHERE musteri_id = '$musteri_id'";
    }

    if(!empty($randevu_gidecegi_ulke) || !empty($randevu_seyahat_tarihi) || !empty($randevu_tarihi_saati)) {
        $sql2 = "UPDATE randevu SET ";
        if(!empty($randevu_gidecegi_ulke)) $sql2 .= " randevu_gidecegi_ulke = '$randevu_gidecegi_ulke',";
        if(!empty($randevu_seyahat_tarihi)) $sql2 .= " randevu_seyahat_tarihi = '$randevu_seyahat_tarihi',";
        if(!empty($randevu_tarihi_saati)) $sql2 .= " randevu_tarihi_saati = '$randevu_tarihi_saati',";
        $sql2 = rtrim($sql2, ','); // Son virgülü kaldır
        $sql2 .= " WHERE musteri_id = '$musteri_id'";
    }

    if(!empty($alinan_para) || !empty($odeyecegi_para)) {
        $sql3 = "UPDATE odeme SET ";
        if(!empty($alinan_para)) $sql3 .= " alinan_para = '$alinan_para',";
        if(!empty($odeyecegi_para)) $sql3 .= " odeyecegi_para = '$odeyecegi_para',";
        $sql3 = rtrim($sql3, ','); // Son virgülü kaldır
        $sql3 .= " WHERE musteri_id = '$musteri_id'";
    }

    // Sorguları sırasıyla çalıştırma
    if((empty($sql1) || mysqli_query($conn, $sql1)) && (empty($sql2) || mysqli_query($conn, $sql2)) && (empty($sql3) || mysqli_query($conn, $sql3))) {
        echo 'success';
    } else {
        echo "error: " . mysqli_error($conn); // Hata mesajını gösterme
    }
}
?>
