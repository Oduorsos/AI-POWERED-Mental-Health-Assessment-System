<?php
header('Content-Type: application/json');
include 'db_connect.php';

$input = json_decode(file_get_contents('php://input'), true);
$user_input = trim($input['message'] ?? '');
$user_email = $_SESSION['user_email'] ?? 'anonymous';

// fetch user’s history
$history_query = $conn->prepare("SELECT question, answer FROM user_responses WHERE email=? ORDER BY id DESC LIMIT 5");
$history_query->bind_param("s", $user_email);
$history_query->execute();
$history = $history_query->get_result()->fetch_all(MYSQLI_ASSOC);

// build prompt
$prompt = "You are an empathetic mental health assistant for MEDISOS.
User's recent responses: " . json_encode($history) . "
User just said: \"$user_input\".
Ask the next relevant mental health question or give supportive advice.";

// call the AI model (example with OpenAI)
$api_key = "YOUR_OPENAI_API_KEY";
$response = file_get_contents("https://api.openai.com/v1/chat/completions", false,
    stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\nAuthorization: Bearer $api_key\r\n",
            "content" => json_encode([
                "model" => "gpt-4o-mini",
                "messages" => [["role" => "user", "content" => $prompt]],
                "max_tokens" => 150
            ])
        ]
    ])
);
$output = json_decode($response, true);
$reply = $output['choices'][0]['message']['content'] ?? "I'm here to listen.";

// save response
$stmt = $conn->prepare("INSERT INTO user_responses (email, question, answer) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user_email, $user_input, $reply);
$stmt->execute();

echo json_encode(["reply" => $reply]);
?>
