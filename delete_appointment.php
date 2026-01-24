<?php
include __DIR__ . '/db.connection/db_connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view_appointments.php");
    exit;
}

$id = intval($_GET['id']); // security

// Prepare statement (safe)
$stmt = $conn->prepare("DELETE FROM appointments WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // success
    header("Location: view_appointments.php?msg=deleted");
    exit;
} else {
    echo "Error deleting record!";
}

$stmt->close();
$conn->close();
