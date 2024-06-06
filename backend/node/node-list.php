<?php
include(__DIR__."/../connection/ajans-con.php");

$query = $conn->query("SELECT id, notlar FROM notlar");
if ($conn->errno > 0) {
    die("<b>Sorgu Hatası:</b> " . $conn->error);
}

$result = $query->fetch_all(MYSQLI_ASSOC);

?>
