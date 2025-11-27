<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Mental Health Assessment</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <!-- Navbar placeholder (injected via JS) -->
  <div id="navbar-placeholder"></div>

  <main class="body-divs-section">
    <section class="top-div">
      <div class="top-content">
        <h1>Welcome Back</h1>
        <h3>Let’s Continue Your Journey to Mental Wellness</h3>
        <p>Your mind deserves clarity, calm, and balance.
          Sign in to continue your wellness journey.
        </p>
      </div>
    </section>

    <section class="container">
      <form id="loginForm" action="login_process.php" method="POST" class="register-form login-form">
        <h2>Login</h2>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required />

        <button type="submit" class="login-btn">Login</button>
        <p>Don't have an account? <a href="homepage.php">Register</a></p>
      </form>
    </section>
  </main>

  <!-- Loader -->
  <div id="page-loader" class="hidden">
    <div class="spinner"></div>
  </div>

  <!-- Footer placeholder -->
  <div id="footer-placeholder"></div>

  <script src="main.js"></script>
</body>
</html>
