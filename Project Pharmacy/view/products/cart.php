<?php
    session_start();
    if(! isset($_SESSION['InfoUser'])){
        header("Location: ../../view/users/sign_in.php");
    }
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
<html lang="en">
    <head>
        <title>Cart</title>
        <link rel="icon" href="../../photos/1842138.png">
        <link rel="stylesheet" href="../../css/product/cart.css">
        <meta charset="UTF-8">
    </head>

    <body>
        <?php include("../../navBar/nav.php");?>

        <h1 style="text-align: center;">Shopping Cart</h1>

    <div class="cart">

        <div class="column_lab fix">
            <label class="prod_details">Product</label>
            <label class="prod_price">Price</label>
            <label class="product_Quant">Quantity</label>
            <label class="rem">Remove</label>
            <label class="prod_price">Total</label>
        </div>


<script>
    updateTotal();
    function updateTotal() {
        let total = 0;
        let quantity = 0;
        let price = 0;
        let t = 0;
        let rows = document.getElementsByClassName('product');

        for (let i = 0; i < rows.length; i++) {
            quantity = rows[i].querySelector("input").value;
            price = rows[i].querySelector(".prod_price").textContent;
            rows[i].querySelector("#totalPrice").textContent = quantity * price;
            
            total += quantity * price;
        }

        document.getElementById('cart-total').innerHTML = total;
        document.getElementById('input-total').value = total;
    }
</script>

        <?php
        $totalPrice = 0;
        foreach($All_cart as $item){
            $totalPrice += $item["Price"];
            echo '<div class="product fix">
                    <div class="prod_details">
                    <div class="prod_title"><h3>'.$item["Name"].'</h3></div>
                    </div>
                    <div id="Price" class="prod_price">'.$item["Price"].'</div>
                    <div class="prod_num">
                    <input id = "q" oninput="updateTotal();" type="number" value="1" min="1">
                    </div>
                        <div class="rem">
                        <button class="rembtn" onclick="window.location.href = &quot;../../php/products/removeProdFromCart.php?id='.$item["Id"].'&quot;">
                            Remove
                        </button>
                    </div>
                    <div class="prod_price" id="totalPrice">'.$item["Price"].'
                    </div>
                </div><br>';
        }
        ?>
        <div class="totals fix">
            <div class="totals_items">
            <label>Total</label>
            <div id="cart-total"><?php echo $totalPrice; ?></div>
            </div>
        </div>
        <form method="post" action="buy.php">
            <input id="input-total" name="price" value="<?php echo $totalPrice; ?>" hidden>
            <button type="submit" class="buy">Buy</button>
        </form>
    </div>
            
</body>
</html>