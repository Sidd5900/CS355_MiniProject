<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupervisorLogin</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<h2 class="header">Market Shop Related Services</h2>
    <div class="container">
        <h2 class="subheading">Supervisor Login</h2>
        <form class="loginform" action="SupervisorLogin.php" method="post">
        <div>
            <label for="Supervisor_ID">Supervisor ID </label><input type="text" id="Supervisor_ID" name="Supervisor_ID" required><br>
        </div>
        <div>
            <label for="passwd">Password </label><input type="text" id="passwd" name="passwd" required><br>
        </div>
        <button type="submit" name="Supervisorlogin_user">Submit</button>
        </form> 
        <br>
        <div><a class="home" href="home.php">Go to Home Page</a></div>  
    </div>
</body>
</html>