<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $receiver = $_POST["uname"];
    $amount = $_POST["amount"];
}

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `login-data` WHERE `login`='".$receiver."';";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $date = date("Y-m-d H:i:s");
    $sender = $_SESSION['login'];

    $sql = "INSERT INTO `transactions`(`date`, `sender`, `receiver`, `amount`) VALUES ('$date', '$sender', '$receiver', '$amount')";
    $result = $conn->query($sql);
    if (!$result){
        $_SESSION['trans'] = "Nie ma takiego odbiorcy!";
        header("Location: myAccount.php");
        die();
    }

    $login = $_SESSION['login'];

    $sql = "UPDATE `login-data` SET `balance`=`balance` - $amount WHERE `login`='$login'";
    $result = $conn->query($sql);

    if (!$result){
        $_SESSION['trans'] = "Nie udało się wykonac przelewu z konta!";
        header("Location: myAccount.php");
        die();
    }

    $_SESSION['trans'] = "Pomyślnie wykonano przelew!\nOdbiorca: $receiver\nIlośc: $amount";
    header("Location: myAccount.php");
    die();
} else {
    $_SESSION['trans'] = "Niezidentyfikowany błąd";
    header("Location: myAccount.php");
    die();
}
?>