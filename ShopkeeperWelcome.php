<?php 
session_start();

//User not logged in
if(!isset($_SESSION['Shopkeeper_ID']))
{
    echo "You need to login first <br>";
    header("location: ShopkeeperLogin.php");
}

//if login is successfull
if(isset($_SESSION['success']))
{
    echo $_SESSION['success'];
    unset($_SESSION['success']);
}

//connecting to the database
$db=mysqli_connect('localhost','root','password','dblab');
if(!$db)
{
    echo "error connecting";
    die(mysql_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopkeeperWelcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2 class="header">Market Shop Related Services</h2>
    <div class="container">
        <?php if(isset($_SESSION['Shopkeeper_ID'])): ?>
        <h3>Welcome <?php echo $_SESSION['Shopkeeper_ID'];?></h3>
        <br>
        <?php 
        $Shopkeeper_ID=$_SESSION['Shopkeeper_ID'];


        //Gatepass Validity

        echo "<h4>Gatepass Validity</h4><br>";
        
        $query="select * from shopkeeper natural join gatepass where Shopkeeper_ID='$Shopkeeper_ID'";
        $result=mysqli_query($db,$query);
        $user=mysqli_fetch_assoc($result);

     
        echo "Name: " . $user['Name'] . "<br>";
        echo "Phone No.: " . $user['PhoneNo'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Gatepass ID: " . $user['Gatepass_ID'] . "<br>";
        echo "Valid From: " . $user['ValidFrom'] . "<br>";
        echo "Valid Till: " . $user['ValidTill'] . "<br>";

        $curdate=date("Y-m-d");
        $nextmonth=date('Y-m-d', strtotime($curdate. ' + 30 days'));
        if($user['ValidTill']<$curdate)
        echo "<div style=\"color:red;\">Your Gatepass Validity has expired</div>" . "<br>";
        else if($user['ValidTill']<$nextmonth)
        echo "<div style=\"color:red;\">Your Gatepass Validity will expire within 30 days</div>" . "<br>";

        //Shop License Details

        echo "<br><h4>Shop License Details</h4><br>";
        $query="select * from license where Shopkeeper_ID='$Shopkeeper_ID'";
        $result=mysqli_query($db,$query);
        $user=mysqli_fetch_assoc($result);

       
        echo "Shop ID: " . $user['Shop_ID'] . "<br>";
        echo "License From: " . $user['LicenseFrom'] . "<br>";
        echo "License Till " . $user['LicenseTill'] . "<br>";
  
        $curdate=date("Y-m-d");
        if($user['LicenseTill']<$curdate)
        echo "Your Shop License has expired" . "<br>";


        //View Bill Details
        echo "<br><h4>Bill Details</h4><br>";
        $query="select * from BillDetails natural join License where Shopkeeper_ID='$Shopkeeper_ID'";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Bill ID</td> 
        <td>Bill Date</td> 
        <td>Shop Rent</td> 
        <td>Electricity Bill</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Bill_ID'] . "</td>"; 
            echo "<td>" . $user['BillDate'] . "</td>"; 
            echo "<td>" . $user['ShopRent'] . "</td>"; 
            echo "<td>" . $user['ElectricityBill'] . "</td>";
            echo "<tr>"; 
        }
        echo "</table>";

        //Pay Details

        echo "<br><h4>Previous Payment Details</h4><br>";
        $query="select * from PayDetails natural join License where Shopkeeper_ID='$Shopkeeper_ID'";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Reference ID</td> 
        <td>Category</td> 
        <td>Payment Date</td> 
        <td>Amount Paid</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Reference_ID'] . "</td>"; 
            echo "<td>" . $user['Category'] . "</td>"; 
            echo "<td>" . $user['PayDate'] . "</td>"; 
            echo "<td>" . $user['PayAmount'] . "</td>";
            echo "<tr>"; 
        }
        echo "</table>";

        //Pending Charges Details

        echo "<br><h4>Pending Charges</h4><br>";
        $query="select * from PendingCharges natural join license where Shopkeeper_ID='$Shopkeeper_ID'";
        $result=mysqli_query($db,$query);
        $user=mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0)
        {
            echo "Shop ID: " . $user['Shop_ID'] . "<br>";
            echo "Electricity Bill Due: " . $user['ElectricityBillDue'] . "<br>";
            echo "Shop Rent Due" . $user['ShopRentDue'] . "<br>";
        }
        ?>
        <a href="logout.php">Logout</a>
        <?php endif ?>
       
    </div>
</body>
</html>