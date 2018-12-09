<?php
session_start();
require_once(__DIR__."/../php-scripts/MyPage.php");

$P =  new myPage();

$P->SetDescription("Mamy twoje pieniądze!");
$P->SetTitle("Rejestracja");

echo $P->Begin();
echo $P->Header();
echo $P->mainMenu();
echo $P->registerModule();
echo $P->Footer();
echo $P->End();
if (isset($_SESSION['registerError'])){
    unset($_SESSION['registerError']);
    echo "<script>alert('".$_SESSION['registerError']."');</script>";
}
?>