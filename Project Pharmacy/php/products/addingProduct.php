<?php
    $message_error = "";
    function nextID($x){
        $All_Id = json_decode(file_get_contents("../../json/products/ID.json"), true);

        $All_Id[$x]++;

        file_put_contents("../../json/products/ID.json", json_encode($All_Id, JSON_PRETTY_PRINT), LOCK_EX);

        return $All_Id[$x];
    }
    
    if (isset($_POST['submit'])){
        $target_file = "../../photos/productPhoto/" . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $message_error = "";
        $new_product = array(
            "Id" => nextID('Product'),
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
            "PhotoIsPath" => $target_file
        );



        if(filesize("../../json/products/product.json") == 0){
            $first_record = array($new_product);

            $data_to_save = $first_record;
        }else{

            $old_records = json_decode(file_get_contents("../../json/products/product.json"), true);

            foreach ($old_records as $prod){
                if(strtolower($prod['Name']) === strtolower($new_product['Name'])){
                    $message_error = "there is a product with the same name.";
                    goto here;
                }
            }

            array_push($old_records, $new_product);

            $data_to_save = $old_records;

        }

        file_put_contents("../../json/products/product.json", json_encode($data_to_save, JSON_PRETTY_PRINT), LOCK_EX);
        
        header("Location: ../../view/products/ProductView.php");
        here:
    }
?>