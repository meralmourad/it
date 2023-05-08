<?php 
session_start();
$data = json_decode(file_get_contents("../../json/users/users.json"), true);

$error_message = "";
if (isset($_POST['submit'])){
    $username = $_POST['name'];
    $password = $_POST['password'];

    foreach ($data as $user) {
        if (strtolower($user["Name"]) === strtolower($username) && $user["Password"] === $password){
            $_SESSION['InfoUser'] = $user;
            header("Location: profile.php");
            exit();
        }
    }
    $error_message = "Invalid username or password";
}
?>