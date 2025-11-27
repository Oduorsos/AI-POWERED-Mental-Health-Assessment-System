<?php
include 'db_connect.php';

// Optional: category filter, e.g. ?category=anxiety
$category = isset($_GET['category']) ? $_GET['category'] : null;

if ($category) {
    $stmt = $conn->prepare("SELECT * FROM questions WHERE category = ? ORDER BY id ASC");
    $stmt->bind_param("s", $category);
} else {
    $stmt = $conn->prepare("SELECT * FROM questions ORDER BY id ASC");
}

$stmt->execute();
$result = $stmt->get_result();

$questions = [];
while ($row = $result->fetch_assoc()) {
    // Decode options if JSON
    if (!empty($row['options'])) {
        $row['options'] = json_decode($row['options']);
    }
    $questions[] = $row;
}

header('Content-Type: application/json');
echo json_encode($questions);
?>
