<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST["uname"];
    $psw = $_POST["psw"];
}

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (strcmp($login, 'admin')==0){
    $sql = "SELECT * FROM `login-data` WHERE login='".$login."';";
    $result = $conn->query($sql);
    $row = $result->fetch_row();
    if (password_verify($psw, $row[2])==1){
        $_SESSION['login'] = $login;
        $_SESSION['email'] = $row[0];
        $_SESSION['balance'] = $row[3];
        header("Location: ../transactions/myAdmin.php");
        die();
    } else {
        header("Location: login.php");
        die();
    }
}

$sql = "SELECT * FROM `login-data` WHERE login='".$login."';";


if (mysqli_multi_query($conn ,$sql)){
  do{
    if ($result=mysqli_store_result($conn)) {
      while ($row=mysqli_fetch_row($result)){
        if (password_verify($psw, $row[2])==1){
            $_SESSION['login'] = $login;
            $_SESSION['email'] = $row[0];
            $_SESSION['balance'] = $row[3];
            header("Location: ../transactions/myAccount.php");
            die();
        } else {
            foreach ($row as &$res){
                echo $res.' ';
            }
            echo '<br>';
        }
      }
      // Free result set
      mysqli_free_result($result);
      }
    }
  while (mysqli_next_result($conn));
}
?>