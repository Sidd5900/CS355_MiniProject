<?php 
session_start();
$message="";
//User not logged in
if(!isset($_SESSION['Supervisor_ID']))
{
    echo "You need to login first <br>";
    header("location: SupervisorLogin.php");
}

//if login is successfull
if(isset($_SESSION['success']))
{
    $message=$_SESSION['success'];
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
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<h1 class="header">Market Shop Related Services</h1><br>
<?php echo "$message"; ?>
    <div class="container">
        <?php if(isset($_SESSION['Supervisor_ID'])): ?>
        <h3 class="subheading">Welcome <?php echo $_SESSION['Supervisor_ID'];?></h3>
        <?php 
        $Supervisor_ID=$_SESSION['Supervisor_ID'];

        //Add Bill or Update Bill Payment Details
        echo " <a class=\"addpay\" href=\"bill.php\">Add Bill/Update Bill Payment Details</a><br>" ;
        ?>

        <button id="shopbut">Shop Details</button>
        <button id="gatepassbut">Shopkeeper and Gatepass Details</button>
        <button id="licensebut">License Details</button>
        <button id="billbut">Bill Details</button>
        <button id="paybut">Pay Details</button>
        <button id="chargesbut">Pending Charges Details</button>
        <button id="summarybut">Shop Performance Summary</button>
        <?php
        //Shop Details
        echo "<div id=\"shopdiv\">";
        echo "<br><h4>Shop Details</h4><br>";
        $query="select * from Shop";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Shop ID</th> 
        <th>Shop Name</th> 
        <th>Area</th> 
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
        echo "</div>";
        
       
        echo "<div id=\"gatepassdiv\">";
         //Gatepass Validity
        echo "<br><h4>Details of Shopkeepers and their Gatepass Validity</h4><br>";
        $query="select * from shopkeeper natural join gatepass";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Shopkeeper ID</th> 
        <th>Name</th> 
        <th>PhoneNo</th> 
        <th>email</th> 
        <th>Gatepass ID</th> 
        <th>Valid From</th> 
        <th>Valid Till</th> 
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
        echo "</div>";
      
        //Shop License Details
        echo "<div id=\"licensediv\">";
        echo "<br><h4>Shop License Details</h4><br>";
        $query="select * from license";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Shop ID</th> 
        <th>Shopkeeper ID</th> 
        <th>License From</th> 
        <th>License Till</th> 
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
        echo "</div>";
        echo "<div id=\"billdiv\">";
        //View Bill Details
        echo "<br><h4>Bill Details</h4><br>";
        $query="select * from BillDetails";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Bill ID</th> 
         <th>Shop ID</th>
        <th>Bill Date</th> 
        <th>Shop Rent</th> 
        <th>Electricity Bill</th> 
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
        echo "</div>";
        //Pay Details
        echo "<div id=\"paydiv\">";
        echo "<br><h4>Previous Payment Details</h4><br>";
        $query="select * from PayDetails";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Reference ID</th> 
         <th>Shop ID</th>
        <th>Category</th> 
        <th>Payment Date</th> 
        <th>Amount Paid</th> 
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
        echo "</div>";
        //Pending Charges Details
        echo "<div id=\"chargesdiv\">";
        echo "<br><h4>Pending Charges</h4><br>";
        $query="select * from PendingCharges";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Shop ID</th>
        <th>Electricity Bill Due</th> 
        <th>Shop Rent Due</th> 
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
        echo "</div>";
        echo "<div id=\"summarydiv\">";
        //Performance summary through Feedback
        echo "<br><h4>Performance Summary</h4><br>";
        $query="select Shop_ID,avg(Quality),avg(Behaviour),avg(Value),avg(Variety),(avg(Quality)+avg(Behaviour)+avg(Value)+avg(Variety))/4 as OverallAverage from Feedback group by Shop_ID";
        $result=mysqli_query($db,$query);

        echo "
        <table >
         <tr>
         <th>Shop ID</th>
        <th>avg(Quality)</th> 
        <th>avg(Behaviour)</th> 
        <th>avg(Value)</th> 
        <th>avg(Variety)</th> 
        <th>OverallAverage</th> 
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
        echo "</div>";
   


        ?>
        <br>
        <a class="logout" href="logout.php">Logout</a>
        <?php endif ?>
       
    </div>
    <script src="index.js"></script>
</body>
</html>