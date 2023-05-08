<?php 
$Register = false;

$data = json_decode(file_get_contents("../../json/users/users.json"), true);
foreach($data as $user){
    if($user["Id"] == $_SESSION['InfoUser']["Id"]){
        $_SESSION['InfoUser'] = $user;
        $Register = true;
        break;
    }
}
if(! $Register){
    echo '<script>alert("The account is not registered.");
        window.location.href="../../php/users/logout.php";</script>';
}
?>