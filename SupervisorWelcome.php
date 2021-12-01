<?php 
session_start();

//User not logged in
if(!isset($_SESSION['Supervisor_ID']))
{
    echo "You need to login first <br>";
    header("location: SupervisorLogin.php");
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
<h2 class="header">Market Shop Related Services</h2><br>
    <div class="container">
        <?php if(isset($_SESSION['Supervisor_ID'])): ?>
        <h3>Welcome <?php echo $_SESSION['Supervisor_ID'];?></h3>
        <?php 
        $Supervisor_ID=$_SESSION['Supervisor_ID'];

        //Add Bill or Update Bill Payment Details
        echo " <a href=\"bill.php\">Add Bill/Update Bill Payment Details</a><br>" ;


        //Shop Details

        echo "<br><h4>Shop Details</h4><br>";
        $query="select * from Shop";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Shop ID</td> 
        <td>Shop Name</td> 
        <td>Area</td> 
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


        //Gatepass Validity

        echo "<br><h4>Details of Shopkeepers and their Gatepass Validity</h4><br>";
        $query="select * from shopkeeper natural join gatepass";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Shopkeeper ID</td> 
        <td>Name</td> 
        <td>PhoneNo</td> 
        <td>email</td> 
        <td>Gatepass ID</td> 
        <td>Valid From</td> 
        <td>Valid Till</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Shopkeeper_ID'] . "</td>"; 
            echo "<td>" . $user['Name'] . "</td>"; 
            echo "<td>" . $user['PhoneNo'] . "</td>"; 
            echo "<td>" . $user['email'] . "</td>"; 
            echo "<td>" . $user['Gatepass_ID'] . "</td>"; 
            echo "<td>" . $user['ValidFrom'] . "</td>"; 
            $curdate=date("Y-m-d");
            $nextmonth=date('Y-m-d', strtotime($curdate. ' + 30 days'));
            if($user['ValidTill']<$curdate)
            echo "<td style=\"color:red;\">" . $user['ValidTill'] . "</td>"; 
            else if($user['ValidTill']<$nextmonth)
            echo "<td style=\"color:blue;\">" . $user['ValidTill'] . "</td>"; 
            else
            echo "<td>" . $user['ValidTill'] . "</td>"; 
            echo "<tr>"; 
        }
        echo "</table>";

      
        //Shop License Details

        echo "<br><h4>Shop License Details</h4><br>";
        $query="select * from license";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Shop ID</td> 
        <td>Shopkeeper ID</td> 
        <td>License From</td> 
        <td>License Till</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['Shopkeeper_ID'] . "</td>"; 
            echo "<td>" . $user['LicenseFrom'] . "</td>"; 
            $curdate=date("Y-m-d");
            $nextmonth=date('Y-m-d', strtotime($curdate. ' + 30 days'));
            if($user['LicenseTill']<$curdate)
            echo "<td style=\"color:red;\">" . $user['LicenseTill'] . "</td>"; 
            else if($user['LicenseTill']<$nextmonth)
            echo "<td style=\"color:blue;\">" . $user['LicenseTill'] . "</td>"; 
            else
            echo "<td>" . $user['LicenseTill'] . "</td>"; 
            echo "<tr>"; 
        }
        echo "</table>";

        //View Bill Details
        echo "<br><h4>Bill Details</h4><br>";
        $query="select * from BillDetails";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Bill ID</td> 
         <td>Shop ID</td>
        <td>Bill Date</td> 
        <td>Shop Rent</td> 
        <td>Electricity Bill</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Bill_ID'] . "</td>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['BillDate'] . "</td>"; 
            echo "<td>" . $user['ShopRent'] . "</td>"; 
            echo "<td>" . $user['ElectricityBill'] . "</td>";
            echo "<tr>"; 
        }
        echo "</table>";

        //Pay Details

        echo "<br><h4>Previous Payment Details</h4><br>";
        $query="select * from PayDetails";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Reference ID</td> 
         <td>Shop ID</td>
        <td>Category</td> 
        <td>Payment Date</td> 
        <td>Amount Paid</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Reference_ID'] . "</td>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['Category'] . "</td>"; 
            echo "<td>" . $user['PayDate'] . "</td>"; 
            echo "<td>" . $user['PayAmount'] . "</td>";
            echo "<tr>"; 
        }
        echo "</table>";

        //Pending Charges Details

        echo "<br><h4>Pending Charges</h4><br>";
        $query="select * from PendingCharges";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Shop ID</td>
        <td>Electricity Bill Due</td> 
        <td>Shop Rent Due</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['ElectricityBillDue'] . "</td>"; 
            echo "<td>" . $user['ShopRentDue'] . "</td>"; 
            echo "<tr>"; 
        }
        echo "</table>";

        //Performance summary through Feedback
        echo "<br><h4>Performance Summary</h4><br>";
        $query="select Shop_ID,avg(Quality),avg(Behaviour),avg(Value),avg(Variety),(avg(Quality)+avg(Behaviour)+avg(Value)+avg(Variety))/4 as OverallAverage from Feedback group by Shop_ID";
        $result=mysqli_query($db,$query);

        echo "
        <table border=\"5\" cellpadding=\"5\"  bordercolor=\"#808080\" bgcolor=\"#C0C0C0\">
         <tr>
         <td>Shop ID</td>
        <td>avg(Quality)</td> 
        <td>avg(Behaviour)</td> 
        <td>avg(Value)</td> 
        <td>avg(Variety)</td> 
        <td>OverallAverage</td> 
        </tr>"; 

        while($user=mysqli_fetch_assoc($result))
        {
            echo "<tr>"; 
            echo "<td>" . $user['Shop_ID'] . "</td>"; 
            echo "<td>" . $user['avg(Quality)'] . "</td>"; 
            echo "<td>" . $user['avg(Behaviour)'] . "</td>"; 
            echo "<td>" . $user['avg(Value)'] . "</td>"; 
            echo "<td>" . $user['avg(Variety)'] . "</td>"; 
            echo "<td>" . $user['OverallAverage'] . "</td>"; 
            echo "<tr>"; 
        }
        echo "</table>";

   


        ?>
        <br>
        <a href="logout.php">Logout</a>
        <?php endif ?>
       
    </div>
</body>
</html>