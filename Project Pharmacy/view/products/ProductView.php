<?php
session_start();
require("../../php/users/updateInfo.php");
$search = "";
$id = "1";
$cat = "All";
if(filesize("../../json/products/product.json") == 0){
    header("Location: ../../view/users/profile.php");
}
$All_Products = json_decode(file_get_contents("../../json/products/product.json"), true);

if(isset($_GET["search"])){
    $search = $_GET["search"];
}
if(isset($_GET["cat"])){
    $cat = $_GET["cat"];
}
foreach($All_Products as $prod){
    if(strpos(strtolower($prod["Name"]), strtolower($search)) === false || ($cat !== "All" && $prod["Category"] !== $cat)){
        $index = array_search($prod, $All_Products);
        unset($All_Products[$index]);
    }
}

if(isset($_GET["id"])){
    $id = $_GET["id"];
}
if($id === "1"){
    usort($All_Products, function($a, $b) {
        return strcmp($a['Name'], $b['Name']);
    });
}
else if ($id === "2"){
    usort($All_Products, function($a, $b) {
        return strcmp($b['Name'], $a['Name']);
    });
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <link rel="icon" href="../../photos/1842138.png">
        <link rel="stylesheet" href="../../css/product/ProductsView.css">
        <script src="../script.js"></script>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php include("../../navBar/nav.php");?>

        <div id="searchBar">
            <form method="get"  id="form" class="form">
                <input hidden name="id" value="<?php echo $id; ?>">
                <label for="search">Search: </label>
                <input id="search" type="search" name="search" value="<?php echo $search; ?>">
                <input hidden name="id" value="<?php echo $id; ?>">
                <input hidden name="cat" value="<?php echo $cat; ?>">
                <input type="submit" class='btnnav'>
                </form>
                <!-- -------------------------------------------------- -->
                <form method="get"  id="form2" class="form">
                <label for="Categories">sort by</label>
                    <select name="id">
                        <?php
                            if($id === "1")
                                echo '<option value="1">ascendingly</option>
                                <option value="2">descendingly</option>';
                            else
                                echo '<option value="1">ascendingly</option>
                                <option selected value="2">descendingly</option>';
                        ?>
                    </select>
                    <input hidden name="search" value="<?php echo $search; ?>">
                    <input hidden name="cat" value="<?php echo $cat; ?>">
                    <input type="submit" class="btnnav">
                </form>
                <!-- -------------------------------------------------- -->
                <form method="get"  id="form2" class="form">
                <label for="Categories">Categories</label>
                    <select name="cat">
                    <?php
                    if($cat === "Skincare")
                        echo '<option value="name">All</option>
                        <option selected value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>';
                    else if($cat === "Haircare")
                        echo '<option value="name">All</option>
                        <option value="Skincare">Skincare</option>
                        <option selected value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>';
                    else if($cat === "medicalDrugs")
                        echo '<option value="name">All</option>
                        <option value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option selected value="medicalDrugs">medicalDrugs</option>';
                    else
                        echo '<option selected value="name">All</option>
                        <option value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>';

                ?>
                    </select>
                    <input hidden name="search" value="<?php echo $search; ?>">
                    <input hidden name="id" value="<?php echo $id; ?>">
                    <input type="submit" class="btnnav">
                </form>

        </div>
       <br>

       <div>
            <?php
                 foreach($All_Products as $prod){
                    echo '<a href="../../view/products/ProductDetails.php?id='.$prod["Id"].'"><img src="'.$prod["PhotoIsPath"].'" class="photo" title = "Product Photo"></a>
                        <p class = "text">'.$prod["Name"].'</p><br><br>
                        <p class="size" >Size:'.$prod["Item_volume"].'</p>
                        <p class = "price">Price:'.$prod["Price"].'</p><br><span>';
                         if(! isset($_SESSION["InfoUser"]) || !$_SESSION["InfoUser"]["Admin"])
                                echo '<button type="button" class="btnadd" onclick="window.location.href = &quot;../../php/products/addingToCart.php?id='.$prod["Id"].'&quot;" >ADD TO CART</button>
                                    </span>
                                    <span>
                                        <button type="button" class="btnbuy">BUY NOW!</button>
                                    </span><hr class="line">';
                        else{
                                echo '<button onclick="window.location.href = &quot;../../view/products/editProduct.php?id='.$prod["Id"].'&quot;" type="button" class="btnedit">Edit</button>
                                    </span>
                                    <span>
                                        <button onclick="confirmDeleteProduct('.$prod["Id"].')" type="button" class="btnDelete">Delete</button>
                                    </span><hr class="line">';
                            }
                            
                        }
                        ?>
        </div>
        <?php include("../../footer/footer.php");?>
    
    </body>
</html>