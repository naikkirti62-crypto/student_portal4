<?php
session_start();
include "db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();

        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if($row['role'] == "admin"){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: student_dashboard.php");
        }
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body{font-family:Arial;background:#f2f2f2;}
.container{
    width:350px;
    margin:100px auto;
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
    background:#007bff;
    color:white;
    border:none;
}
</style>
</head>
<body>

<div class="container">
<h2 align="center">Login</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
</div>

</body>
</html>