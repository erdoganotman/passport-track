<?php
include(__DIR__.'/../connection/ajans-con.php');

if(isset($_POST["user-add"])){
    $musteri_adi = $_POST["musteri_adi"];
    $musteri_soyadi = $_POST["musteri_soyadi"];
    $musteri_dogum_tarihi = $_POST["musteri_dogum_tarihi"];
    $musteri_tc = $_POST["musteri_tc"];
    $musteri_pasaport_no = $_POST["musteri_pasaport_no"];
    $randevu_seyahat_tarihi = $_POST["randevu_seyahat_tarihi"];
    $randevu_tarihi_saati = $_POST["randevu_tarihi_saati"];
    $randevu_gidecegi_ulke = $_POST["randevu_gidecegi_ulke"];
    $alinan_para = $_POST["alinan_para"];
    $odeyecegi_para=$_POST["odeyecegi_para"];
    
    // Insert into 'musteri' table and get the last inserted ID
    $add = "INSERT INTO musteri (musteri_adi, musteri_soyadi, musteri_dogum_tarihi, musteri_tc, musteri_pasaport_no) 
            VALUES ('$musteri_adi','$musteri_soyadi','$musteri_dogum_tarihi','$musteri_tc','$musteri_pasaport_no')";
    $addstart = mysqli_query($conn, $add);

    // Get the last inserted ID from the 'musteri' table
    $musteri_id = mysqli_insert_id($conn);

    // Insert into 'randevu' table using the obtained 'musteri_id'
    $add2 = "INSERT INTO randevu (randevu_seyahat_tarihi, randevu_gidecegi_ulke, randevu_tarihi_saati, musteri_id) 
             VALUES ('$randevu_seyahat_tarihi','$randevu_gidecegi_ulke','$randevu_tarihi_saati', '$musteri_id')";
    $addstart2 = mysqli_query($conn, $add2);

    // Insert into 'odeme' table using the obtained 'musteri_id'
    $add3 = "INSERT INTO odeme (alinan_para, odeyecegi_para, musteri_id) 
             VALUES ('$alinan_para','$odeyecegi_para', '$musteri_id')";
    $addstart3 = mysqli_query($conn, $add3);

    if($addstart && $addstart2 && $addstart3){
      echo "<script>
      alert('Kayıt Başarıyla Eklendi.');
      window.location.href = '../../layout/meeting-lists.php'; // Giriş sayfasına geri dön
    </script>";
    } else {
        echo '<div class="alert alert-primary" role="alert">
                Kayıt Başarılı Bir Şekilde Eklenemedi.
              </div>';
    }
} 
mysqli_close($conn);
?>
