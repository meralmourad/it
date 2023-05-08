<?php
if (isset($_POST['Submit'])){
    foreach ($_SESSION["InfoUser"]["cart"] as $id) {
        array_push($_SESSION["InfoUser"]["History"], $id);
    }
    $_SESSION["InfoUser"]["cart"] = [];

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
?>