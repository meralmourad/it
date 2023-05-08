<?
    session_start();
    if(! isset($_SESSION['InfoUser'])){
        header("Location: sign_in.php");
    }
    require("../../php/users/updateInfo.php");
    if(! $_SESSION['InfoUser']['Admin']){
        header("Location: profile.php");
    }
    $All_Users = json_decode(file_get_contents("../../json/users/users.json"), true);

    $user = null;
    foreach($All_Users as $user1){
        if($user1["Id"] == $_GET["id"]){
            $user = $user1;
            break;
        }
    }
    if($user == null)
        header("Location: usersList.php");

    $All_History = array();
    $All_product = json_decode(file_get_contents("../../json/products/product.json"), true);

    foreach($user["History"] as $prodId){
        foreach($All_product as $prod){
            if($prodId == $prod["Id"]){
                array_push($All_History, $prod);
                break;
            }
        }
    }

?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="../../photos/1842138.png">
        <title>Profile</title>
        <link rel="stylesheet" href="../../css/users/profile.css">
        <!-- <link rel="stylesheet" href="../../css/product/tableCart.css"> -->
        <script src="../script.js"></script>
        <meta charset="UTF-8">
    </head>

    <body>
        <?php include("../../navBar/nav.php");?>
    
        <div id="info">
            <table id = userinfo>
                <tr>
                    <th rowspan = "5">
                        <img id = "profphoto" src="../../photos/profile.jpg" title="Profile photo">
                    </th>
                    
                </tr>
                <tr> 
                    <th>Name:</th>
                    <td> <?php echo $user["Name"];?>
                    </td>
                </tr>   

                <tr> 
                    <th>Email:</th>
                    <td> <?php echo $user["Email"];?>
                    </td>
                </tr>

                <tr> 
                    <th>Phone:</th>
                    <td> <?php echo $user["PhoneNumber"];?>
                    </td>
                </tr>

                <tr> 
                    <th>Address:</th>
                    <td> <?php echo $user["Address"];?>
                    </td>
                </tr>
            </table>
            
            <br>
            <button class="BackToList" onclick="window.location.href = '../../view/users/usersList.php'">Back To List</button>
            
            <br><br>
            <hr id="table">
            <?php
                if(empty($user["History"])){
                    echo '<h1 style="text-align: center;">History is empty</h1>';
                }
                else{
                    echo '<h1 style="text-align: center;">Purchase History : </h1>';
                    echo '<table class="tab">
                    <thead>
                        <tr>
                            <th> </th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>';
                    foreach($All_History as $prod){
                            echo '<tr>
                            <th><a href="../../view/products/ProductDetails.php?id='.$prod["Id"].'"><img src="'.$prod["PhotoIsPath"].'" style="width: 100px; border-radius: 200px;" title = "product photo"></a></th>
                                <td><a href="../../view/products/ProductDetails.php?id='.$prod["Id"].'">'.$prod["Name"].'</a></td>
                                <td>'.$prod["Category"].'</td>
                                <td>'.$prod["Price"].'</td>';
                        };
                    echo '</tbody>
                </table>';
                }
            ?>
        </div>
        
    </body>
</html>