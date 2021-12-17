<?php
session_start();

if(!isset($_SESSION['Supervisor_ID']))
{
    echo "You need to login first <br>";
    header("location: SupervisorLogin.php");
}

//connecting to the database
$db=mysqli_connect('localhost','root','password','dblab');
if(!$db)
{
    echo "error connecting";
    die(mysql_error());
}


if(isset($_POST['AddBill']))
{
    $Shop_ID=mysqli_real_escape_string($db,$_POST['Shop_ID']);
    $Bill_ID=mysqli_real_escape_string($db,$_POST['Bill_ID']);
    $BillDate=htmlentities($_POST['BillDate']);
    $BillDate = date('Y-m-d', strtotime($BillDate));
    $ShopRent=$_POST['ShopRent'];
    $ElectricityBill=$_POST['ElectricityBill'];

    $query="select * from Shop where Shop_ID='$Shop_ID'";
    $result=mysqli_query($db,$query) or die(mysql_error());
    $user=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0)
    {
        $query="insert into BillDetails values('$Bill_ID','$Shop_ID','$BillDate',$ShopRent,$ElectricityBill)" or die(mysql_error());
        $result=mysqli_query($db,$query) or die(mysql_error());
        echo "Bill details added successfully";
    }
    else
    {
        echo "Shop ID does not exist<br>";
    }
}

if(isset($_POST['PayElectricityBill']))
{
    $Shop_ID=mysqli_real_escape_string($db,$_POST['Shop_ID']);
    $Reference_ID=mysqli_real_escape_string($db,$_POST['Reference_ID']);
    $PayDate=htmlentities($_POST['PayDate']);
    $PayDate = date('Y-m-d', strtotime($PayDate));
    $PayAmount=$_POST['PayAmount'];

    $query="select * from Shop where Shop_ID='$Shop_ID'";
    $result=mysqli_query($db,$query) or die(mysql_error());

    if(mysqli_num_rows($result) > 0)
    {
        $query="call PayElectricityBill('$Reference_ID','$Shop_ID','$PayDate',$PayAmount)";
        $result=mysqli_query($db,$query) or die(mysql_error());
        echo "Electricity Bill Payment details updated successfully";
    }
    else
    {
        echo "Shop ID does not exist<br>";
    }
}

if(isset($_POST['PayShopRent']))
{
    $Shop_ID=mysqli_real_escape_string($db,$_POST['Shop_ID']);
    $Reference_ID=mysqli_real_escape_string($db,$_POST['Reference_ID']);
    $PayDate=htmlentities($_POST['PayDate']);
    $PayDate = date('Y-m-d', strtotime($PayDate));
    $PayAmount=$_POST['PayAmount'];
    $query="select * from Shop where Shop_ID='$Shop_ID'";
    $result=mysqli_query($db,$query) or die(mysql_error());

    if(mysqli_num_rows($result) > 0)
    {
        $query="call PayShopRent('$Reference_ID','$Shop_ID','$PayDate',$PayAmount)";
        $result=mysqli_query($db,$query) or die(mysql_error());
        echo "Shop Rent Payment details updated successfully";
    }
    else
    {
        echo "Shop ID does not exist<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<h1 class="header">Market Shop Related Services</h1><br>   
<div class="container">
<h4 class="subheading" style="width:50%;margin:auto;">Add New Bill</h4> 
    <form class="addbill" action="bill.php" method="post">
        <div>
        <label for="Bill_ID">Bill_ID</label>
        <input type="text" id="Bill_ID" name="Bill_ID" required><br>
        </div>
        <div>
        <label for="Shop_ID">Shop_ID</label>
        <input type="text" id="Shop_ID" name="Shop_ID" required><br>
        </div>
        <div>
        <label for="BillDate">Bill Date</label>
        <input type="date" id="BillDate" name="BillDate" required><br>

        </div>
        <div>
        <label for="ShopRent">Shop Rent</label>
             <input type="number" id="ShopRent" min="0" name="ShopRent" required><br>
        </div>
        <div>
        <label for="ElectricityBill">Electricity Bill</label>
        <input type="number" id="ElectricityBill" min="0" name="ElectricityBill" required><br>
        </div>

        <br> 
        <button type="submit" name="AddBill">Submit</button><br> 
        </form> 
        <br> 

<h4 class="subheading" style="width:50%;margin:auto;">Pay Electricity Bill</h4> 
    <form class="payelectricity" action="bill.php" method="post">
        <div>
            <label for="">Reference ID </label><input class="inp" type="text" name="Reference_ID" required><br>
        </div>
        <div>
            <label for="">Shop_ID</label> <input class="inp" type="text" name="Shop_ID" required><br>
        </div>
        <div>
        <label for="">Pay Date</label> <input class="inp" type="date" name="PayDate" required><br>
        </div>
        <div>
       <label for=""> Amount Paid</label> <input class="inp" type="number" min="0" name="PayAmount" required><br>
        </div>
        <br> 
        <button type="submit" name="PayElectricityBill">Submit</button><br> 
        </form>  
        <br> 
<h4 class="subheading" style="width:50%;margin:auto;">Pay Shop Rent</h4>       
        <form class="payrent" action="bill.php" method="post">
        <div>
            <label for="">Reference ID </label><input class="inp" type="text" name="Reference_ID" required><br>
        </div>
        <div>
            <label for="">Shop_ID</label> <input class="inp" type="text" name="Shop_ID" required><br>
        </div>
        <div>
        <label for="">Pay Date</label> <input class="inp" type="date" name="PayDate" required><br>
        </div>
        <div>
       <label for=""> Amount Paid </label><input class="inp" type="number" min="0" name="PayAmount" required><br>
        </div>
        <br> 
        <button type="submit" name="PayShopRent">Submit</button>
        </form>   
        <br> 
        <a class="home" href="SupervisorWelcome.php">Return to the Main Page</a><br>
        <a class="logout" href="logout.php">Logout</a>
       
    
</div>        
</body>
</html>