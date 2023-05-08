<?php require("../../php/users/gettingData.php");
    if (isset($_SESSION['InfoUser'])) {
        header("Location: profile.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="../../photos/1842138.png">
        <title>Sign In</title>
        <link rel="stylesheet" href="../../css/users/login.css">
        <meta charset="UTF-8">
    </head>

    <body>
    <?php include("../../navBar/nav.php");?>

        <div class="signin">
            <h1>SignIn</h1>

            <form method="post">
                <label for="name">Username:</label><br>
                <input type="text" id="name" name="name"
                required><br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"
                required><br>

                <span class="error" ><?php echo $error_message; ?></span><br>
                <button type="submit" id="sub" name="submit">Login</button><br><br>
            </form>

            <pre>Don't have an account? <a href="sign_up.php">SignUp</a></pre>
        </div>
    <?php include("../../footer/footer.php");?>
    </body>
</html>