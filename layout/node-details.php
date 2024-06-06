<?php
include('../include/header.php');
include(__DIR__.'/../backend/node/node-list.php');
?>
<div class="dis-alan" style="display: flex;">
    <div></div>
    <div style="width: 100%;height:100%;">
        <?php
        // Sayfa numarasını al
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

        // Her sayfada gösterilecek müşteri sayısı
        $nodePage = 15;

        // Başlangıç kaydı
        $startFrom = ($page - 1) * $nodePage;

        // SQL sorgusuna LIMIT ve OFFSET ekle
        $query = $conn->query("SELECT * FROM notlar LIMIT $startFrom, $nodePage");

        // Bağlantı kontrolü
        if (!$query) {
            die("<b>Sorgu Hatası:</b> " . $conn->error);
        }

        // Check if the $result variable is set (results from the database query)
        if ($query) {
            echo "<form id='bulkDeleteForm' method='POST' action='../backend/node/node-bulk-delete.php'>";
            echo "<table border='1' class='table' style='height:80px';>";
            echo "<tr>
                    <th>Select</th>
                    <th>Notlar</th>
                </tr>";

            while ($row = $query->fetch_assoc()) {
                // Add a unique identifier to each row for JavaScript to identify
                echo "<tr class='node-row' data-node-id='" . $row['id'] . "'>
                        <td><input type='checkbox' name='selected_ids[]' value='" . $row['id'] . "'></td>
                        <td>" . $row['notlar'] . "</td>
                    </tr>";
            }

            echo "</table>";

            echo "<button type='submit'>Delete Selected</button>";
            echo "</form>";

            // JavaScript to handle row click event and redirect to customer details page
            echo "<script src='../asset/Script/node-list.js'>
                    </script>";

            // Sayfalama bağlantıları
            echo "<nav aria-label='Page navigation example'>";
            echo "<ul class='pagination'>";

            // Önceki sayfa bağlantısı
            if ($page > 1) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page - 1) . "'>Previous</a></li>";
            }

            // Sayfa sayıları
            $countQuery = $conn->query("SELECT COUNT(*) FROM musteri");
            if ($countQuery) {
                $totalPages = ceil($countQuery->fetch_assoc()['COUNT(*)'] / $nodePage);
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
            } else {
                die("<b>Sorgu Hatası:</b> " . $conn->error);
            }

            // Sonraki sayfa bağlantısı
            if ($query->num_rows >= $nodePage) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . ($page + 1) . "'>Next</a></li>";
            }

            echo "</ul>";
            echo "</nav>";
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
<?php include('../include/footer.php') ?>
