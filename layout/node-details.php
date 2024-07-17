<?php
include('../include/header.php');
include(__DIR__.'/../backend/node/node-detail.php');
?>
<div class="dis-alan"style="display: flex;">    
<div><?php include('../include/node-left-main.php') ?></div>
<div class="customer-right">
    <div style="width:100%;height:420px;">
    
    <h2>Müşteri Detayları</h2>

    <?php
    // Check if the $customerDetails, $customerDetails3, and $customerDetails2 variables are set
    if (isset($nodeDetails)) {
        echo "<table border='1' class='table' style='height:80px'>";
        echo "<tr>
                <th>Notlar</th>
                
            </tr>";

        // Display customer details
        echo "<tr>
                <td>" . $nodeDetails['notlar'] . "</td>
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
</style>    <?php
include('../include/header.php');
include(__DIR__.'/../backend/node/node-detail.php');
?>
<div class="dis-alan"style="display: flex;">    
<div><?php include('../include/node-left-main.php') ?></div>
<div class="customer-right">
    <div style="width:100%;height:420px;">
    
    <h2>Müşteri Detayları</h2>

    <?php
    // Check if the $customerDetails, $customerDetails3, and $customerDetails2 variables are set
    if (isset($nodeDetails)) {
        echo "<table border='1' class='table' style='height:80px; width:100%'>";
        echo "<tr>
                <th>Notlar</th>
                
            </tr>";

        // Display customer details
        echo "<tr>
                <td>" . $nodeDetails['notlar'] . "</td>
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
        width: 100%; /* add this line */
        height: 380px;
        text-transform: capitalize;
    }
</style>