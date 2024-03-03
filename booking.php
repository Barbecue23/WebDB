<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>booking</title>
    <link rel="stylesheet" type="text/css" href="css/booking.css">
</head>
<body>
    <header>
        <h1>เช่าสนามฟุตบอล</h1>
        <nav>
            <ul>
                <li><a href="Home.html">หน้าแรก</a></li>
                <li><a href="services.html">เกี่ยวกับเรา</a></li>
                <li><a href="ContactUs.html">ติดต่อเรา</a></li>
                <li><a href="logout.php">ออกจากระบบ</a></li>
            </ul>
        </nav>
    </header>

<?php
include 'condb.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


// ค้นหาข้อมูล football_fields ทั้งหมด
$sql = "SELECT * FROM football_fields";
$result = $conn->query($sql);

// แสดงผลลัพธ์จากการค้นหา
if ($result->num_rows > 0) {
    echo "<table><tr><th>field_id</th><th>Size</th><th>name</th><th>location</th><th></th></tr>";

    // แสดงข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["field_id"]."</td><td>".$row["size"]."</td><td>".$row["name"]."</td><td>".$row["location"]."</td><td>".$row["rental_price"]."</td>";
        echo "<td>
            <form action='insert_booking.php' method='post'>
            <input type='hidden' name='football_field_id' value='".$row["field_id"]."'>
            <input type='hidden' name='rental_price' value='".$row["rental_price"]."'>
            <label for='start_time'>Start Time:</label>
            <input type='time' id='start_time' name='start_time'>
            <label for='end_time'>End Time:</label>
            <input type='time' id='end_time' name='end_time'>
            <label for='date'>Date:</label>
            <input type='date' id='date' name='date'>
            <br>
            <label for='details'>Details:</label>
            <input type='text' id='details' name='details'>

            <input type='submit' value='จอง'>
            </form>
        </td></tr>";
    }
    echo "</table>";
} else {
    echo "ไม่พบสนามฟุตบอล";
}


?>

<a href="reservations.php">สนามที่จองแล้วทั้งหมด</a>

</body>
</html>
<?php
include 'condb.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION["username"])) {
    // ถ้าไม่ได้เข้าสู่ระบบ ให้แสดงข้อความแจ้งเตือน
    echo "กรุณาเข้าสู่ระบบก่อนใช้งาน";
    // หรือให้ redirect ไปยังหน้า login
    header("Location: login.php");
    
} 


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

$_SESSION["user_id"] = $user_id;


if(isset($_POST['football_field_id']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['date']) && isset($_POST['details'])&& isset($_POST['rental_price'])) {
    // รับค่าที่ส่งมาจากฟอร์ม
    $field_id = $_POST['football_field_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];
    $rental_price = $_POST['rental_price'];
    $details = $_POST['details'];
    $payment_status = "paid"; // ตั้งค่า payment_status เป็น "paid"

    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูลลงในตาราง reservations
    $sql = "INSERT INTO reservations (field_id, start_time, end_time, date, details, payment_status, user_id) 
            VALUES ('$field_id', '$start_time', '$end_time', '$date', '$details', '$payment_status', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        echo "เพิ่มการจองสำเร็จ";
    } else {
        echo "เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }
}
?>