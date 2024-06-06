<?php
include(__DIR__.'/../connection/ajans-con.php');
if(isset($_POST["node-adds"])){
    $notlar=$_POST['notlar'];
    $add = "INSERT INTO notlar (notlar) 
            VALUES ('$notlar')";
    $addstart = mysqli_query($conn, $add);
    if($addstart){
        echo "<script>
        alert('Kayıt Başarıyla Eklendi.');
        window.location.href = '../../layout/node-lists.php'; // Giriş sayfasına geri dön
      </script>";
    } else {
        echo '<div class="alert alert-primary" role="alert">
                Kayıt Başarılı Bir Şekilde Eklenemedi.
              </div>';
    }
} 
mysqli_close($conn);
?>
