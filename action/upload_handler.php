<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
include('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $allowed_types = ['image/jpeg', 'image/png', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        if (in_array($_FILES['file']['type'], $allowed_types) && $_FILES['file']['size'] <= $max_size) {

            $original_filename = $_FILES['file']['name'];

            $cleaned_filename = preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '_', $original_filename));

            $filename = uniqid() . '_' . $cleaned_filename;


            $upload_dir = 'uploads/';
            move_uploaded_file($_FILES['file']['tmp_name'], $upload_dir . $filename);

            $query = "INSERT INTO uploads (filename, user_id, upload_timestamp) VALUES (?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $filename, $user_id);
            $stmt->execute();
            $stmt->close();

            $upload_id = $conn->insert_id;

            $uploader_ip = $_SERVER['REMOTE_ADDR'];
            $log_query = "INSERT INTO logs (upload_id, uploader_ip, log_type, log_status, log_timestamp) VALUES (?, ?, 'upload', 1, NOW())";
            $log_stmt = $conn->prepare($log_query);
            $log_stmt->bind_param("is", $upload_id, $uploader_ip);
            $log_stmt->execute();
            $log_stmt->close();

            echo 'File uploaded successfully.';
        } else {

            $uploader_ip = $_SERVER['REMOTE_ADDR'];
            $log_query = "INSERT INTO logs (uploader_ip, log_type, log_status, log_message, log_timestamp) VALUES (?, 'upload', 0, 'Rejected upload: Invalid file type or size', NOW())";
            $log_stmt = $conn->prepare($log_query);
            $log_stmt->bind_param("s", $uploader_ip);
            $log_stmt->execute();
            $log_stmt->close();

            echo 'Invalid file type or size';
        }
    } else {
     
        $uploader_ip = $_SERVER['REMOTE_ADDR'];
        $log_query = "INSERT INTO logs (uploader_ip, log_type, log_status, log_message, log_timestamp) VALUES (?, 'upload', 0, 'Error uploading file', NOW())";
        $log_stmt = $conn->prepare($log_query);
        $log_stmt->bind_param("s", $uploader_ip);
        $log_stmt->execute();
        $log_stmt->close();

        echo 'Error uploading file.';
    }

    $conn->close();
} else {
    echo 'Invalid request method.';
}
