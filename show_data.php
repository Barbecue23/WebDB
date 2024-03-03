<?php
include 'condb.php';
session_start();

// ค้นหาข้อมูลในตาราง football_fields
$sql = "SELECT * FROM football_fields";
$result = $conn->query($sql);

// แสดงผลลัพธ์ในรูปแบบตาราง
if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>Field Name</th><th>Location</th><th>Size</th><th>Start Time</th><th>End Time</th><th>Action</th></tr>";
  while($row = $result->fetch_assoc()) {
    // แสดงข้อมูลแต่ละแถว
    echo "<tr><td>".$row["id"]."</td><td>".$row["field_name"]."</td><td>".$row["location"]."</td><td>".$row["size"]."</td><td>".$row["start_time"]."</td><td>".$row["end_time"]."</td>";
    // สร้างปุ่มจองด้านหลังแต่ละบันทัด
    echo "<td><form action='booking.php' method='POST'><input type='hidden' name='field_id' value='".$row["id"]."'><input type='submit' value='Book'></form></td></tr>";
  }
  echo "</table>";
} else {
  echo "No football fields found";
}

mysqli_close($conn);
?>
