<?php
session_start();
include "db.php";

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){

    $username   = $_POST['username'];
    $name       = $_POST['name'];
    $attendance = $_POST['attendance'];
    $assignment = $_POST['assignment'];
    $midterm    = $_POST['midterm'];
    $final      = $_POST['final_exam'];

    $total = ($attendance + $assignment + $midterm + $final) / 4;
    $result = ($total >= 40) ? "Pass" : "Fail";

    $sql = "INSERT INTO students 
            (username, name, attendance, assignment, midterm, final_exam, result)
            VALUES 
            ('$username','$name','$attendance','$assignment','$midterm','$final','$result')";

    if($conn->query($sql)){
        echo "<script>alert('Marks Added Successfully');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body{font-family:Arial;background:#f2f2f2;}
.container{
    width:500px;
    margin:50px auto;
    padding:20px;
    background:white;
    border-radius:10px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}
input{
    width:100%;
    padding:8px;
    margin:8px 0;
}
button{
    width:100%;
    padding:8px;
    background:green;
    color:white;
    border:none;
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

<h2 align="center">Admin Dashboard</h2>

<form method="POST">

<input type="text" name="username" placeholder="Student Username" required>
<input type="text" name="name" placeholder="Student Name" required>
<input type="number" name="attendance" placeholder="Attendance" required>
<input type="number" name="assignment" placeholder="Assignment" required>
<input type="number" name="midterm" placeholder="Midterm" required>
<input type="number" name="final_exam" placeholder="Final Exam" required>

<button type="submit" name="save">Save Marks</button>

</form>

</div>

</body>
</html>