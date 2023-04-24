<?php   
  
  require 'db.php';
  if(isset($_GET)){
  $data = $database->select("tb_recipes", "*", [
      "id_recipe" => $_GET["id"]
      ]);
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
  <section class="container-fluid d-flex justify-content-center mt-lg-5 mb-xl-5">
    <div class="dele">
          <h2>Delete this recipe: <?php echo $data[0]["recipe_name"]; ?></h2>

            <form action="remove.php" method="post" style="padding-left: 200px; margin-top: 50px;"> 
                <input type="submit" value="YES">
                <input type="button" value="CANCEL" onclick="history.back();"><!--regresa a la pagina anterior-->     
                <input type="hidden" name="id" value="<?php echo $data[0]["id_recipe"]; ?>">

            </form>
    </div>
        
  </section>
   
</body>
</html>