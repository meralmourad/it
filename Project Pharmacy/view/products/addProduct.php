<?php
    session_start();
    if(! isset($_SESSION['InfoUser'])){
        header("Location: ../../view/users/sign_in.php");
    }
    require("../../php/users/updateInfo.php");
    if(! $_SESSION['InfoUser']['Admin']){
        header("Location: ../../view/users/profile.php");
    }

    require("../../php/products/addingProduct.php");
?>
<!DOCTYPE html>
<html lang = "en">
    <head>
        <title>Products</title>
        <link rel="icon" href="../../photos/1842138.png">
        <link rel="stylesheet" href="../../css/product/addingProducts.CSS">
        <meta charset="UTF-8">
    </head>
    <body>
    <?php include("../../navBar/nav.php");?>
    <div class="container">
 
    <div class="formcont ">
        <form method="POST"enctype="multipart/form-data">
            <div class="inputformdiv">
                <div>
                    <label  class="labelform" for="name"> Product name: </label>
                    <input required type="text" name="name" id="name"  placeholder="Product Name" class="inputform"/>
                
                </div><br>

                <div>
                    <label class="labelform" for="category"> Category </label>
                    <!-- <input required type="category" name="category" id="category" placeholder="Category" class="inputform"/> -->
                    <select type="category" name="category" id="category" class="inputform">
                        <option selected disabled>Choose category...</option>
                        <option value="Skincare">Skincare</option>
                        <option value="Haircare">Haircare</option>
                        <option value="medicalDrugs">medicalDrugs</option>

                    </select>
                </div><br>

                <div>
                    <label for="price" class="labelform"> Price: </label>
                    <input required type="number" name="price" id="price" placeholder="price" class="inputform"/>
                </div><br>

                <div>
                    <label  class="labelform" for="company"> Company: </label>
                    <input required type="text" name="company" id="company"  placeholder="Company" class="inputform"/>
                 </div><br> 

                <div>
                    <label  class="labelform" for="brand"> Brand: </label>
                    <input required type="text" name="brand" id="brand"  placeholder="Brand" class="inputform"/>
                </div><br>

                <div>
                    <label  class="labelform" for="itemForm"> Item Form: </label>
                    <input required type="text" name="itemForm" id="itemForm"  placeholder="Item Form" class="inputform"/>
                </div><br>

                <div>
                   <label  class="labelform" for="nItems"> Number of Items: </label>
                    <input required type="number" name="nItems" id="nItems"  placeholder="Number of Items" class="inputform"/>
                </div><br>

                <div>
                   <label  class="labelform" for="useFor"> Use for: </label>
                   <input required type="text" name="useFor" id="useFor"       placeholder="Use For" class="inputform"/>
                </div><br>

                <div>
                    <label  class="labelform" for="specialIng"> Special Ingredietns: </label>
                    <input required type="text" name="specialIng" id="specialIng"  placeholder="Special Ingredietns" class="inputform"/>
                </div><br>

                <div>
                    <label  class="labelform" for="itemVol"> Item Volume: </label>
                    <input required type="text" name="itemVol" id="itemVol"  placeholder="Item Volume" class="inputform"/>
                </div><br>

                <div>
                   <label  class="labelform" for="stock"> In Stock: </label>
                    <input required type="number" name="stock" id="stock"  placeholder="In Stock" class="inputform"/>
                </div><br>
                

                <div class="Description">
                    <label for="description" class="labelform"> Description </label>
                    <textarea rows="5" name="description" id="description"  placeholder="Description ...." class="inputform"></textarea>
                
                </div><br>
                <div>
                    <label class="photo" for="photo"> Photo </label>
                    <input required type="file" name="photo" id="photo" placeholder="photo" class="inputform"/>
                </div><br>
                <input type="submit" name="submit" class="btn" value="Add Product"> 
            </form>

        </div>

     </div>
</div>
</body>
</html>