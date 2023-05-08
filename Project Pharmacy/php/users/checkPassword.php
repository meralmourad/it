<?php
    if(isset($_POST['submit'])){
        if($_POST['password'] === $_SESSION['InfoUser']['Password']){
            $_SESSION['PassGood'] = true;
            header("Location: edit_profile.php");
        }
        else{
            echo '<script>alert("Wrong Password");</script>';
        }
    }
?>