<?php
require_once(__DIR__."/../php-scripts/MyPage.php");

$P =  new myPage();

$P->SetDescription("Mamy twoje pieniądze!");
$P->SetTitle("Twoje konto");

echo $P->Begin();
echo $P->Header();
echo $P->mainMenu();
echo $P->loginModule();
echo $P->Footer();
echo $P->End();
?>