<?php
session_start();
include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'student'){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM students WHERE username='$username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<style>
body{font-family:Arial;background:#f2f2f2;}
.container{
    width:600px;
    margin:50px auto;
    padding:20px;
    background:white;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}
table{
    width:100%;
    border-collapse:collapse;
}
table, th, td{
    border:1px solid #ccc;
}
th, td{
    padding:10px;
    text-align:center;
}
.logout{
    float:right;
    color:red;
    text-decoration:none;
}
</style>
</head>
<body>

<div class="container">

<a href="logout.php" class="logout">Logout</a>

<h2 align="center">Welcome <?php echo $username; ?></h2>

<?php
if($result->num_rows > 0){
$row = $result->fetch_assoc();
?>

<table>
<tr>
<th>Name</th>
<th>Attendance</th>
<th>Assignment</th>
<th>Midterm</th>
<th>Final</th>
<th>Result</th>
</tr>

<tr>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['attendance']; ?></td>
<td><?php echo $row['assignment']; ?></td>
<td><?php echo $row['midterm']; ?></td>
<td><?php echo $row['final_exam']; ?></td>
<td><b><?php echo $row['result']; ?></b></td>
</tr>
</table>

<?php
}else{
echo "<p style='color:red;text-align:center;'>No Marks Added Yet</p>";
}
?>

</div>

</body>
</html>