<?php 
    session_start();
    if(isset($_GET["id"]) && $_SESSION['InfoUser']['Admin']){
        $id = $_GET["id"];

        $All_Products = json_decode(file_get_contents("../../json/products/product.json"), true);

        foreach ($All_Products as $prod){
            if($id == $prod['Id']){

                $index = array_search($prod, $All_Products);
                unlink($prod["PhotoIsPath"]);
                
                unset($All_Products[$index]);
                
                file_put_contents("../../json/products/product.json", json_encode($All_Products, JSON_PRETTY_PRINT), LOCK_EX);

                break;
            }
        }
    }
    header("Location: ../../view/products/ProductView.php");
?>