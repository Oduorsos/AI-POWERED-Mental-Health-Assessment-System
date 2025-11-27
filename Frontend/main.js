document.addEventListener("DOMContentLoaded", () => {
  // ===== NAVBAR INJECTION =====
  const header = document.createElement("header");
  header.innerHTML = `
    <nav>
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
        <li><a href="login.php" id="loginLink">Login</a></li>
        <li><a href="logout.php" id="logoutLink">Logout</a></li>
      </ul>
    </nav>
  `;
  document.body.prepend(header);

  // ===== NAVBAR STYLES =====
  const style = document.createElement("style");
  style.textContent = `
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: rgba(94, 218, 231, 0.95);
      backdrop-filter: blur(5px);
      padding: 20px 0;
      z-index: 1000;
      border-radius: 0 0 12px 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
    }

    header.nav-shrink {
      padding: 10px 0;
      background: rgba(94, 218, 231, 0.9);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    }

    nav {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 25px;
      align-items: center;
      margin: 0;
      padding: 0;
    }

    nav ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 17px;
      font-weight: 600;
      padding: 10px 18px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    nav ul li a:hover {
      background-color: rgba(255, 255, 255, 0.5);
      color: #fff;
      transform: scale(1.05);
    }

    @media (max-width: 768px) {
      nav ul {
        flex-direction: column;
        gap: 15px;
        background: rgba(74, 174, 229, 0.95);
        width: 100%;
        padding: 15px 0;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
      }

      nav ul li a {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px 0;
      }

      header.nav-shrink {
        background: rgba(74, 174, 229, 1);
      }
    }
  `;
  document.head.appendChild(style);

  // ===== FOOTER INJECTION =====
  const footerHTML = `
    <footer class="footer" id="contact">
      <div class="footer-container">
        <div class="row">
          <div class="footer-col">
            <h4>MENTAL HEALTH ASSESSMENT</h4>
            <p>Building awareness, promoting wellness, and empowering healthier minds for everyone.</p>
            <p><strong><i>Your peace of mind matters.</i></strong></p>
          </div>

          <div class="footer-col">
            <h4>Platform</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="homepage.php">Register</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="#">Assessments</a></li>
              <li><a href="#">Community</a></li>
            </ul>
          </div>

          <div class="footer-col">
            <h4>Resources</h4>
            <ul>
              <li><a href="#">Articles</a></li>
              <li><a href="#">Therapist Directory</a></li>
              <li><a href="#">FAQs</a></li>
              <li><a href="#contact">Contact Us</a></li>
            </ul>
          </div>

          <div class="footer-col">
            <h4>Stay Connected</h4>
            <p>Subscribe to our newsletter to receive updates, mental health tips, and support resources.</p>
            <form action="#" method="post" class="newsletter-form">
              <input type="email" name="email" placeholder="Enter your email address" required>
              <div class="subscribe-btn-container">
                <button type="submit">Subscribe</button>
              </div>
            </form>
            <p>📞 Call: +254 700 000 000</p>
            <p>✉️ Email: <a href="mailto:info@mentalhealth.org">info@mentalhealth.org</a></p>
          </div>
        </div>

        <div class="bottom-bar">
          <p>&copy; 2025 Mental Health Assessment. All Rights Reserved.</p>
        </div>
      </div>
    </footer>
  `;

  const footerPlaceholder = document.getElementById("footer-placeholder");
  if (footerPlaceholder) {
    footerPlaceholder.innerHTML = footerHTML;
  } else {
    document.body.insertAdjacentHTML("beforeend", footerHTML);
  }

  // ===== SMOOTH SCROLL TO FORM =====
  window.scrollToForm = function () {
    const formSection = document.getElementById("register-form");
    if (!formSection) return;

    formSection.scrollIntoView({ behavior: "smooth" });
    const form = formSection.querySelector(".register-form");
    if (form) {
      form.classList.add("glow-highlight");
      setTimeout(() => form.classList.remove("glow-highlight"), 2000);
    }
  };

  // ===== NAVBAR SHRINK ON SCROLL =====
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      header.classList.add("nav-shrink");
    } else {
      header.classList.remove("nav-shrink");
    }
  });
});

// ===== PAGE LOADER CONTROL =====
window.addEventListener("load", () => {
  const loader = document.getElementById("page-loader");
  setTimeout(() => {
    loader.classList.add("hidden");
  }, 800); // 1.5 seconds loading time
});

// Show loader again when navigating away
document.querySelectorAll("a").forEach(link => {
  link.addEventListener("click", e => {
    const href = link.getAttribute("href");
    if (href && !href.startsWith("#") && !href.startsWith("javascript")) {
      e.preventDefault();
      document.getElementById("page-loader").classList.remove("hidden");
      setTimeout(() => {
        window.location.href = href;
      }, 800);
    }
  });
});
document.getElementById("loginForm").addEventListener("submit", function(e) {
  e.preventDefault();
  const loader = document.getElementById("page-loader");
  loader.classList.remove("hidden");
  // simulate processing or actual login
  setTimeout(() => {
    window.location.href = "dashboard.php";
  }, 800);
});
// On form submit
const form = document.querySelector(".register-form"); // your form selector
form.addEventListener("submit", (e) => {
  e.preventDefault(); // prevent default submit
  const requiredFields = ["first_name", "last_name", "email", "age", "password", "confirm-password"];
  let allFilled = true;

  requiredFields.forEach(id => {
    const field = document.getElementById(id);
    const error = field.nextElementSibling; // assumes error <span> is next
    if (!field.value.trim()) {
      field.style.borderColor = "#ff5555";
      if (error) error.textContent = "This field is required";
      allFilled = false;
    } else {
      field.style.borderColor = "#3cc47c"; // green if filled
      if (error) error.textContent = "";
    }
  });

  // Password match validation
  const password = document.getElementById("password");
  const confirm = document.getElementById("confirm-password");
  const confirmError = confirm.nextElementSibling;

  if (password.value && confirm.value) {
    if (password.value !== confirm.value) {
      confirm.style.borderColor = "#ff5555"; // red border
      if (confirmError) confirmError.textContent = "Passwords do not match";
      allFilled = false;
    } else {
      confirm.style.borderColor = "#3cc47c"; // green border
      if (confirmError) confirmError.textContent = "";
    }
  }

  if (allFilled) {
    console.log("Form is valid, submit data!");
    form.reset();
    // Optionally reset border colors
    requiredFields.forEach(id => document.getElementById(id).style.borderColor = "#ccc");
  }
});
