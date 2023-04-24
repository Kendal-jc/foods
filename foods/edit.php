<?php
    require 'db.php';
    
    $categories = $database->select("tb_recipe_category", "*");
    $occasions = $database->select("tb_recipe_ocassions", "*");
 
    session_start();
    if(isset($_SESSION["isLoggedIn"])){

    $data= $database->select("tb_recipes",[//inner
        "[>]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],//[>] caracter para hacer el join
        "[>]tb_recipe_ocassions"=>["id_recipe_ocassion" => "id_recipe_ocassion"],//[>] caracter para hacer el join
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name",
        "tb_recipes.prep_time",
       "tb_recipes.recipe_ingredients",
      "tb_recipes.recipe_description",
        "tb_recipes.recipe_image",
       "tb_recipe_ocassions.recipe_ocassion",
        "tb_recipe_category.recipe_category"
    ],[
        "id_recipe" => $_GET["id"]
    ]);

    }else{
        header("Location: login.php");
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <!--fonts roboto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Roboto:ital,wght@1,900&display=swap"
        rel="stylesheet">

    <!--fonts oswald-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&family=Oswald:wght@300;400;700&display=swap"
        rel="stylesheet">

    <!---Bootsrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!--Iconos-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <!--fronts.css-->
    <link rel="stylesheet" href="./css/Components/front.css">
    <link rel="stylesheet" href="./css/frontsprincipa.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
 <section  class="testimonial2"> 
<header class="admin-header mt-3">
            <div class="admin-limit">
                <div class="d-flex justify-content-center">
                    <h1 class="tittle-admin-h title-lgg">Editar recetas</h1>
                </div>
            </div>
        </header>
<section class="container-fluid d-flex justify-content-center mt-lg-5 mb-xl-5">
   
    <form action="update.php" method="post" enctype="multipart/form-data"> <!--atributo para enviar archivos desde el form-->

        <label class="title-sm" for="recipe">Recipe name:</label>
        <input type="text" name="recipe" value="<?php echo $data[0]["recipe_name"]; ?>">
        <label class="title-sm"  for="category">Category:</label>
        <select name="category" id="">
        <?php 
                $len = count($categories);
                for($i=0; $i < $len; $i++) {
                    if($data[0]["id_recipe_category"] == $categories[$i]['id_recipe_category']){
                        echo '<option value="'.$categories[$i]['id_recipe_category'].'" selected>'.$categories[$i]['recipe_category'].'</option>';
                    }else{
                        echo '<option value="'.$categories[$i]['id_recipe_category'].'">'.$categories[$i]['recipe_category'].'</option>';
                    }
                    
                }
            ?>

        </select>

        <label class="title-sm"  for="ocassion">Occasions:</label>
        <select name="recipe_ocassion" id="">
    <?php 
                $len = count($occasions);
                for($i=0; $i < $len; $i++) {
                    if($data[0]["id_recipe_ocassion"] == $occasions[$i]['id_recipe_ocassion']){
                        echo '<option value="'.$occasions[$i]['id_recipe_ocassion'].'" selected>'.$occasions[$i]['id_recipe_ocassion'].'</option>';
                    }else{
                        echo '<option value="'.$occasions[$i]['recipe_ocassion'].'">'.$occasions[$i]['recipe_ocassion'].'</option>';
                    }
                    
                }
            ?>
 </select>
        
        <label class="title-sm"  for="time">Prep. time</label>
        <input type="text" name="time" value="<?php echo $data[0]["prep_time"]; ?>">
       
        <label class="title-sm"  for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $data[0]["recipe_description"]; ?>">
        
        <div class="container-fluid d-flex justify-content-center mt-lg-5 mb-xl-5">
        <br>
        <label class="title-sm"  for="recipe_image">Imagen principal</label>
        <img id="preview" src="./imgs/<?php echo $data[0]["recipe_image"]; ?>" width="125" height="125" alt="Preview">
        <input id="recipe_image" type="file" name="recipe_image" onchange="readURL(this)">
        <br>
        </div>
        
        

        
     
        <br>     
        <div class="container-fluid d-flex justify-content-center mt-lg-5 mb-xl-5">
            <div  id="ingredients">
                <?php
                    $ingredients = [];
                    $ingredients = explode(",", $data[0]["recipe_ingredients"]);
                    foreach ($ingredients as $ingredient) {
                        echo "<div>";
                        echo "<label>Ingredient</label>";
                        echo "<input type='text' name='ingredients[]' value='$ingredient'>";
                        echo "<button class='remove-ingredient'>remove</button>";
                        echo "</div>";
                    }
                ?>    
            </div>  
        </div> 
       
        <br>  
        <br>
        <div class="container-fluid d-flex justify-content-center mt-1 mb-xl-5">
        <ul style="margin-left">
                 <li>
                 <button type="button" id="add-ingredient">Add ingredient</button>
                    <input type="hidden" name="id" value="<?php echo $data[0]["id_recipe"]; ?>">
                </li>

                <li>
                    <input class="btn" type="submit" value="SUBMIT">
                </li>
        </ul>
        </div>
      

    </form>
</section>

</section>
    <script>
    function readURL(input) {
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e) {
                    let preview = document.getElementById('preview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.querySelector('#add-ingredient').addEventListener('click', function(){

            event.preventDefault();
            let ingredient = document.createElement("div");
            let id = "ingredient-"+Date.now();
            ingredient.id = id;
            document.querySelector('#ingredients').appendChild(ingredient);

            let label = document.createElement("label");
            label.innerText = "Ingredient";
            label.setAttribute('for', 'ingredient');
            document.querySelector('#'+id).appendChild(label);

            let input = document.createElement("input");
            input.type = "text";
            input.setAttribute('name', "ingredients[]");
            document.querySelector('#'+id).appendChild(input);

            let btn = document.createElement("button");
            btn.innerText = "remove";
            btn.addEventListener("click", function() { 
                document.querySelector('#'+id).remove();
            });
            document.querySelector('#'+id).appendChild(btn);

        });

        let registered_ingredients = document.querySelectorAll('.remove-ingredient');
        //console.log(registered_ingredients.length);
        for(let i=0; i<registered_ingredients.length; i++){
            registered_ingredients[i].addEventListener("click", function(event) {
                event.preventDefault();
                this.parentNode.remove();
            });
        }
   </script>

</body>
</html>