<?php
include('../include/header.php');
include(__DIR__.'/../backend/customer/customer-detail.php');
?>
<div class="dis-alan"style="display: flex;">    
<div style="background-color: #818181;"><?php include('../include/customer-left-main.php') ?></div>
<div class="customer-right">
    <div style="width:100%;height:420px;">
    
    <h2>Müşteri Detayları</h2>

    <?php
    // Check if the $customerDetails, $customerDetails3, and $customerDetails2 variables are set
    if (isset($customerDetails, $customerDetails3, $customerDetails2)) {
        echo "<table border='1' class='table' style='height:80px'>";
        echo "<tr>
                <th>Adı</th>
                <th>Soyadı</th>
                <th>Pasaport Numarası</th>
                <th>T.C Kimlik No</th>
                <th>Doğum Tarihi</th>
                <th>Seyahat Edilecek Ülke</th>
                <th>Seyahat Tarihi</th>
                <th>Randevu Tarihi</th>
                <th>Alınacak Ücret</th>
                <th>Alınan Ücret</th>
              </tr>";

        // Display customer details
        echo "<tr>
                <td>" . $customerDetails['musteri_adi'] . "</td>
                <td>" . $customerDetails['musteri_soyadi'] . "</td>
                <td>" . $customerDetails['musteri_pasaport_no'] . "</td>
                <td>" . $customerDetails['musteri_tc'] . "</td>
                <td>" . $customerDetails['musteri_dogum_tarihi'] . "</td>
                <td>" . (isset($customerDetails3['randevu_gidecegi_ulke']) ? $customerDetails3['randevu_gidecegi_ulke'] : '') . "</td>
                <td>" . (isset($customerDetails3['randevu_seyahat_tarihi']) ? $customerDetails3['randevu_seyahat_tarihi'] : '') . "</td>
                <td>" . (isset($customerDetails3['randevu_tarihi_saati']) ? $customerDetails3['randevu_tarihi_saati'] : '') . "</td>
                <td>" . (isset($customerDetails2['odeyecegi_para']) ? $customerDetails2['odeyecegi_para'] : '') .' €'."</td>
                <td>" . (isset($customerDetails2['alinan_para']) ? $customerDetails2['alinan_para'] : '').' €'."</td>
              </tr>";

        echo "</table>";
    } else {
        echo "Müşteri detayları bulunamadı.";
    }
    ?>
</div>
</div>
</div>
<?php include('../include/footer.php') ?>
<style>
    .table{
        height: 380px;
        text-transform: capitalize;
    }
</style>