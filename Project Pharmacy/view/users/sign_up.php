<?php require("../../php/users/addingUsers.php");
  session_start();
  if (isset($_SESSION['InfoUser'])) {
      header("Location: profile.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Sign Up</title>
      <link rel="icon" href="photos/1842138.png">
        <link rel="stylesheet" href="../../css/users/login.css">
      <script src="../script.js"></script>
      <meta charset="UTF-8">
  </head>

  <body>
  <?php include("../../navBar/nav.php");?>

    <div class="signup">
      <h1>Register</h1>

      <form onsubmit="return validateForm(this)" method="post">
          
          <label for="name">Name:</label><br>
          <input type="text" id="name" name="name"
          required
          minlength="3"
          oninput="setCustomValidity('')"
          oninvalid="this.setCustomValidity('Enter Your Name Here')"><br>
          <span class="error" style="color: rgb(172,0,0); font-family:'Gill Sans';"><?php echo $message_error; ?></span><br>

          <label for="email">Email:</label><br>
          <input type="email" id="email" name="username"
          required
          minlength="7"><br>
          <span class="error" style="color: rgb(172,0,0); font-family:'Gill Sans';"><?php echo $message_error2; ?></span><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password"
          required
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
          title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br><br>

          <label for="confirm">Confirm password:</label><br>
          <input type="password" id="confirm" name="confirm"
          required>
          <span id="passError" style="color: rgb(172,0,0); font-family:'Gill Sans';"></span><br><br>

          <label for="ad">Address:</label><br>
          <input type="text" id="ad" name="ad"
          required
          minlength="10"><br><br>

          <label for="phone">Phone Number:</label><br>
          <input type="text" id="phone" name="phone"
          required
          pattern="^\d+$"><br><br>

          <button type="submit" id="sub" name="submit">SignUp</button><br>

          <pre>Already have an account? <a style="color: white; font-size: 17px; text-decoration: underline" href="sign_in.php">Login</a></pre>

      </form>

    </div>
    <?php include("../../footer/footer.php");?>
  </body>
</html>