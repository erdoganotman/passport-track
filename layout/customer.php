<?php
include('../include/header.php');
?>
<div class="dis-alan" style="display: flex;">
    <div style="background-color: #818181;"><?php include('../include/customer-left-main.php');?> </div>
    <div style="width: 100%;height:420px;">
    <?php
    include('../backend/search.php');
    // Check if the form is submitted and process the search
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the $searchResults variable is set (results from backend/search.php)
        if ($result->num_rows > 0) {
            echo "<div class='table-wrapper'>";
            echo "<table border='1' class='table'>";
            echo "<tr><th>Adı</th>
            <th>Soyadı</th>
            <th>Pasaport Numarası</th>
            <th>T.C Kimlik No</th>
            <th>Doğum Tarihi</th>
            <th>Randevu Tarihi</th>
            <th>Seyahat Tarihi</th>
            <th>Seyahat Edilecek Ülke</th>
            <th>Alınan Ücret</th>
            <th>Ödenecek Ücret</th>
            </tr>";
            // Her bir sonuç için bir satır oluştur
            while ($row = $result->fetch_assoc()) {
                // Müşteri bilgileri
                echo "<tr><td>" . htmlspecialchars($row['musteri_adi']) . "</td>
                <td>" . htmlspecialchars($row['musteri_soyadi']) . "</td>
                <td>" . htmlspecialchars($row['musteri_pasaport_no']) . "</td>
                <td>" . htmlspecialchars($row['musteri_tc']) . "</td>
                <td>" . htmlspecialchars($row['musteri_dogum_tarihi']) . "</td>";
                // Müşteri ID'sini kullanarak randevu ve ödeme tablolarından verileri çek
                $musteri_id = $row['musteri_id'];
                // Randevu bilgileri
                $randevu_query = "SELECT * FROM randevu WHERE musteri_id = ?";
                $randevu_stmt = $conn->prepare($randevu_query);
                $randevu_stmt->bind_param("i", $musteri_id);
                $randevu_stmt->execute();
                $randevu_result = $randevu_stmt->get_result();
                if ($randevu_result->num_rows > 0) {
                    $randevu_row = $randevu_result->fetch_assoc();
                    echo "<td>" . htmlspecialchars($randevu_row['randevu_tarihi_saati']) . "</td>
                    <td>" . htmlspecialchars($randevu_row['randevu_seyahat_tarihi']) . "</td>
                    <td>" . htmlspecialchars($randevu_row['randevu_gidecegi_ulke']) . "</td>";
                } else {
                    // Handle case where no randevu data is found
                    echo "<td colspan='3'>No Randevu Data</td>";
                }
                // Ödeme bilgileri
                $odeme_query = "SELECT * FROM odeme WHERE musteri_id = ?";
                $odeme_stmt = $conn->prepare($odeme_query);
                $odeme_stmt->bind_param("i", $musteri_id);
                $odeme_stmt->execute();
                $odeme_result = $odeme_stmt->get_result();

                if ($odeme_result->num_rows > 0) {
                    $odeme_row = $odeme_result->fetch_assoc();
                    echo "<td>" . htmlspecialchars($odeme_row['alinan_para']) . "</td>
                    <td>" . htmlspecialchars($odeme_row['odeyecegi_para']) . "</td>";
                } else {
                    // Handle case where no odeme data is found
                    echo "<td colspan='2'>No Odeme Data</td>";
                }
                echo "</tr>";
            }
            echo "</table></div>";
        } 
    }
    ?>
    </div>
</div>
<?php include('../include/footer.php') ?>
