<?php
include('../include/header.php');
include(__DIR__.'/../backend/table-list/meeting-list.php');
?>

<?php
// Veritabanından verileri al
$query = $conn->query("SELECT randevu_id, musteri_id, randevu_gidecegi_ulke, randevu_seyahat_tarihi, randevu_tarihi_saati FROM randevu ORDER BY randevu_tarihi_saati ASC");
if ($conn->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);

// Get today's date
$today = date("Y-m-d");
?>

<div class="dis-alan" style="display: flex;">
   
    <div class="table-container">
        <?php
        // Check if the $result variable is set (results from the database query)
        if ($result) {
            ?>
            <div class="table-wrapper">
                <table border='1' class='table'>
                    <tr>
                        <th>Müşteri Adı ve Soyadı</th>
                        <th>Müşteri T.C Kimlik No</th>
                        <th>Müşteri Pasaport</th>
                        <th>Gideceği Ülke</th>
                        <th>Seyahat Tarihi</th>
                        <th>Randevu Tarihi</th>
                        <th>Alınan Ücret</th>
                        <th>Ödenecek Ücret</th>
                    </tr>
                    <?php
                    // Loop through each result and create a table row
                    foreach ($result as $row) {
                        // Check if the appointment date is greater than or equal to today's date
                        if (strtotime($row['randevu_tarihi_saati']) >= strtotime($today)) {
                            // Query to get customer name and surname using musteri_id
                            $customerQuery = $conn->query("SELECT musteri_adi, musteri_soyadi, musteri_tc, musteri_pasaport_no FROM musteri WHERE musteri_id = " . $row['musteri_id']);
                            $customerQuery2 = $conn->query("SELECT odeme_id, musteri_id, alinan_para, odeyecegi_para FROM odeme WHERE musteri_id = " . $row['musteri_id']);

                            if ($customerQuery) {
                                $customerData = $customerQuery->fetch_assoc();
                                $customerName = $customerData['musteri_adi'] . ' ' . $customerData['musteri_soyadi'];
                                $customerTc = $customerData['musteri_tc'];
                                $customerQueryResult = $customerQuery2->fetch_assoc();

                                if ($customerQueryResult !== null) {
                                    $customerAlinan = $customerQueryResult['alinan_para'];
                                    $customerOdeyecegi = $customerQueryResult['odeyecegi_para'];
                                } else {
                                    $customerAlinan = 'N/A'; // or set to a default value
                                    $customerOdeyecegi = 'N/A'; // or set to a default value
                                }
                            } else {
                                $customerName = "Bilinmeyen Müşteri";
                            }
                            ?>
                            <tr onclick="window.location='customer-details.php?id=<?= $row['musteri_id'] ?>'">
                                <td><?= $customerName ?></td>
                                <td><?= $customerTc ?></td>
                                <td><?= $customerData['musteri_pasaport_no'] ?></td>
                                <td><?= $row['randevu_gidecegi_ulke'] ?></td>
                                <td><?= $row['randevu_seyahat_tarihi'] ?></td>
                                <td><?= $row['randevu_tarihi_saati'] ?></td>
                                <td><?= $customerAlinan ?> €</td>
                                <td><?= $customerOdeyecegi ?> €</td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <?php
        } else {
            echo "Veri bulunamadı.";
        }
        ?>
    </div>
</div>

<?php include('../include/footer.php'); ?>
