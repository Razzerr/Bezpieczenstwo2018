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
if ($result->num_rows > 0){
    $_SESSION['registerError'] = 'Login już zarejestrowany!';
    header("Location: register.php");
    die();
}
if ($psw == $psw2){
    $psw = password_hash($psw, PASSWORD_BCRYPT);
    $sql = "INSERT INTO `login-data`(`email`, `login`, `password`, `balance`) VALUES ('$email', '$login', '$psw', 0)";
    $result = $conn->query($sql);
    if($result){
        $_SESSION['registerError'] = '';
        header("Location: login.php");
        die();
    }
} else {
    $_SESSION['registerError'] = 'Niezgodnośc haseł!';
    header("Location: register.php");
    die();
}
?>