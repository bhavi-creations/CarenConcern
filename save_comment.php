<?php
// ====================================================
// ERROR / DEBUG MODE
// ====================================================
error_reporting(E_ALL);
ini_set('display_errors', ($_SERVER['SERVER_NAME'] == 'localhost') ? 1 : 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . "/php_error.log");

// ====================================================
// DATABASE CONNECTION
// ====================================================
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "carenconcern"; // Local DB
    
} 



else {
    $host = "localhost";
    $user = "";     
    $pass = "";       
    $db   = "";    
}

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    $msg = "❌ Database connection failed: " . $conn->connect_error;
    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        die($msg);
    } else {
        error_log($msg);
        die("We are facing a technical issue. Please try again later.");
    }
}

// ====================================================
// HANDLE COMMENT FORM SUBMISSION
// ====================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize input
    $blog_id    = isset($_POST['blog_id']) ? intval($_POST['blog_id']) : 0;
    $user_name  = isset($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $user_email = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
    $comment    = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    // Determine redirect URL
    $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/';

    // Validation
    if ($blog_id <= 0 || empty($user_name) || empty($user_email) || empty($comment)) {
        echo "<script>alert('⚠️ All fields are required.'); window.history.back();</script>";
        $conn->close();
        exit;
    }

    // Insert comment using prepared statement
    $stmt = $conn->prepare("
        INSERT INTO blog_comments (blog_id, user_name, user_email, comment, likes, dislikes, created_at)
        VALUES (?, ?, ?, ?, 0, 0, NOW())
    ");

    if (!$stmt) {
        $msg = "❌ Prepare failed: " . $conn->error;
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            die($msg);
        } else {
            error_log($msg);
            echo "<script>alert('❌ Something went wrong. Please try again later.'); window.history.back();</script>";
            $conn->close();
            exit;
        }
    }

    $stmt->bind_param("isss", $blog_id, $user_name, $user_email, $comment);

    if ($stmt->execute()) {
        // Redirect back to the blog page and scroll to comments
        header("Location: $redirect_url#comments");
        exit;
    } else {
        $msg = "❌ Execute failed: " . $stmt->error;
        if ($_SERVER['SERVER_NAME'] == 'localhost') {
            die($msg);
        } else {
            error_log($msg);
            echo "<script>alert('❌ Error saving comment. Please try again later.'); window.history.back();</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>
