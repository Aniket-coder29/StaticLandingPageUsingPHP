<?php
    $name = $email = $message = "";
    $show="";

    $is_page_refreshed = (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
 
    if($is_page_refreshed ) {
      // This Page Is refreshed
      $name = $email = $message = "";
      $show="";
    } else {
      // This page is freshly visited. Not refreshed
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // getting the input in variables in order to do desired operation
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $message = test_input($_POST["message"]);

        // Simple validation
        if (empty($name) || empty($email) || empty($message)) {
            $show = "<p>Please fill out all fields.</p>";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $show = "<p>Invalid email format.</p>";
        } else {
            $show = "<p>Thank you for your message, $name!</p>";
            $name=$email=$message="";
            header("Refresh:3");
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page With Light/Dark Mode</title>
    <link rel="stylesheet" href="mix.css" />
  </head>
  <body>
    <main>
      <div class="big-wrapper light">
        <img src="./img/shape.png" alt="" class="shape" />

        <header>
          <div class="container">
            <div class="logo">
              <img src="./img/logo.png" alt="Logo" />
              <h3>Co-Reading</h3>
            </div>

            <div class="links">
              <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#" class="btn">Sign up</a></li>
              </ul>
            </div>

            <div class="overlay"></div>

            <div class="hamburger-menu">
              <div class="bar"></div>
            </div>
          </div>
        </header>

        <div class="showcase-area">
          <div class="container">
            <div class="left">
              <div class="big-title">
                <h1>Future is here,</h1>
                <h1>Start Exploring now.</h1>
              </div>
              <p class="text">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                Delectus eius distinctio odit, magni magnam qui ex perferendis
                vitae!
              </p>
              <div class="cta">
                <a href="#" class="btn">Get started</a>
              </div>
            </div>

            <div class="right">
              <img src="./img/person.png" alt="Person Image" class="person" />
            </div>
          </div>
        </div>

        <div class="form-area">
            <h3>Contact Us</h3>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#formC" class="contactForm" id="formC">
                <div class="formField">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
                </div>
                <div class="formField">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>
                </div>
                <div class="formField">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required><?php echo $message; ?></textarea><br><br>
                </div>
                <input class="btn" type="submit" name="submit" value="Submit"><br><br>
                <?php echo $show?>
            </form>
        </div>

        <div class="bottom-area">
          <div class="container">
            <button class="toggle-btn">
              <i class="far fa-moon"></i>
              <i class="far fa-sun"></i>
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- JavaScript Files -->

    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="./mix.js"></script>
  </body>
</html>