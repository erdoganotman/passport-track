<?php
include(__DIR__.'/../connection/ajans-con.php');

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['deletenode'])) {
    $nodeIdToDelete = $_POST['id'];

    // Begin a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        $deletenodeQuery = "DELETE FROM notlar WHERE id = ?";
        $deletenodeStmt = $conn->prepare($deletenodeQuery);
        $deletenodeStmt->bind_param("i", $nodeIdToDelete);

        if ($deletenodeStmt->execute()) {
            // If deletion is successful, commit the transaction
            $conn->commit();
            echo "success";
        } else {
            // If deletion fails, rollback the transaction
            $conn->rollback();
            echo "error: " . $deletenodeStmt->error;
        }

        $deletenodeStmt->close();
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
