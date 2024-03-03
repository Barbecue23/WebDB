<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Summary</title>
    <link rel="stylesheet" type="text/css" href="css/payment.css">
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
    session_start(); 
   // ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION["username"])) {
    // ถ้าไม่ได้เข้าสู่ระบบ ให้ redirect ไปหน้า login
    header("Location: login.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
include 'condb.php';

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

echo 'User ID:' . $user_id;

?>
    

    <div class="container">
    <br>
    <h2>สรุปยอดเงิน</h2>
    <?php
    // เชื่อมต่อฐานข้อมูล
    include 'condb.php';

    



// ตรวจสอบว่ามีการเข้าสู่ระบบหรือไม่
if (!isset($_SESSION["username"])) {
    // ถ้าไม่ได้เข้าสู่ระบบ ให้ redirect ไปหน้า login
    header("Location: login.php");
    exit();
}


$total_payment = 0;


// ค้นหา user_id จาก username ที่เข้าสู่ระบบ
$sql = "SELECT user_id FROM customers WHERE user_Name = '".$_SESSION["username"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // ถ้าพบข้อมูล user_id ของผู้ใช้งาน
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];



// ดึงข้อมูลการชำระเงินของผู้ใช้งานที่เข้าสู่ระบบอยู่
$sql = "SELECT * FROM payments WHERE user_id = '".$user_id."'";
$result = $conn->query($sql);

// แสดงผลลัพธ์จากการค้นหา
if ($result->num_rows > 0) {
    echo "<table><tr><th>รหัสการชำระเงิน</th><th>วันที่ชำระเงิน</th><th>จำนวนเงิน</th></tr>";
    $total_payment = 0;
    // แสดงข้อมูลแต่ละแถว
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["payment_id"]."</td><td>".$row["payment_date"]."</td><td>".$row["amount"]."</td></tr>";
        $total_payment += $row["amount"];
    }
    echo "<tr><td colspan='2' style='text-align: right;'>รวมทั้งหมด</td><td>".$total_payment."</td></tr>";
    $total_payment += $row["amount"];
}
} else {
// ถ้าไม่พบข้อมูล user_id ของผู้ใช้งาน
echo "User ID not found";
}
mysqli_close($conn);
?>
</div>

 <br>
<div class="comment-section">
<a href="comment.php">แสดงความคิดเห็น</a>
</div>
