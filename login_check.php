<?php
include 'condb.php';
session_start();

$username = $_POST['user_Name'];
$password = $_POST['password'];

//เข้ารหัส password ด้วย sha512
//$password = hash('sha512',$password);

$sql = "SELECT * FROM customers WHERE user_Name = '$username' and password = '$password' ";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);

if($row>0){
    $_SESSION["username"]=$row['user_Name'];
    $_SESSION["pw"]=$row['password'];
    $_SESSION["name"]=$row['name'];
    $show=header("location:booking.php");
}else{
    $_SESSION["Error"] = "<p> Your user_Name or password is invalid</p>";
    $show=header("location:login.html");
}
echo $show

?>