<?php
    $message_error = "";
    $message_error2 = "";

    if (isset($_POST['submit'])){
        $message_error = "";
        $message_error2 = "";
        
        $old_records = json_decode(file_get_contents("../../json/users/users.json"), true);
        $userID = $_SESSION['InfoUser']["Id"];

        //Ensure that there is no user with the same data.
        foreach ($old_records as $user){
            if($user['Name'] === $_POST['name'] && $userID !== $user['Id']){
                $message_error = "there is a user with the same name.";
                goto here;
            }
            if($user['Email'] === $_POST['username'] && $userID !== $user['Id']){
                $message_error2 = "there is a user with the same Email.";
                goto here;
            }
        }

        foreach ($old_records as $user){
            if($userID === $user['Id']){

                $index = array_search($user, $old_records);
                unset($old_records[$index]);

                $afterUpdating = array(
                    "Id" => $userID,
                    "Name" => $_POST['name'],
                    "Email" => $_POST['username'],
                    "Password" => $_SESSION['InfoUser']['Password'],
                    "Address" => $_POST['ad'],
                    "PhoneNumber" => $_POST['phone'],
                    "Admin" => $_SESSION['InfoUser']['Admin'],
                    "cart" => $_SESSION['InfoUser']['cart'],
                    "History" => $_SESSION['InfoUser']['History']
                );

                array_push($old_records, $afterUpdating);

                $_SESSION['InfoUser'] = $afterUpdating;

                break;
            }
        }



        file_put_contents("../../json/users/users.json", json_encode($old_records, JSON_PRETTY_PRINT), LOCK_EX);
        unset($_SESSION['PassGood']);

        header("Location: profile.php");
        here:
    }
?>