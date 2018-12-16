<?php
session_start();
require_once(__DIR__."/../php-scripts/MyPage.php");

$P =  new myPage();

$P->SetDescription("Mamy twoje pieniądze!");
$P->SetTitle("Login");

echo $_SERVER['SSL_CLIENT_VERIFY'];

echo $P->Begin();
echo $P->Header();
echo $P->mainMenu();
echo $P->loginModule();
echo $P->Footer();
echo $P->End();
if (isset($_SESSION['passwordChanged'])){
    unset($_SESSION['passwordChanged']);
    echo "<script>alert('Udało się zmienic hasło! Można się zalogowac');</script>";
}
if (isset($_SESSION['registerError'])){
    unset($_SESSION['registerError']);
    echo "<script>alert('Udało się utworzyc konto! Można się zalogowac');</script>";
}
?>