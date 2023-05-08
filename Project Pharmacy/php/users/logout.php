<?php
    session_start();
    session_destroy();
    header("Location: ../../view/users/sign_in.php");
?>