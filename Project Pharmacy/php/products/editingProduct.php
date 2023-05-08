<?php
    $message_error = "";
    if (isset($_POST['submit'])){
        $message_error = "";

        $old_records = json_decode(file_get_contents("../../json/products/product.json"), true);

        foreach($old_records as $item){
            if($_POST["id"] == $item['Id']){
                $index = array_search($item, $old_records);
                $old_records[$index] = array(
                    "Id" => $_POST["id"],
                    "Category" => $_POST['category'],
                    "Name" => $_POST['name'],
                    "Price" => $_POST['price'],
                    "Company" => $_POST['company'],
                    "Brand" => $_POST['brand'],
                    "Item_form" =>$_POST['itemForm'],
                    "N_Items" => $_POST['nItems'],
                    "Use_For" => $_POST['useFor'],
                    "Special_ing" =>$_POST['specialIng'], //special ingredients
                    "Item_volume" =>$_POST['itemVol'],
                    "Stock" => $_POST['stock'], //quantity 
                    "Description" =>$_POST['description'],
                    "PhotoIsPath" => $old_records[$index]["PhotoIsPath"]
                );
                break;
            }
        }

        file_put_contents("../../json/products/product.json", json_encode($old_records, JSON_PRETTY_PRINT), LOCK_EX);

        header("Location: ../../view/products/ProductView.php");
        here:
    }
?>