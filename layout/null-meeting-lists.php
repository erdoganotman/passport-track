<?php
include('../include/header.php');
include(__DIR__.'/../backend/table-list/null-meeting-list.php');

// Get the current page number from the URL, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

$query = $conn->query("SELECT randevu_id, musteri_id, randevu_gidecegi_ulke,randevu_seyahat_tarihi,randevu_tarihi_saati FROM randevu ORDER BY randevu_tarihi_saati ASC LIMIT $records_per_page OFFSET $offset");
if ($conn->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);
?>
<div class="dis-alan " style="display: flex;">
<div><?php include('../include/meeting-left-main.php');?> </div>
    <div style="width: 100%;height:420px;">
        <?php
        // Get today's date
        $today = date("Y-m-d");

        // Check if the $result variable is set (results from the database query)
        if ($result) {
            ?>
            <table border='1' class='table' style='height:80px'>
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
    // Check if the appointment date is equal to "0000-00-00 00:00:00"
    if ($row['randevu_tarihi_saati'] == "0000-00-00 00:00:00") {
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
            <?php
            // Bootstrap pagination ile sayfalama bağlantılarını ekle
            $totalRows = $conn->query("SELECT COUNT(*) as total FROM randevu WHERE randevu_tarihi_saati = '0000-00-00 00:00:00'")->fetch_assoc()['total'];
            $totalPages = ceil($totalRows / $records_per_page);

            if ($totalPages > 1) {
                echo '<nav aria-label="Page navigation">';
                echo '<ul class="pagination">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                echo '</ul>';
                echo '</nav>';
            }

        } else {
            echo "Veri bulunamadı.";
        }
        ?>
    </div>
</div>
<?php include('../include/footer.php'); ?>
<style>
    .table{
        height: 400px;
        text-transform: capitalize;
    }
    @media only screen and (max-width: 768px) {
    /* Tablo sütunlarını dikey sıraya düşürmek */
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    /* Tablo başlıklarını gizlemek */
    table th {
        display: none;
    }

    /* Tablo satırlarını dikey sıraya düşürmek */
    table td {
        display: block;
        text-align: left;
    }

    /* Tablo satırlarına boşluk eklemek */
    table tr {
        margin-bottom: 15px;
    }

    /* Tablo satır arkaplanını belirlemek */
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Tablo satırlarını hizalamak */
    table td:before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
    }
}
</style>
<script src="../asset/Script/null-meeting.js"></script>
