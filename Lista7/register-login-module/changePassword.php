<?php
session_start();
require_once(__DIR__."/../php-scripts/MyPage.php");

$P =  new myPage();

$P->SetDescription("Mamy twoje pieniądze!");
$P->SetTitle("Resetuj hasło");

echo $P->Begin();
echo $P->Header();
echo $P->loginMenu();
echo $P->passwordChange($_SESSION['email'], $_SESSION['login']); 
echo $P->Footer();
echo $P->End();
if (isset($_SESSION['passwordChanged'])){
    unset($_SESSION['passwordChanged']);
    echo "<script>alert('Nie udało się zmienic hasła!');</script>";
}
?>