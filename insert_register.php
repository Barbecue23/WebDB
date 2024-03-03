<?php
include 'condb.php';

//รับค่าตัวแปรมาจากไฟล์ register
$username = $_POST['user_Name'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$phonenumber = $_POST['phone_number'];
$address = $_POST['address'];

//เข้ารหัส password ด้วย sha512
//$password = hash('sha512',$password);

//คำสั่งเพิ่มข้อมูลลงตาราง member
$sql = "INSERT INTO customers(user_Name,name,address,phone_number,email,password)
Values('$username','$name','$address','$phonenumber','$email','$password') ";
$result = mysqli_query($conn,$sql);
if($result){
    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location='login.html'; </script>";
}else{
    echo "Error:" . $sql . "<br>" . mysqli_error($conn);
    echo "<script> alert('บันทึกข้อมูลไม่สำเร็จ'); </script>";
}
mysqli_close($conn)
?>