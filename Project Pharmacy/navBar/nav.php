<!DOCTYPE html>
    <link rel="stylesheet" href="../../navBar/nav.css">
<html>
<body>
<div class="containernav">
<div class="heading">
    <img src="../../photos/1842138.png" title="Pharmacy">
    <h1>Pharmacy</h1>
</div>

<nav>
    <ul>
        <li><a href="../../view/products/ProductView.php">Products</a></li>
        <li><a href="../../view/products/cart.php">Cart</a></li>
        <li><a href = "mailto: meral.mourad.24@gmail.com">Contact Us</a></li>
    </ul>
    <ul>
        <?php 
            if(isset($_SESSION['InfoUser'])){
                if($_SESSION['InfoUser']['Admin']){
                    echo '<li><a href="../../view/products/addProduct.php">Add Product</a></li>
                    <li><a href="../../view/users/usersList.php">User List</a></li>';
                }

                echo '<li>
                    <a href = "../../view/users/profile.php">
                        '.$_SESSION["InfoUser"]["Name"].'
                    </a>
                </li>
                <li><a href="../../php/users/logout.php">Log Out</a></li>';
            }
            else{
                echo '
                <li><a href="../../view/users/sign_in.php">Login</a></li>
                <li><a href="../../view/users/sign_up.php">Sign up</a></li>
                ';
            }
        ?>
    </ul>
</nav>
</div>

    </body>
</html>