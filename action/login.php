<?php

session_start();

include('conn.php');

$ip_address = $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (empty($username) || empty($password)) {

        echo "Please enter both username and password.";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $stored_hashed_password = $row['password'];

        if (password_verify($password, $stored_hashed_password)) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;

            $log_query = "INSERT INTO logs (log_type, log_status, log_message, log_timestamp, uploader_ip) VALUES ('login', 1, 'Successful login attempt for user: $username', NOW(), ?)";
            $log_stmt = $conn->prepare($log_query);
            $log_stmt->bind_param("s", $ip_address);
            $log_stmt->execute();
            $log_stmt->close();

            echo 'success';
            exit;
        } else {

            echo "Invalid username or password.";

            $log_query = "INSERT INTO logs (log_type, log_status, log_message, log_timestamp, uploader_ip) VALUES ('login', 0, 'Failed login attempt for user: $username', NOW(), ?)";
            $log_stmt = $conn->prepare($log_query);
            $log_stmt->bind_param("s", $ip_address);
            $log_stmt->execute();
            $log_stmt->close();

            exit;
        }
    } else {
        echo "Invalid username or password.";

        $log_query = "INSERT INTO logs (log_type, log_status, log_message, log_timestamp, uploader_ip) VALUES ('login', 0, 'Failed login attempt for user: $username', NOW(), ?)";
        $log_stmt = $conn->prepare($log_query);
        $log_stmt->bind_param("s", $ip_address);
        $log_stmt->execute();
        $log_stmt->close();

        exit;
    }

    $stmt->close();
} else {
    header("Location: ../index");
    exit;
}

$conn->close();
?>
