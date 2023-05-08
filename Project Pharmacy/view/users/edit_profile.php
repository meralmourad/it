<?php
session_start();

if(! isset($_SESSION['InfoUser']) || !isset($_SESSION['PassGood'])){
  header("Location: profile.php");
}
require("../../php/users/updateInfo.php");
require("../../php/users/editingData.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <title>Edit Profile</title>
      <link rel="icon" href="../../photos/1842138.png">
      <link rel="stylesheet" href="../../css/users/profile.css">
      <script src="../script.js"></script>
      <meta charset="UTF-8">
  </head>

  <body>
  <?php include("../../navBar/nav.php");?>
    <div class="signup">
      <form onsubmit="return validateForm(this)" method="post">
         <table> 
         <tr>
            <th rowspan = "5" style="text-align: center !important ; width: 30% !important">
                <img id = "profphoto" src="../../photos/profile.jpg">
            </th>       
          </tr>
          <tr>
            <th>
              <label for="name">Name:</label>
            </th>
            <td>
              <input type="text" id="name" name="name" autofocus value="<?php echo $_SESSION['InfoUser']['Name']; ?>"
              required
              minlength="3"
              oninput="setCustomValidity('')"
              oninvalid="this.setCustomValidity('Enter Your Name Here')">
            </td>
          </tr>

          <tr>
            <th>
              <label for="email">Email:</label>
            </th>
            <td>
              <input type="email" id="email" name="username" value="<?php echo $_SESSION['InfoUser']['Email']; ?>"
              required
              minlength="7">
            </td>
          </tr>

          <tr>
            <th>
              <label for="phone">Phone:</label>
            </th>
            <td>
              <input type="text" id="phone" name="phone" value="<?php echo $_SESSION['InfoUser']['PhoneNumber']; ?>"
              required
              pattern="^\d+$">
            </td>
          </tr>

          <tr>
            <th>
              <label for="ad">Address:</label>
            </th>
            <td>
              <input type="text" id="ad" name="ad" value="<?php echo $_SESSION['InfoUser']['Address']; ?>"
              required
              minlength="10">
            </td>
          </tr>
         </table>
         
         <button type="submit" id="sub" name="submit">submit</button>
         <hr id="table">
      </form>
    </div>
  </body>
</html>