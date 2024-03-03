<!DOCTYPE html>
<html>
<head>
    <title>Reservations</title>
    <link rel="stylesheet" href="css/res.css">
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
	<h2>การจองสนามทั้งหมด</h2>
<?php
include 'condb.php';
session_start();
// ค้นหาข้อมูล reservations ทั้งหมดของผู้ใช้งานที่เข้าสู่ระบบ
$sql = "SELECT * FROM reservations";
$result = mysqli_query($conn, $sql);

echo "<table>";
echo "<tr>";
echo "<th>Reservation ID</th>";
echo "<th>Date</th>";
echo "<th>Start Time</th>";
echo "<th>End Time</th>";
echo "<th>Details</th>";
echo "<th>Payment Status</th>";
echo "<th>User ID</th>";
echo "<th>Field ID</th>";
echo "</tr>";

if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row["reservation_id"] . "</td>";
echo "<td>" . $row["date"] . "</td>";
echo "<td>" . $row["start_time"] . "</td>";
echo "<td>" . $row["end_time"] . "</td>";
echo "<td>" . $row["details"] . "</td>";
echo "<td>" . $row["payment_status"] . "</td>";
echo "<td>" . $row["user_id"] . "</td>";
echo "<td>" . $row["field_id"] . "</td>";
echo "</tr>";
}
} else {
echo "<tr><td colspan='8'>ไม่พบข้อมูลการจอง</td></tr>";
}

mysqli_close($conn);
?>

</table>
</body>
</html>