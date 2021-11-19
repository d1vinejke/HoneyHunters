<?php
include 'mysql.php';

if(!empty($_POST['nickname']) && !empty($_POST['text'])){
    $name = $conn->real_escape_string($_POST["nickname"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $text = $conn->real_escape_string($_POST["text"]);
    $sql = "INSERT INTO `comment` (name, email, text) VALUES ('$name', '$email', '$text')";
    if(!$conn->query($sql)) echo "Something went wrong...";
    $json = array("name" => $name, "email" => $email, "text" => $text);
    echo json_encode($json);
}
mysqli_close($conn);