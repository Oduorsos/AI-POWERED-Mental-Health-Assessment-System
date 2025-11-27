<?php
session_start();
include 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$user_email = $_SESSION['user_email'];

// Get JSON data from the chatbot
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['question_id']) || !isset($data['question_text']) || !isset($data['response'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit();
}

$question_id = intval($data['question_id']);
$question_text = trim($data['question_text']);
$response = trim($data['response']);

$stmt = $conn->prepare("INSERT INTO user_responses (user_email, question_id, question_text, response) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $user_email, $question_id, $question_text, $response);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Response saved successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
