<?php
$conn = mysqli_connect("localhost", "root", "", "template");
if ($conn === false) {
    die("Ошибка: " . mysqli_connect_error());
}