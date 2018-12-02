<?php
$conn = mysqli_connect("localhost", "root", "admin", "commentsforum");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$nick = $_POST["nick"];
$comment = $_POST["comment"];
echo $nick;
echo $comment;

$sql = "INSERT INTO opinie VALUES $nick, $comment";

$conn->close();

?>