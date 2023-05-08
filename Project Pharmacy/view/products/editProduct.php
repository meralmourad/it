<?php
    session_start();
    if(! isset($_SESSION['InfoUser'])){
        header("Location: ../../view/users/sign_in.php");
    }
    require("../../php/users/updateInfo.php");
    if(! $_SESSION['InfoUser']['Admin']){
        header("Location: ../../view/users/profile.php");
    }
    if(! isset($_GET["id"])){
        header("Location: ../../view/products/ProductView.php");
    }
    $All_Products = json_decode(file_get_contents("../../json/products/product.json"), true);

    $prod =  null;
    foreach($All_Products as $_prod){
        if($_prod["Id"] == $_GET["id"]){
            $prod = $_prod;
            break;
        }
    }
    if($prod == null){
        header("Location: ../../view/products/ProductView.php");
    }


    require("../../php/products/editingProduct.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Product</title>
        <link rel="icon" href="../../photos/1842138.png">
        <link rel="stylesheet" href="../../css/product/addingProducts.CSS">
        <link rel="stylesheet" href="css/nav.css">
        <meta charset="UTF-8">
    </head>
    <body>
    <?php include("../../navBar/nav.php");?>
    <div class="container">
 
  <div class="formcont ">
    <form method="POST">
        <input name="id" hidden value="<?php echo $_GET["id"]; ?>">
        <div class="inputformdiv">

            <div>
                <label  class="labelform" for="name"> Product name: </label>
                <input value="<?php echo $prod["Name"];?>" required type="text" name="name" id="name"  placeholder="Product Name" class="inputform"/>
                
            </div><br>

            <div>
            <label class="labelform" for="category"> Category </label>
            <!-- <input required type="category" name="category" id="category" placeholder="Category" class="inputform"/> -->
            <select value="<?php echo $prod["Category"];?>" type="category" name="category" id="category" class="inputform">
                <?php
                    if($prod["Category"] == "Skincare")
                        echo '<option selected value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>';
                    else if($prod["Category"] == "Haircare")
                        echo '<option value="Skincare">Skincare</option>
                        <option selected value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>';
                    else if($prod["Category"] == "medicalDrugs")
                        echo '<option value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option selected value="medicalDrugs">medicalDrugs</option>';
                ?>
            </select>
        </div><br>

            <div>
                <label for="price" class="labelform"> Price: </label>
                <input value="<?php echo $prod["Price"];?>" required type="number" name="price" id="price" placeholder="price" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="company"> Company: </label>
                <input value="<?php echo $prod["Company"];?>" required type="text" name="company" id="company"  placeholder="Company" class="inputform"/>
            </div><br> 

            <div>
                <label  class="labelform" for="brand"> Brand: </label>
                <input value="<?php echo $prod["Brand"];?>" required type="text" name="brand" id="brand"  placeholder="Brand" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="itemForm"> Item Form: </label>
                <input value="<?php echo $prod["Item_form"];?>" required type="text" name="itemForm" id="itemForm"  placeholder="Item Form" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="nItems"> Number of Items: </label>
                <input value="<?php echo $prod["N_Items"];?>" required type="number" name="nItems" id="nItems"  placeholder="Number of Items" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="useFor"> Use for: </label>
                <input value="<?php echo $prod["Use_For"];?>" required type="text" name="useFor" id="useFor"  placeholder="Use For" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="specialIng"> Special Ingredietns: </label>
                <input value="<?php echo $prod["Special_ing"];?>" required type="text" name="specialIng" id="specialIng"  placeholder="Special Ingredietns" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="itemVol"> Item Volume: </label>
                <input value="<?php echo $prod["Item_volume"];?>"required type="text" name="itemVol" id="itemVol"  placeholder="Item Volume" class="inputform"/>
            </div><br>

            <div>
                <label  class="labelform" for="stock"> In Stock: </label>
                <input value="<?php echo $prod["Stock"];?>" required type="number" name="stock" id="stock"  placeholder="In Stock" class="inputform"/>
            </div><br>

            <div class="Description">
                <label for="description" class="labelform"> Description </label>
                <textarea rows="6" name="description" id="description"  placeholder="Description ...." class="inputform"><?php echo $prod["Description"];?> </textarea>
                
            </div>
            <br>

            
        </div>
        <input type="submit" name="submit" class="btn" value="Edit Product">
    </form>
   </div>
</div>
</body>
</html>