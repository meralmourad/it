<?php
    session_start();
    if(! isset($_SESSION['InfoUser'])){
        header("Location: ../../view/users/sign_in.php");
    }
    if(! isset($_POST['price'])){
        header("Location: ../../view/products/ProductView.php");
    }
    require("../../php/products/addingToHistory.php");
    require("../../php/users/updateInfo.php");
    $All_cart = array();
    $All_product = json_decode(file_get_contents("../../json/products/product.json"), true);

    foreach($_SESSION['InfoUser']["cart"] as $prodId){
        foreach($All_product as $prod){
            if($prodId == $prod["Id"]){
                array_push($All_cart, $prod);
                break;
            }
        }
    }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Buy</title>
    <link rel="icon" href="../../photos/1842138.png">
    <link rel="stylesheet" href="../../css/product/cart.css">
  </head>
  <body>
    <?php include("../../navBar/nav.php");?>
    <div class="cart">

        <div class="column_lab fix">
          <br>
            <label class="prod_details">Products:</label>
        </div>
        <?php
        foreach($All_cart as $item){
            echo '<div class="product fix">
            <h4>'.$item["Name"].'</h4>
            </div><br>';
        }
        ?>
        <div class="totals fix">
            <div class="totals_items">
            <label>Total</label>
            <div id="cart-total"><?php echo $_POST["price"]; ?></div>
        </div>
        <br><br>
      </div>
        <div class="buyinfo">
      <form method="post">
        
        <label for="credit">Your credit card number</label><br>
        <input type="text" id="credit" name="creditNum" placeholder="Credit number"><br>

        <label for="address">Your Address </label><br>
        <input type="text" id="address" name="Address" placeholder="Address"><br>
      
        <input type="submit" value="Submit" name = "Submit" >
      </form>
    </div>
    </div>
    

  </body>
</html>