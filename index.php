<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="Public/Bootstrap v5.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="Public/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css">
    <?php
      session_start();
      $host = 'localhost';
       $dbname = 'kd printing services';
      $username = 'root';
      $password = '';
      try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
      }
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;
      require 'phpmailer/src/Exception.php';
      require 'phpmailer/src/PHPMailer.php';
      require 'phpmailer/src/SMTP.php';
      $mail = new PHPMailer(true);
      $email = '';
      $password = '';
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['signup-submit'])) {
          $fullname = $_POST['fullname'];
          $email = $_POST['email'];
          $address = $_POST['address'];
          $password = $_POST['password'];
          session_start();
            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $address;
            $_SESSION['password'] = $password;
          try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'labatete.johnkennethg.kld@gmail.com';
            $mail->Password   = 'qeru jumu rpbh ybno';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom('labatete.johnkennethg.kld@gmail.com', 'John Kenneth');
            $mail->addAddress($email);
            $mail->addReplyTo('labatete.johnkennethg.kld@gmail.com', 'John Kenneth');
            $mail->isHTML(true);
            $mail->Subject = 'Verify Registration';
            $mail->Body    = 'Please click the link to verify your account: <a href="http://localhost/KD Printing Services/database.php">Click Me!</a><p>Ignore if you didn\'t register</p>';
            $mail->AltBody = 'Please click the link to verify your account: http://localhost/KD Printing Services/database.php';
            $mail->send();
            header('Location: https://mail.google.com');
          } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          }
        } else if (isset($_POST['login-submit'])) {
          try {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = 'SELECT * FROM account WHERE email = :email AND password = :password';
            $stmt = $conn->prepare($sql);
            $stmt->execute(['email' => $email, 'password' => $password]);
            if ($stmt->rowCount() > 0) {
              $_SESSION['email'] = $email;
              $_SESSION['password'] = $password;
              header('Location: http://localhost/KD Printing Services/index.php');
              exit();
            } else {
              header('Location: http://localhost/KD Printing Services/ProductPage.html');
              exit();
            }
          } catch (PDOException $e) {
            die("Could not login account from $dbname, account does not exists : " . $e->getMessage());
          }
        } else if (isset($_POST['logout'])) {
          session_destroy();
          header('Location: http://localhost/KD Printing Services/index.php');
          exit();
        }
      }
    ?>
  </head>
  <body>
    <div>
      <nav class="navbar">
        <div class="container-fluid">
          <div class="col-md-6 logo-container" style="margin-top: 20px;">
            <img src="Images\logokd.png" alt="Logo">
            <h1>Printing Services</h1>
          </div>
          <div class="col-md-5 navbar-links text-right navbar-right" style="margin-top: 75px;;">
            <a class="active" href="index.php" target="_self" style="color: red;">
              <i class="fa fa-fw fa-home"></i> Home </a>
            <a href="ProductPage.html" style="color: orange;">
              <i class="fa fa-fw fa-file"></i> Products </a>
            <a href="ContactsPage.html" style="color: green;">
              <i class="fa fa-fw fa-envelope"></i> Contacts </a>
            <?php
              if (isset($_SESSION['email'])) {
                $email = $_SESSION['email'];
                $sql = 'SELECT fullname FROM account WHERE email = :email';
                $stmt = $conn->prepare($sql);
                $stmt->execute(['email' => $email]);
                $row = $stmt->fetch();
                $fullname = $row['fullname'];

                echo '<form method="POST" action=""><button type="submit" name="logout" class="btn">Welcome, '.$fullname.' (Logout)</button></form>';
              } else {
                echo '<button type="button" class="btn" style="color: rgb(242, 242, 245); background: linear-gradient(45deg,blue, indigo, violet);">Login/Sign up</button>';
              }
            ?>
          </div>
        </div>
      </nav>
    </div>
    <div class="carousel-container">
      <button class="carousel-btn left">&#10094;</button>
      <div class="carousel-wrapper">
        <div class="carousel-track">
          <img src="Images/1.jpg" alt="Image 1">
          <img src="Images/2.jpg" alt="Image 2">
          <img src="Images/3.jpg" alt="Image 3">
          <img src="Images/4.jpg" alt="Image 4">
          <img src="Images/5.jpg" alt="Image 5">
          <img src="Images/3.jpg" alt="Image 6">
          <img src="Images/1.jpg" alt="Image 1">
          <img src="Images/2.jpg" alt="Image 2">
          <img src="Images/3.jpg" alt="Image 3">
          <img src="Images/4.jpg" alt="Image 4">
          <img src="Images/5.jpg" alt="Image 5">
          <img src="Images/3.jpg" alt="Image 6">
        </div>
      </div>
      <button class="carousel-btn right">&#10095;</button>
    </div>
    <div id="loginModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <span class="close" id="closeModalBtn">&times;</span>
          <h1 style="color:white;">Login</h1>
          <form id="Login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" id="email" name="email" required placeholder="Enter email" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" required placeholder="Enter password" class="form-control">
              </div>
            </div>
            <div class="button-container">
              <button type="submit" name="login-submit" style="background-color: rgb(255, 253, 255); height: 30px; width: 200px;">Login</button>
            </div>
          </form>
          <hr>
          <div class="social-login">
            <button class="facebook-btn" style="background-color: rgb(89, 89, 250); height: 50px; width: 200px;">
              <i class="fab fa-facebook"></i> Continue with Facebook </button>
            <button class="google-btn" style="background-color: white; margin-top: 5px; height: 50px; width: 200px;">
              <i class="fab fa-google"></i> Continue with Google </button>
          </div>
          <p class="register-text" style="margin-top: 10px;">Don't have an account? <a href="#" id="registerLink">Register now</a>
          </p>
        </div>
      </div>
    </div>
    <div id="signupModal" class="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <span class="close" id="closeModalBtn">&times;</span>
          <h1>Signup</h1>
          <form id="Signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" id="fullname" name="fullname" required placeholder="Enter your fullname" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email" id="email" name="email" required placeholder="Enter your email" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-location-dot"></i>
                </span>
                <input type="text" id="address" name="address" required placeholder="Enter your complete address" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" required placeholder="Enter password" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label>
                <input type="checkbox" id="termsCheckbox" required> I agree to the <a href="terms-and-conditions.html" target="_blank">Terms and Conditions</a>. </label>
            </div>
            <div class="button-container">
              <button type="submit" name="signup-submit" style="background-color: rgb(255, 253, 255); height: 30px; width: 200px;">Create Account</button>
            </div>
            <p class="login-text" style="margin-top: 10px;">Already have an account? <a href="#" id="loginLink">Log in</a>
            </p>
          </form>
        </div>
      </div>
    </div>
    <script src="Public/Bootstrap v5.3.5/js/bootstrap.bundle.min.js"></script>
    <script>
      const loginModal = document.getElementById("loginModal");
      const signupModal = document.getElementById("signupModal");
      const loginBtn = document.querySelector(".btn");
      const registerLink = document.getElementById("registerLink"); 
      const closeLoginModal = document.querySelector("#loginModal .close");
      const closeSignupModal = document.querySelector("#signupModal .close");
      loginBtn.addEventListener("click", function() {
        loginModal.style.display = "flex";
      });
      registerLink.addEventListener("click", function() {
        loginModal.style.display = "none";
        signupModal.style.display = "flex";
      });
      loginLink.addEventListener("click", function() {
        signupModal.style.display = "none";
        loginModal.style.display = "flex";
      });
      closeLoginModal.addEventListener("click", function() {
        loginModal.style.display = "none";
      });
      closeSignupModal.addEventListener("click", function() {
        signupModal.style.display = "none";
      });
      window.addEventListener("click", function(event) {
        if (event.target === loginModal) {
          loginModal.style.display = "none";
        }
        if (event.target === signupModal) {
          signupModal.style.display = "none";
        }
      });
    </script>
    <script>
      const track = document.querySelector('.carousel-track');
      const images = document.querySelectorAll('.carousel-track img');
      const prevButton = document.querySelector('.carousel-btn.left');
      const nextButton = document.querySelector('.carousel-btn.right');
      let index = 0;
      const totalImages = images.length;
      const visibleImages = 3;
      const imageWidth = images[0].offsetWidth + 20;
      let autoSlideInterval;
      function updateActiveImage() {
        images.forEach(img => img.classList.remove('active'));
        if (index + 1 < totalImages) {
          images[index + 1].classList.add('active');
        }
      }
      function moveCarousel() {
        track.style.transition = "transform 0.5s ease-in-out";
        track.style.transform = `translateX(-${(index + 1) * imageWidth}px)`;
        updateActiveImage();
      }
      function nextSlide() {
        if (index >= totalImages - visibleImages) {
          index++;
          moveCarousel();
          setTimeout(() => {
            track.style.transition = "none";
            index = 0;
            track.style.transform = `translateX(-${imageWidth}px)`;
          }, 500);
        } else {
          index++;
          moveCarousel();
        }
      }
      function prevSlide() {
        if (index <= 0) {
          index--;
          moveCarousel();
          setTimeout(() => {
            track.style.transition = "none";
            index = totalImages - visibleImages;
            track.style.transform = `translateX(-${(index + 1) * imageWidth}px)`;
          }, 500);
        } else {
          index--;
          moveCarousel();
        }
      }
      function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 3000);
      }
      function stopAutoSlide() {
        clearInterval(autoSlideInterval);
      }
      nextButton.addEventListener('click', () => {
        nextSlide();
        stopAutoSlide();
        startAutoSlide();
      });
      prevButton.addEventListener('click', () => {
        prevSlide();
        stopAutoSlide();
        startAutoSlide();
      });
      track.addEventListener('mouseenter', stopAutoSlide);
      track.addEventListener('mouseleave', startAutoSlide);
      startAutoSlide();
      updateActiveImage();
    </script>
  </body>
</html>