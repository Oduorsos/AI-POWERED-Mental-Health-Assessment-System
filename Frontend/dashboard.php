<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Mental Health Assessment</title>
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="chatbot.css" />

</head>

<body>
  <!-- Navbar (injected via JS) -->
  <div id="navbar-placeholder"></div>

  <!-- Notification Message Container -->
<div id="message-box" class="message-box hidden"></div>

  <main class="dashboard-main">
    <!-- ===== HEADER SECTION ===== -->
    <section class="dashboard-header">
      <div class="dashboard-user">
        <img src="assets/img6.webp" alt="User Avatar" class="user-avatar" />
        <div>
          <h2>Welcome ✨!</h2>
          <p>“Your mind is your most powerful tool — nurture it daily.”</p>
        </div>
      </div>
    </section>

    <!-- ===== DASHBOARD CARDS ===== -->
    <section class="dashboard-grid">
      <div class="dashboard-card">
        <h3>🌟Hey <?php echo htmlspecialchars($_SESSION['first_name'] ?? 'User'); ?> 😎!</h3>
        <p><strong>A clearer mind starts here.</strong></p>
      </div>

      <div class="dashboard-card mood-card">
        <h3><?php echo htmlspecialchars($_SESSION['first_name'] ?? 'User'); ?>, You Matter 💖</h3>
        <p>It’s okay to not be okay — but it’s not okay to stay that way.</p>
      </div>

      <div class="dashboard-card quote-card">
        <h3>Cheer Up 🔥</h3>
        <blockquote>“Your journey to better mental health begins today. 🏆”</blockquote>
      </div>
    </section>

    <!-- ===== ASSESSMENT SECTION ===== -->
    <section class="assessment-section" id="assessmentSection">
      <div class="assessment-container">
        <h2>Mental Health Assessment</h2><br><br>
        <p><h3>Help us know more about you and connect with you better.</h3></p><br>
        <button id="startAssessment" class="assessment-btn">Start Assessment</button>
      </div>
    </section>

    <!-- ===== CHATBOT SECTION ===== -->
    <div id="chatbot-overlay" class="chatbot-overlay hidden"></div>
    <div id="chatbot-container" class="chatbot-container hidden">
    <div class="chatbot-header">
      <h3>🧩Meet MindBot — Your Virtual Assessment Assistant</h3>
      <button id="closeChatbot">×</button>
    </div>

    <div id="chatbot-messages" class="chatbot-messages">
      <div class="bot-message">Hi <?php echo htmlspecialchars($_SESSION['first_name']); ?> 😊! Ready to begin your mental health assessment?</div>
    </div>

    <div class="chatbot-input">
      <input type="text" id="userInput" placeholder="Type your response..." />
      <button id="sendMessage">Send</button>
    </div>
    </div>

  </main>

  <!-- Optional loader -->
  <div id="page-loader" class="hidden">
    <div class="spinner"></div>
  </div>

  <!-- Footer -->
  <div id="footer-placeholder"></div>

  <script src="main.js"></script>
  <script src="chatbot.js"></script>

</body>
</html>
