<?php
session_start();
$errors=array();

//connecting to the database
$db=mysqli_connect('localhost','root','password','dblab');
if(!$db)
{
    echo "error connecting";
    die(mysql_error());
}

if(isset($_POST['Shopkeeperlogin_user']))
{
    $Shopkeeper_ID=mysqli_real_escape_string($db,$_POST['Shopkeeper_ID']);
    $passwd=mysqli_real_escape_string($db,$_POST['passwd']);
    $query="select * from Shopkeeper where Shopkeeper_ID='$Shopkeeper_ID'";
    $result=mysqli_query($db,$query);
    $user=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0)
    {
        if($user['passwd']===NULL)
        {
            $hashedpasswd=password_hash($passwd,PASSWORD_DEFAULT);
            $query="update Shopkeeper set passwd='$hashedpasswd' where Shopkeeper_ID='$Shopkeeper_ID'";
            mysqli_query($db,$query);
    
            $_SESSION['Shopkeeper_ID']=$Shopkeeper_ID;
            $_SESSION['success']="Login Successful, you are now logged in";
            //redirect to welcome page
            header('location: ShopkeeperWelcome.php');
        }
        else if(password_verify($passwd,$user['passwd']))
        {
            $_SESSION['Shopkeeper_ID']=$Shopkeeper_ID;
            $_SESSION['success']="Login Successful, you are now logged in";
            //redirect to welcome page
            header('location: ShopkeeperWelcome.php');
        }
        else
        {
            array_push($errors,"Invalid Shopkeeper_ID or Password");
            echo "Invalid Shopkeeper ID or Password" . "<br>";
        }
    }
    else
    {
        array_push($errors,"Shopkeeper ID does not exist");
        echo "Shopkeeper ID does not exist" . "<br>";
    }
   
}

if(isset($_POST['Supervisorlogin_user']))
{
    $Supervisor_ID=mysqli_real_escape_string($db,$_POST['Supervisor_ID']);
    $passwd=mysqli_real_escape_string($db,$_POST['passwd']);
    $query="select * from Supervisor where Supervisor_ID='$Supervisor_ID'";
    $result=mysqli_query($db,$query);
    $user=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0)
    {
        if($user['passwd']===NULL)
        {
            $hashedpasswd=password_hash($passwd,PASSWORD_DEFAULT);
            $query="update Supervisor set passwd='$hashedpasswd' where Supervisor_ID='$Supervisor_ID'";
            mysqli_query($db,$query);
    
            $_SESSION['Supervisor_ID']=$Supervisor_ID;
            $_SESSION['success']="Login Successful, you are now logged in";
            //redirect to welcome page
            header('location: SupervisorWelcome.php');
        }
        else if(password_verify($passwd,$user['passwd']))
        {
            $_SESSION['Supervisor_ID']=$Supervisor_ID;
            $_SESSION['success']="Login Successful, you are now logged in";
            //redirect to welcome page
            header('location: SupervisorWelcome.php');
        }
        else
        {
            array_push($errors,"Invalid Supervisor ID or Password");
            echo "Invalid Supervisor ID or Password" . "<br>";
        }
    }
    else
    {
        array_push($errors,"Supervisor ID does not exist");
        echo "Supervisor ID does not exist" . "<br>";
    }
   
}

?>