<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopkeeperLogin</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<h2 class="header">Market Shop Related Services</h2>
    <div class="container">
        <h2 class="subheading">Shopkeeper Login</h2>
        <form class="loginform" action="Shopkeeperlogin.php" method="post">
        <div>
            <label for="Shopkeeper_ID">Shopkeeper ID </label><input type="text" id="Shopkeeper_ID" name="Shopkeeper_ID" required><br>
        </div>
        <div>
           <label for="passwd"> Password </label><input type="text" id="passwd" name="passwd" required><br>
        </div>
        <button type="submit" name="Shopkeeperlogin_user">Submit</button>
        </form> 
        <br>
        <div><a class="home" href="home.php">Go to Home Page</a></div>  
    </div>
</body>
</html>