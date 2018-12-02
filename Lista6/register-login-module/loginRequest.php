<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST["uname"];
    $psw = $_POST["psw"];
}

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `login-data` WHERE login='".$login."';";
$result = $conn->query($sql);
$row = $result->fetch_row();
if (password_verify($psw, $row[2])==1){
    $_SESSION['login'] = $login;
    $_SESSION['email'] = $row[0];
    $_SESSION['balance'] = $row[3];
    header("Location: ../transactions/myAccount.php");
} else {
    header("Location: login.php");
    die();
}
?>