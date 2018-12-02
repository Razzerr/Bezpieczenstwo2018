<?php
require_once(__DIR__."/../PHP/MyPage.php");

$P =  new myPage();
$object = json_decode(file_get_contents(basename(__FILE__, ".php").".json"));

$P->SetDescription($object->{"siteDesc"});
$P->SetTitle($object->{"siteTitle"});

echo $P->Begin();
echo $P->Header();
echo $P->mainMenu(basename(__DIR__));

if (count($object->{"containers"}) == 1){
    echo "\n\t\t<main class=\"row\">";
    echo $P->createDiv4_6($object->{"containers"}[0]->{"title"}, $object->{"containers"}[0]->{"description"}, "{\mathcal {M}}=(M;R^{\mathcal {M}},\ldots ,f^{\mathcal {M}},\ldots ,c^{\mathcal {M}},\ldots )_{R\in R_{\\tau },f\in F_{\\tau },c\in S_{\\tau }}");
    echo $P->sideMenu(__DIR__, basename(__FILE__));
    echo "\n\t\t</main>";
}
else echo "Strona w budowie!";

echo $P->Footer();
echo $P->End();
?>
