<?php
require 'db.php';

if($_GET){

    $column = "";
    $value = 0;
    $title = "";
    $subtitle = $_GET["name"];

    if(isset($_GET["level"])){
        $column = "tb_recipes.id_recipe_level";
        $value = $_GET["level"];
        $title = "Recipes By Skill Level";
    }else if(isset($_GET["category"])){
        $column = "tb_recipes.id_recipe_category";
        $value = $_GET["category"];
        $title = "Recipes By Category";
    }else if(isset($_GET["ocassion"])){
        $column = "tb_recipes.id_recipe_ocassion";
        $value = $_GET["ocassion"];
        $title = "Recipes By Occasion";
    }

    $results = $database->select("tb_recipes",[
        "[><]tb_recipe_category"=>["id_recipe_category" => "id_recipe_category"],
        "[><]tb_recipe_levels"=>["id_recipe_level" => "id_recipe_level"],
        "[><]tb_recipe_ocassions"=>["id_recipe_ocassion" => "id_recipe_ocassion"],
    ],[
        "tb_recipes.id_recipe",
        "tb_recipes.recipe_name",
        "tb_recipes.prep_time",
        "tb_recipes.recipe_image",
        "tb_recipes.recipe_likes",
        "tb_recipes.id_recipe_level",
    ],[
        $column => $value
    ]);
    
}

$levels = $database->select("tb_recipe_levels","*");
$categories = $database->select("tb_recipe_category","*");
$ocassions = $database->select("tb_recipe_ocassions","*");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodsOcsa
    </title>

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
    <section class="principal">

    <header class="header">
    <div class="header-limit">
        <a href="./index.php"> <img class="logo-header" src="./imgs/Logo (1).png" alt="logo"> </a>
       
        <div class="search-limit">
                    <form class="group" action="search.php" method="get" role="search">
                        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                            <g>
                                <path
                                    d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                                </path>
                            </g>
                        </svg>
                        <input placeholder="search" type="search" class="input" name="keyword">
                        <button class="btn m-2"><span class="btn-text" type="submit">Search</button>
                  </form>
                </div>           
</header>
        <div class="row gap-3 d-flex justify-content-center" style="padding-top: 5rem;">
        <div class="container-fluid d-flex justify-content-center">
            <h2 class="mt-3 title-xxlg">Level</h2>
        </div>
        <?php 
                foreach ($levels as $level){
                    echo"<div class='col mt-4 d-flex justify-content-center'>
                    <div class='card cardss' style='width: 18rem;'>
                        <img src='./imgs/".utf8_decode($level["recipe_level"]).".jpg' class='card-img-top mt-3 p-2'>
                        <div class='card-body'>
                            <a class='card-title pointer text-decoration-none text-center d-block category text-truncate' href='recipe _p.php?level=".$level['id_recipe_level']."&name=".$level['recipe_level']."'>".$level['recipe_level']."</a>
                        </div>
                    </div>
                </div>";
                }
            ?>
      

</div>

        <!-- contact us -->
        <footer class="container-fluid mt-5 text-grn p-0 m-0">
            <div class="container-footerr">

                <p class="badge badge-blue text-start">CONTACT US</p>
                <a class="nav-item nav-link title-lg text-white" href="ermaill:hello@foods.com">Hello@Foods.com
                    <span><img src="./imgs/arrow.svg" alt="arrow"></span></a>
                <div class="d-flex justify-content-center mt-xl-5">

                    <span class="fa-stack fa-lg icons-color">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-twitter fa-stack-1x"></i>
                    </span>

                    <span class="fa-stack fa-lg icons-color">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-youtube-play fa-stack-1x"></i>
                    </span>

                    <span class="fa-stack fa-lg icons-color">
                        <i class="fa fa-circle-thin fa-stack-2x"></i>
                        <i class="fa fa-facebook-f fa-stack-1x"></i>
                    </span>
                </div>
            </div>
        </footer>

    </section>
</body>

</html>