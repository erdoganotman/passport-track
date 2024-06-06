<?php
include(__DIR__.'/../connection/ajans-con.php');

if (isset($_POST['deleteCustomer'])) {
    $customerIdToDelete = $_POST['id'];

    // Begin a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Step 1: Delete from "odeme" table
        $deleteOdemeQuery = "DELETE FROM odeme WHERE musteri_id = ?";
        $deleteOdemeStmt = $conn->prepare($deleteOdemeQuery);
        $deleteOdemeStmt->bind_param("i", $customerIdToDelete);
        $deleteOdemeStmt->execute();
        $deleteOdemeStmt->close();

        // Step 2: Delete from "randevu" table
        $deleteRandevuQuery = "DELETE FROM randevu WHERE musteri_id = ?";
        $deleteRandevuStmt = $conn->prepare($deleteRandevuQuery);
        $deleteRandevuStmt->bind_param("i", $customerIdToDelete);
        $deleteRandevuStmt->execute();
        $deleteRandevuStmt->close();

        // Step 3: Delete from "musteri" table
        $deleteMusteriQuery = "DELETE FROM musteri WHERE musteri_id = ?";
        $deleteMusteriStmt = $conn->prepare($deleteMusteriQuery);
        $deleteMusteriStmt->bind_param("i", $customerIdToDelete);

        if ($deleteMusteriStmt->execute()) {
            // If all deletions are successful, commit the transaction
            $conn->commit();
            echo "success";
        } else {
            // If any deletion fails, rollback the transaction
            $conn->rollback();
            echo "error: " . $deleteMusteriStmt->error;
        }

        $deleteMusteriStmt->close();
    } catch (Exception $e) {
        // Handle exceptions, if any
        $conn->rollback();
        echo "error: " . $e->getMessage();
    }

    // Close the connection
    $conn->close();
    
    // Exit the script
    exit();
}
?>
