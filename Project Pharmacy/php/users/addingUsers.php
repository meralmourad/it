<?php
    $message_error = "";
    $message_error2 = "";
    function nextID($x){
        $All_Id = json_decode(file_get_contents("../../json/users/ID.json"), true);

        $All_Id[$x]++;

        file_put_contents("../../json/users/ID.json", json_encode($All_Id, JSON_PRETTY_PRINT), LOCK_EX);

        return $All_Id[$x];
    }

    if (isset($_POST['submit'])){
        $message_error = "";
        $message_error2 = "";
        $new_user = array(
            "Id" => nextID('user'),
            "Name" => $_POST['name'],
            "Email" => $_POST['username'],
            "Password" => $_POST['password'],
            "Address" => $_POST['ad'],
            "PhoneNumber" => $_POST['phone'],
            "Admin" => false,
            "cart" => [],
            "History" => []
        );



        if(filesize("../../json/users/users.json") == 0){
            $first_record = array($new_user);

            $data_to_save = $first_record;
        }else{
            
            $old_records = json_decode(file_get_contents("../../json/users/users.json"), true);

            //Ensure that there is no user with the same data.
            foreach ($old_records as $user){
                if(strtolower($user['Name']) === strtolower($new_user['Name'])){
                    $message_error = "there is a user with the same name.";
                    goto here;
                }
                if($user['Email'] === $new_user['Email']){
                    $message_error2 = "there is a user with the same name.";
                    goto here;
                }
            }

            array_push($old_records, $new_user);

            $data_to_save = $old_records;
            
        }

        file_put_contents("../../json/users/users.json", json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX);
        
        header("Location: sign_in.php");
        here:
    }
?>