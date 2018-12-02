<?php
function counter($file){
    $cnt = 0;
    if (count($_COOKIE) > 0) {
      $cookie = 0;
    } else {
      $cookie = 1;
      setcookie('count', $cookie, time()+3600*24, '/');
    }

    try {
      if (file_exists($file)) {
        $fp = fopen($file, "r");
        $i = fgets($fp, 10);
        if ($i===NULL){
          $i = "0";
        }
        $cnt = intval($i);
        fclose($fp);
        $cnt =  $cnt + $cookie ;
      }
      $fp = fopen($file,"w");
      fwrite($fp, $cnt);
      fclose($fp);
    } catch(Exception $e) {
      echo 'Wyjątek: ',  $e->getMessage(), "\n";
    }
    return $cnt;
}
?>

