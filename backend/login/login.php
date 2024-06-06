<?php
ob_start();
session_start();
include(__DIR__."/../connection/ajans-con.php");

// Formdan gelen verilerin varlığını kontrol et
if(isset($_POST['username']) && isset($_POST['userpass'])) {
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];
    // Kullanıcı adına göre sorguyu hazırla
    $sorgu = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    // Sorgu sonucunu kontrol et
    if ($sorgu) {
        $sorguSonuc = mysqli_fetch_array($sorgu);
        // Kullanıcı adı ve şifre doğruysa
        if ($sorguSonuc && $username == $sorguSonuc['username'] && $userpass == $sorguSonuc['userpass']) {
            $_SESSION['durum'] = "girildi";
            $_SESSION['user'] = $username;
            header("Location: ../../layout/index.php");
        } else {
            // Giriş başarısız olduğunda JavaScript ile popup açarak hata mesajını göster
            echo "<script>
                    alert('Kullanıcı adı veya şifre hatalı.');
                    window.location.href = '../../index.php'; // Giriş sayfasına geri dön
                  </script>";
        }
    } else {
        echo "Sorgu hatası: " . mysqli_error($conn);
    }
} 
?>
