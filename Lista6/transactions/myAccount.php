<?php
session_start();
require_once(__DIR__."/../php-scripts/MyPage.php"); 

$P =  new myPage();
$P->SetDescription("We keep your money safe mate!");
$P->SetTitle("Golden Valley");

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$login = $_SESSION['login'];
$sql = "SELECT * FROM `login-data` WHERE `login`='".$login."';";
$result = $conn->query($sql);
if ($result->num_rows > 0){
    $_SESSION['balance'] = $result->fetch_row()[3];
}
$transactions = '';
$sql = "SELECT * FROM `transactions` WHERE `sender`='$login' OR `receiver`='$login';";
$result = $conn->query($sql);
while ($row = $result->fetch_row()){
    $transactions = $transactions."Data: $row[0] Nadawca: $row[1] Odbiorca: $row[2] Ilośc: $row[3] Sfinalizowana: $row[4]<br>";
}
$msg='';
echo $P->Begin();
echo $P->Header();
echo $P->loginMenu();
if(isset($_SESSION['trans'])){
    echo $P->createDiv6_6('Ostatni przelew!', $_SESSION['trans']);
    unset($_SESSION['trans']);
}
echo $P->transactionForm($_SESSION['balance'], $transactions);
echo $P->Footer();
echo $P->End();
?>