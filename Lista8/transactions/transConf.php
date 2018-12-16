<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $receiver = $_POST["uname"];
    $amount = $_POST["amount"];
}

require_once(__DIR__."/../php-scripts/MyPage.php");

$P =  new myPage();

$P->SetDescription("We keep your money safe mate!");
$P->SetTitle("Golden Valley");

echo $P->Begin();
echo $P->Header();
echo $P->loginMenu();
echo $P->transactionConf($receiver, $amount);
echo $P->Footer();
echo $P->End();

?>