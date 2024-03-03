<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Comment Page</title>
	<link rel="stylesheet" type="text/css" href="css/comment.css">
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
$_SESSION['user_id'] = $user_id;


?>
	<div class="container">
		<h1>Comment Page</h1>
		<form method="post" action="Home.html">
			
			<label for="suggestions">Comment:</label>
			<textarea id="comment" name="suggestions" required></textarea>
            <label for="satisfaction_level">point</label>
            <select id="satisfaction_level" name="satisfaction_level">
                <option value="1">1</option required>
                <option value="2">2</option required>
                <option value="3">3</option required>
                <option value="4">4</option required>
                <option value="5">5</option required>
                <option value="6">6</option required>
                <option value="7">7</option required>
                <option value="8">8</option required>
                <option value="9">9</option required>
                <option value="10">10</option required>
            </select>
            <button type="submit">Submit</button>
		</form>
		
	</div>
    
   
</body>
</html>
<?php
    if(isset($_POST['suggestions']) && isset($_POST['satisfaction_level']) ) {
    // รับค่าที่ส่งมาจากฟอร์ม
      $suggestions = $_POST['suggestions'];
      $satisfaction_level = $_POST['satisfaction_level'];

    $sql = ("INSERT INTO customer_feedback (user_id, suggestions, satisfaction_level) 
    VALUES ($user_id,$satisfaction_level, $suggestions)");
    } ?>