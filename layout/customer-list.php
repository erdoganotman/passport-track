<?php
include('../include/header.php');
include(__DIR__.'/../backend/customer/customer-list.php');
?>
<div class="dis-alan" style="display: flex;">
    <div style="background-color: #818181;"><?php include('../include/customer-left-main.php'); ?> </div>
    <div class="table-container">
        <?php
        // Sayfa numarasını al
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Her sayfada gösterilecek müşteri sayısı
        $customersPerPage = 10;

        // Başlangıç kaydı
        $startFrom = ($page - 1) * $customersPerPage;

        // SQL sorgusuna LIMIT ve OFFSET ekle
        $query = $conn->query("SELECT * FROM musteri LIMIT $startFrom, $customersPerPage");

        // Bağlantı kontrolü
        if (!$query) {
            die("<b>Sorgu Hatası:</b> " . $conn->error);
        }

        // Check if the $result variable is set (results from the database query)
        if ($query) {
            ?>
            <div class="table-wrapper">
                <table border='1' class='table'>
                    <tr>
                        <th>Adı</th>
                        <th>Soyadı</th>
                        <th>Pasaport Numarası</th>
                        <th>T.C Kimlik No</th>
                        <th>Doğum Tarihi</th>
                    </tr>
                    <?php
                    while ($row = $query->fetch_assoc()) {
                        // Add a unique identifier to each row for JavaScript to identify
                        echo "<tr class='customer-row' data-customer-id='" . $row['musteri_id'] . "'>
                                <td>" . $row['musteri_adi'] . "</td>
                                <td>" . $row['musteri_soyadi'] . "</td>
                                <td>" . $row['musteri_pasaport_no'] . "</td>
                                <td>" . $row['musteri_tc'] . "</td>
                                <td>" . $row['musteri_dogum_tarihi'] . "</td>
                              </tr>";
                    }
                    ?>
                </table>
            </div>
            <?php
            // Sayfalama bağlantıları
            $countQuery = $conn->query("SELECT COUNT(*) FROM musteri");
            if ($countQuery) {
                $totalCustomers = $countQuery->fetch_assoc()['COUNT(*)'];
                $totalPages = ceil($totalCustomers / $customersPerPage);

                if ($totalPages > 1) {
                    echo '<nav aria-label="Page navigation example">
                            <ul class="pagination">';
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '</ul>
                        </nav>';
                }
            } else {
                die("<b>Sorgu Hatası:</b> " . $conn->error);
            }
        }
        ?>
    </div>
</div>
<style>
    .table{
        height: 380px;
        text-transform: capitalize;
    }
</style>
<script src="../asset/Script/customer-list.js"></script>
<?php 
include('../include/footer.php');
?>
