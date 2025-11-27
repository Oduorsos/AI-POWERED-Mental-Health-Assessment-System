<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mental Health Assessment System</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <!-- Navbar injected by JS -->
  <div id="navbar-placeholder"></div>

  <main class="body-divs-section">
    <!-- ===== HERO / INTRO SECTION ===== -->
    <section class="top-div">
      <div class="top-content">
        <h1><span class="highlight">Empower Your Mind</span></h1>
        <h3>Your Journey to Clarity, Balance, and Strength</h3>
        <p>
          Every great change begins with understanding yourself.
          Through this mental health assessment, you can explore your feelings,
          uncover insights, and take steps toward better mental wellness.
        </p>
        <p><i>Because a peaceful mind is a powerful one.</i></p>
        <button class="get-started-btn" onclick="scrollToForm()">Get Started</button>
      </div>
    </section>

    <!-- ===== REGISTRATION FORM ===== -->
    <section class="container" id="register-form">
      <form id="registerForm" action="register.php" method="POST" class="register-form" novalidate>
        <h2>Create Your Account</h2>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required />

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required />

        <label for="age">Age Group</label>
        <select id="age" name="age" required>
          <option value="" disabled selected>Select your age group</option>
          <option value="10-14">10 - 14</option>
          <option value="15-19">15 - 19</option>
          <option value="20-24">20 - 24</option>
          <option value="25-29">25 - 29</option>
          <option value="30-34">30 - 34</option>
          <option value="35-39">35 - 39</option>
          <option value="40-44">40 - 44</option>
          <option value="45-49">45 - 49</option>
          <option value="50-54">50 - 54</option>
          <option value="55-59">55 - 59</option>
          <option value="60-100">60 - 100</option>
        </select>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required />

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="At least 8 characters" required />
        <small id="passwordMessage" class="error-message"></small>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Should match the above" required />

        <p class="terms-section">
          <input type="checkbox" id="terms" name="terms" required />
          <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
        </p>

        <button type="submit" class="register-btn">Register</button>
        <p>Already have an account? <a href="login.php">Log in</a></p>
      </form>
    </section>

    <!-- ===== TESTIMONIALS SECTION ===== -->
    <section class="testimonials-section">
      <div class="testimonial-overlay">
        <div class="testimonial-content">
          <h2>What People Are Saying</h2>
          <div class="testimonial-cards">
            <div class="testimonial-card">
              <p>“This platform helped me rediscover peace of mind and connect with people who truly care.”</p>
              <h4>- Sarah N.</h4>
            </div>
            <div class="testimonial-card">
              <p>“Understanding my emotions became easier after using this platform — it’s a life-changing experience.”</p>
              <h4>- Brian M.</h4>
            </div>
            <div class="testimonial-card">
              <p>“Sometimes all you need is a little guidance and compassion. This space provides both.”</p>
              <h4>- Thomas B.</h4>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ===== FOOTER ===== -->
  <div id="footer-placeholder"></div>

  <!-- ===== LOADER ===== -->
  <div id="page-loader" class="hidden">
    <div class="spinner"></div>
  </div>

  <script src="main.js"></script>
</body>
</html>
