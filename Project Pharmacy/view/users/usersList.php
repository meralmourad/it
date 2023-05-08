<?php
    session_start();
    $search = "";
    $id = "0";
    if(! isset($_SESSION['InfoUser'])){
        header("Location: sign_in.php");
    }
    require("../../php/users/updateInfo.php");
    if(! $_SESSION['InfoUser']['Admin']){
        header("Location: profile.php");
    }
    $All_Users = json_decode(file_get_contents("../../json/users/users.json"), true);

    
    if(isset($_GET["search"])){
        $search = $_GET["search"];
    }
    foreach($All_Users as $user){
        if(strpos(strtolower($user["Name"]), strtolower($search)) === false){
            $index = array_search($user, $All_Users);
            unset($All_Users[$index]);
        }
    }

    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }
    if($id === "1"){
        usort($All_Users, function($a, $b) {
            return strcmp($a['Name'], $b['Name']);
        });
    }
    else if ($id === "2"){
        usort($All_Users, function($a, $b) {
            return strcmp($b['Name'], $a['Name']);
        });
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="icon" href="../../photos/1842138.png">
        <title>users List</title>
        <link rel="stylesheet" href="../../css/users/usersList.css">
        <script src="../script.js"></script>
        <meta charset="UTF-8">
    </head>

    <body>
    <?php include("../../navBar/nav.php");?>

    <div class="Table-container">
    <br>
    <form method="get" class="search" id="form">
        <div id="searchBar">
            <label for="id" hidden>id</label>
            <input id ="id" hidden name="id" value="<?php echo $id; ?>">
            <label for="search">Search: </label>
            <input id="search" type="search" name="search" value="<?php echo $search; ?>">
            <input type="submit" class='btn'>
        </div>
    </form><br>

    <ul class="tablelist">
        <li class="table-header">
            <div class="col col-1">Name</div>
            <div class="col col-2">Adress</div>
            <div class="col col-3">Email</div>
            <div class="col col-4">
                <a href="<?php echo '?id=1&search='.$search;?>"><img class="sort" src="../../photos/U.png" title="A-Z"></a>
            </div>
            
            <div class="col col-5">
                <a href="<?php echo '?id=2&search='.$search;?>"><img class="sort" src="../../photos/D.png" title="A-Z"></a>
            </div>
        </li>
        
        <?php
            foreach($All_Users as $user){
                if($user["Id"] === $_SESSION['InfoUser']["Id"])
                    continue;
                    
                echo '<li class="table-row">
                    <div class="col col-1">'.$user["Name"].'</div>

                    <a href="../../view/users/prodileDetails.php?id='.$user["Id"].'">
                        <img src="../../photos/Details.png"
                        title = "Details">
                    </a>
                    
                    <div class="col col-2">'.$user["Address"].'</div>
                    <div class="col col-3">'.$user["Email"].'</div>
                    <div class="col col-4"><button class="btnDelete" onclick="confirmDeleteUser('.$user["Id"].')">delete</button></div>';
                if(! $user["Admin"])
                    echo '<div class="col col-5"><button class="btn" onclick="window.location.href = &quot;../../php/users/changeAdmin.php?id='.$user["Id"].'&quot;">Make Admin</button></div>
                    </li>';
                else
                    echo '<div class="col col-5"><button class="btn" onclick="window.location.href = &quot;../../php/users/changeAdmin.php?id='.$user["Id"].'&quot;">Remove Admin</button></div>
                    </li>';
            }
        ?>
    </ul>

    </div>
    
    </body>
</html>