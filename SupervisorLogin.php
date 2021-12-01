<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SupervisorLogin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2 class="header">Market Shop Related Services</h2>
    <div class="container">
        <h2>Supervisor Login</h2>
        <form action="SupervisorLogin.php" method="post">
        <div>
            Supervisor ID <input type="text" name="Supervisor_ID" required><br>
        </div>
        <div>
            Password <input type="text" name="passwd" required><br>
        </div>
        <button type="submit" name="Supervisorlogin_user">Submit</button>
        </form> 
        <br>
        <div><a href="home.php">Go to Home Page</a></div>  
    </div>
</body>
</html>