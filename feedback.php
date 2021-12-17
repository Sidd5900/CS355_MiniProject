<?php
session_start();

$db=mysqli_connect('localhost','root','password','dblab');
if(!$db)
{
    echo "error connecting";
    die(mysql_error());
}

if(isset($_POST['feedback']))
{
    $RollNo=mysqli_real_escape_string($db,$_POST['RollNo']);
    $passwd=mysqli_real_escape_string($db,$_POST['passwd']);
    $Shop_ID=mysqli_real_escape_string($db,$_POST['Shop_ID']);
    $FeedDate=date("Y-m-d");
    $Quality=$_POST['Quality'];
    $Behaviour=$_POST['Behaviour'];
    $Value=$_POST['Value'];
    $Variety=$_POST['Variety'];
    $Comments=$_POST['Comments'];

    $query="select * from studpasswd where RollNo='$RollNo'";
    $result=mysqli_query($db,$query);
    $user=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0)
    {
        if($user['passwd']===NULL)
        {
            $hashedpasswd=password_hash($passwd,PASSWORD_DEFAULT);
            $query="update studpasswd set passwd='$hashedpasswd' where RollNo='$RollNo'" or die(mysql_error());
            mysqli_query($db,$query);
            $query="insert into Feedback(Shop_ID,RollNo,FeedDate,Quality,Behaviour,Value,Variety,Comments) values('$Shop_ID','$RollNo','$FeedDate',$Quality,$Behaviour,$Value,$Variety,'$Comments')" or die(mysql_error());
            mysqli_query($db,$query);
            echo "Feedback submitted successfully";
            
        }
        else if(password_verify($passwd,$user['passwd']))
        {
           $query="select * from feedback where RollNo='$RollNo' and Shop_ID='$Shop_ID'";
           $result=mysqli_query($db,$query);
           if(mysqli_num_rows($result) > 0)
           {
               echo "You have already given the feedback for this Shop";
           }
           else
           {
                $query="insert into Feedback(Shop_ID,RollNo,FeedDate,Quality,Behaviour,Value,Variety,Comments) values('$Shop_ID','$RollNo','$FeedDate',$Quality,$Behaviour,$Value,$Variety,'$Comments')" or die(mysql_error());
                mysqli_query($db,$query);
                echo "Feedback submitted successfully";
           }
            
        }
        else
        {
           // array_push($errors,"Invalid RollNo or Password");
            echo "Invalid RollNo or Password" . "<br>";
        }
    }
    else
    {
        //array_push($errors,"RollNo does not exist");
        echo "RollNo does not exist" . "<br>";
    }
}
?>        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<h1 class="header">Market Shop Related Services</h1>
<div class="container">
        <h2 class="subheading">Feedback Portal</h2>
        <br>
       
        <div class="main">
        <div class="table">
        <h3>Give you feedback for the following Shops</h3>
        <br>
       <?php 
        $query="select * from Shop";
        $result=mysqli_query($db,$query);

        echo "
        <table>
         <tr>
         <th>Shop ID</td> 
        <th>Shop Name</td> 
        <th>Area</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['ShopName'] . "</td>"; 
            echo "<td>" . $user['Area'] . "</td>"; 
            echo "<tr>"; 
        }
        echo "</table>";
        ?>
        </div>
        <div class="formclass">
        <form class="form-div" action="feedback.php" method="post">
        <br>
        <h4>Enter your details</h4>
        <div class="form-group">
            <label for="RollNo">Roll Number</label> <input type="text" name="RollNo" id="RollNo" placeholder="Enter your Roll Number" required><br>
        </div>
        <div class="form-group">
            <label for="passwd">Password</label> <input type="text" id="passwd" name="passwd" placeholder="Enter your Password" required><br>
        </div>
        <h4>Give your feedback for one of the above Shops</h4>
        <div class="form-group">
            <label for="Shop_ID">Shop ID</label> <input type="text" id="Shop_ID" name="Shop_ID" placeholder="Enter valid Shop ID" required><br>
        </div>
        <div class="form-group">
            <label for="Quality">Product/Service Quality</label> <input type="number" id="Quality" name="Quality" min="1" max="10" placeholder="Rating" required>
        </div >
        <div class="form-group">
          <label for="Behaviour">Shopkeeper Behaviour</label><input type="number" id="Behaviour"  name="Behaviour" min="1" max="10" placeholder="Rating" required>
        </div>
        <div class="form-group">
         <label for="Value">Value for Money</label><input type="number" id="Value" name="Value" min="1" max="10" placeholder="Rating"  required>
        </div>
        <div class="form-group">
        <label for="Variety">Product/Service Variety</label><input type="number" min="1" max="10" placeholder="Rating" id="Variety" name="Variety"required>
        </div>
        <div class="form-group">
        <label  for="Comments">Additional Comments/Suggestions</label><textarea id="Comments" name="Comments"></textarea>
        </div>
        <br>

        <button type="submit" name="feedback">Submit</button>
        </form> 
        </div>
        </div>
        <br>

        <div><a class="home" href="home.php">Go to Home Page</a></div>  
    </div>
    
</body>
</html>