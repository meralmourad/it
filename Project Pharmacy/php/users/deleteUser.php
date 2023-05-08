<?php 
    session_start();
    if(isset($_GET["id"]) && $_SESSION['InfoUser']['Admin']){
        $id = $_GET["id"];

        $All_Users = json_decode(file_get_contents("../../json/users/users.json"), true);

        foreach ($All_Users as $user){
            if($id == $user['Id'] && $id != 1){// id 1 is the Admin user

                $index = array_search($user, $All_Users);
                
                unset($All_Users[$index]);
                
                file_put_contents("../../json/users/users.json", json_encode($All_Users, JSON_PRETTY_PRINT), LOCK_EX);

                break;
            }
        }
    }
    header("Location: ../../view/users/usersList.php");
?>