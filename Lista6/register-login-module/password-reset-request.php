<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $login = $_POST["uname"];
    $psw = $_POST["psw"];
    $psw2 = $_POST["psw2"];
}

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `login-data` WHERE login='".$login."';";
$result = $conn->query($sql);
if ($result->num_rows > 0 && $result->fetch_row()[0] == $email && $psw == $psw2){
    $psw = password_hash($psw, PASSWORD_BCRYPT);
    $sql = "UPDATE `login-data` SET `password`='$psw' WHERE login='$login'";
    $result = $conn->query($sql);
    $_SESSION['passwordChanged']=true;
    session_unset();
    header("Location: login.php");
    die();
} else {
    $_SESSION['passwordChanged']=false;
    session_unset();
    header("Location: forgot-password.php");
    die(); 
}
?>