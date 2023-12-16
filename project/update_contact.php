<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $guests = $_POST['guests'];
    $data = $_POST['guests'];

    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo 'Contact updated successfully';
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
}

$conn->close();
?>
