<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $age_group = trim($_POST['age']);
    $password_raw = $_POST['password'];

    if (empty($first_name) || empty($last_name) || empty($email) || empty($age_group) || empty($password_raw)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit();
    }

    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered. Please log in instead.'); window.location.href='login.php';</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, age_group, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $age_group, $password);

    if ($stmt->execute()) {

        $_SESSION['user_email'] = $email;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;

        echo "<script>
            alert('Registration successful! Redirecting to dashboard...');
            setTimeout(() => { window.location.href='dashboard.php'; }, 500);
        </script>";
    } else {
        echo "<script>alert('Error during registration: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
    $check->close();
    $conn->close();
}
?>
