<?php
session_start();

if(isset($_SESSION["InfoUser"])){
        foreach($_SESSION["InfoUser"]["cart"] as $item){
            if($item == intval($_GET["id"])){
                echo '<script>alert("You already added it");
                    window.location.href="../../view/products/ProductView.php";</script>';
                    exit();
            }
        }
        array_push($_SESSION["InfoUser"]["cart"], intval($_GET["id"]));

        $All_users = json_decode(file_get_contents("../../json/users/users.json"), true);
        foreach($All_users as $user){
            if($user["Id"] == $_SESSION["InfoUser"]["Id"]){
                $index = array_search($user, $All_users);
                $All_users[$index] = $_SESSION["InfoUser"];
                file_put_contents("../../json/users/users.json", json_encode($All_users, JSON_PRETTY_PRINT), LOCK_EX);
            }
        }
        header("Location: ../../view/products/ProductView.php");
}
else{
    echo '<script>alert("You have to log in.");
        window.location.href="../../view/users/sign_in.php";</script>';
}
?>