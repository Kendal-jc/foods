<?php

    require 'db.php';

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    if(isset($_POST)){
        $ingredients = "";
        foreach($_POST["ingredients"] as $key => $ingredient){
            if($key == array_key_last($_POST["ingredients"])){
                $ingredients.= $ingredient;
            } else{
                $ingredients.= $ingredient.",";
            }
        }

        if(isset($_FILES["recipe_image"])){
            $error = array();
            $file_name = $_FILES["recipe_image"]["name"];
            $file_size = $_FILES["recipe_image"]["size"];
            $file_tmp = $_FILES["recipe_image"]["tmp_name"];
            $file_type = $_FILES["recipe_image"]["type"];
            $file_ext_arr = explode(".", $_FILES["recipe_image"]["name"]);

            $file_ext = end($file_ext_arr);
            $img_ext = array("jpeg","png", "jpg", "gif");

            if(!in_array($file_ext, $img_ext)){
                $errors[] = "File type is not supported";
            }

            if(empty($errors)){
                $img = "recipe-upload-".generateRandomString().".".$file_ext;
                move_uploaded_file($file_tmp, "imgs/".$img);


                $database->insert("tb_recipes", [
                    "recipe_name" => $_POST["recipe_name"],
                    "id_recipe_category" => $_POST["category"],
                    "id_recipe_ocassion" => $_POST["occasion"],
                    "prep_time" => $_POST["prep_time"],
                    "recipe_description" => $_POST["description"],
                    "portions" => $_POST["portions"],
                    "id_recipe_level" => $_POST["recipe_level"],
                    "recipe_image" => $img,
                    "recipe_ingredients" => $ingredients
                ]);
                header("location: recipes.php");

            }


        }


       
    }
?>