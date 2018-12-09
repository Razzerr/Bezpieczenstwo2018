<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $ids = $_POST["ids"];
}

$conn = mysqli_connect("localhost", "root", "admin", "users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id_list = explode(',', $ids);

foreach ($id_list as &$id){
    $sql = "SELECT * FROM `transactions` WHERE `ID`='".$id."';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $row = $result->fetch_row();
        if($row[5] == 0){
            $sql = "UPDATE `transactions` SET `finilized` = 1 WHERE `ID`='".$id."';";
            $result = $conn->query($sql);
            $sql = "UPDATE `login-data` SET `balance` = `balance` + ".$row[4]."WHERE `login`='".$row[3]."';";
            $result = $conn->query($sql);
        }
    }
}
header("Location: myAdmin.php");
die();
?>