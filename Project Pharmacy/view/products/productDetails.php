<?php
    session_start();
    $All_Products = json_decode(file_get_contents("../../json/products/product.json"), true);
    if(!isset($_GET["id"])){
        header("Location: ../../view/products/productView.php");
    }
    $product = null;
    foreach($All_Products as $prod){
        if($prod["Id"] == $_GET["id"]){
            $product = $prod;
            break;
        }
    }
    if($product == null){
        header("Location: ../../view/products/ProductView.php");
    }
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Products</title>
        <link rel="icon" href="../../photos/1842138.png">
        <link rel="stylesheet" href="../../css/product/ProductDetails.css">
        <script src="../script.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php include("../../navBar/nav.php");?>

        <div class = "generalInfo">
            <img src="<?php echo $prod["PhotoIsPath"];?>" class="photo" title = "Product Photo">
            <p class = "text"><?php echo $prod["Name"];?></p><br>
            <p class = "price">Price:<?php echo $prod["Price"];?></p><br>
            <span><?php if(! isset($_SESSION["InfoUser"]) || !$_SESSION["InfoUser"]["Admin"])
                         echo '<button type="button" class="btnadd" onclick="window.location.href = &quot;../../php/products/addingToCart.php?id='.$prod["Id"].'&quot;" >ADD TO CART</button></span>
            <span>
                        <button type="button" class="btnbuy">BUY NOW!</button>';
                    else{
                        echo '<button onclick="window.location.href = &quot;../../view/products/editProduct.php?id='.$prod["Id"].'&quot;" type="button" class="btnedit">Edit</button></span>
            <span>
                        <button onclick="confirmDeleteProduct('.$prod["Id"].')" type="button" class="btnDelete">Delete</button>';}?></span><br>
        </div>
        <hr class = "line">
        <div class="list">
            <table class="listOfSpecs">
                <tr>
                    <th>Brand</th>
                    <td><?php echo $product["Brand"] ?></td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td><?php echo $product["Company"] ?></td>
                </tr>
                <tr>
                    <th>Item form</th>
                    <td><?php echo $product["Item_form"] ?></td>
                </tr>
                <tr>
                    <th>Number of items</th>
                    <td><?php echo $product["N_Items"] ?></td>
                </tr>
                <tr>
                    <th>Use for</th>
                    <td><?php echo $product["Use_For"] ?></td>
                </tr>
                <tr>
                    <th>Special ingredients</th>
                    <td><?php echo $product["Special_ing"] ?></td>
                </tr>
                <tr>
                    <th>Item volume</th>
                    <td><?php echo $product["Item_volume"] ?></td>
                </tr>
            </table>
        </div><hr class = "line">
        <div class="description">
            <h4>Product's Description</h4>
            <p><?php echo $product["Description"] ?></p>
        </div>
    </body>
</html>