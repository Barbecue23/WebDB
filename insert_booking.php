<?php
include 'condb.php';
session_start();

// ค้นหา user_id จาก username ที่เข้าสู่ระบบ
$sql = "SELECT user_id FROM customers WHERE user_Name = '".$_SESSION["username"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ถ้าพบข้อมูล user_id ของผู้ใช้งาน
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];
} else {
    // ถ้าไม่พบข้อมูล user_id ของผู้ใช้งาน
    echo "ไม่พบข้อมูลผู้ใช้งาน";
}



if(isset($_POST['football_field_id']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['date']) && isset($_POST['details'])) {
  // รับค่าที่ส่งมาจากฟอร์ม
    $field_id = $_POST['football_field_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];
    $details = $_POST['details'];
    $payment_status = "paid"; // ตั้งค่า payment_status เป็น "paid"
   
  // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในตาราง reservations
  $sql = "INSERT INTO reservations (field_id, start_time, end_time, date, details, payment_status, user_id) 
VALUES ('$field_id', '$start_time', '$end_time', '$date', '$details', '$payment_status', '$user_id')";
  
    if ($conn->query($sql) === TRUE) {
      echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
      echo "<script> window.location='comment.php'; </script>";
    } else {
      echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $conn->error;
    }
  
    mysqli_close($conn);
  }

?>  
