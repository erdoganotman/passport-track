<?php
include('../include/header.php');
include(__DIR__.'/../backend/table-list/payment-list.php');
include(__DIR__.'/../backend/customer/customer-delete.php');
?>
<div class="dis-alan" style="display: flex;">
    <div class="table-container">
        <?php
        // Sayfa numarasını al
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        // Sayfa başına gösterilecek müşteri sayısı
        $pageSize = 10;
        // Başlangıç indeksi hesapla
        $startIndex = ($page - 1) * $pageSize;

        // Veritabanından müşteri listesini al
        $result = $conn->query("SELECT * FROM odeme LIMIT $startIndex, $pageSize");

        // Check if the $result variable is set (results from the database query)
        if ($result) {
            ?>
            <div class="table-wrapper">
            <table border='1' class='table' style='height:80px'>
                <tr>
                    <th>Müşteri Adı ve Soyadı</th>
                    <th>Müşteri T.C Kimlik No</th>
                    <th>Müşteri Pasaport</th>
                    <th>Alınan Ücret</th>
                    <th>Ödenecek Ücret</th>
                </tr>
                <?php
                // Loop through each result and create a table row
                foreach ($result as $row) {
                    // Query to get customer name and surname using musteri_id
                    $customerQuery = $conn->query("SELECT musteri_adi, musteri_soyadi, musteri_tc, musteri_pasaport_no FROM musteri WHERE musteri_id = " . $row['musteri_id']);
                    if ($customerQuery) {
                        $customerData = $customerQuery->fetch_assoc();
                        $customerName = $customerData['musteri_adi'] . ' ' . $customerData['musteri_soyadi'];
                        $customerTc = $customerData['musteri_tc'];
                        $customerPasaport = $customerData['musteri_pasaport_no'];
                    } else {
                        $customerName = "Bilinmeyen Müşteri";
                    }
                    ?>
                    <tr onclick="window.location='customer-details.php?id=<?= $row['musteri_id'] ?>'">
                        <td><?= $customerName ?></td>
                        <td><?= $customerTc ?></td>
                        <td><?= $customerPasaport ?></td>
                        <td><?= $row['alinan_para'] ?> €</td>
                        <td><?= $row['odeyecegi_para'] ?> €</td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <?php
            // Bootstrap pagination ile sayfalama bağlantılarını ekle
            $totalRows = $conn->query("SELECT COUNT(*) as total FROM odeme")->fetch_assoc()['total'];
            $totalPages = ceil($totalRows / $pageSize);

            if ($totalPages > 1) {
                echo '<nav aria-label="Page navigation">';
                echo '<ul class="pagination">';
                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Geri</a></li>';
                }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                }
                if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">İleri</a></li>';
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
</div>

<?php include('../include/footer.php'); ?>
<style>
    .table{
        height: 380px;
        text-transform: capitalize;
    }
</style>
