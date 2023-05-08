<?php
session_start();

if(! isset($_SESSION['InfoUser'])){
    header("Location: sign_in.php");
}
require("../../php/users/updateInfo.php");
require("../../php/users/checkPassword.php");
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="icon" href="../../photos/1842138.png">
        <title>Profile</title>
        <link rel="stylesheet" href="../../css/users/profile.css">
        <script src="../script.js"></script>
        <meta charset="UTF-8">
    </head>

    <body>
        
        <?php include("../../navBar/nav.php");?>
    
        <div id="info">
            <table id = userinfo>
                <tr >
                    <th id = "photo"rowspan = "5">
                        <img id = "profphoto" src="../../photos/profile.jpg" title = "Profile photo">
                    </th>
                    
                </tr>
                <tr> 
                    <th>Name:</th>
                    <td> <?php if(isset($_SESSION['InfoUser'])){
                                echo $_SESSION['InfoUser']["Name"];}?>
                    </td>
                </tr>   

                <tr> 
                    <th>Email:</th>
                    <td> <?php if(isset($_SESSION['InfoUser'])){
                                echo $_SESSION['InfoUser']["Email"];}?>
                    </td>
                </tr>

                <tr> 
                    <th>Phone:</th>
                    <td> <?php if(isset($_SESSION['InfoUser'])){
                                echo $_SESSION['InfoUser']["PhoneNumber"];}?>
                    </td>
                </tr>

                <tr> 
                    <th>Address:</th>
                    <td> <?php if(isset($_SESSION['InfoUser'])){
                                echo $_SESSION['InfoUser']["Address"];}?>
                    </td>
                </tr>
            </table>
                <button onclick="showForm()">Edit Profile</button>
                
                <form method="post" id="formPass" style="display: none;">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password"
                            required><br>

                            <button type="submit" id="sub" name="submit">Check</button>
                </form>
            <hr id="table">
            <br><br>
            <hr id="table">
            <?php
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
    <div>
        <?php 
            if(! isset($_SESSION["InfoUser"]) || !$_SESSION["InfoUser"]["Admin"])
            include("../../footer/footer.php");
        ?>
    </div>
    </body>
</html>