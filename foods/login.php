<?php

    require 'db.php';

    if($_POST){
        //var_dump($_POST);
        $user = $database-> select("tb_users","*",[
            "user_name" => $_POST["username"]
        ]);

        if(count($user) > 0){
            if(password_verify($_POST["password"], $user[0]["password"])){
                //echo "valid username and password";

                //init session
                session_start();
                $_SESSION["isLoggedIn"] = true;
                $_SESSION["username"] = $user[0]["user_name"];
                //redireccionar
                header("Location: admin.php");

            }else{
                echo "wrong username or password";
            }
        }else{
            echo "wrong username or password";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link rel="stylesheet" href="./css/login.css">
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
  <!-- partial:index.partial.html -->
  <div id="bg"></div>

  <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username">

        <label for="password">Password</label>
        <input type="password" name="password">
        
        <input style="  margin-top: 10px;" type="submit" value="LOG IN">
    </form>

</body>

</html>