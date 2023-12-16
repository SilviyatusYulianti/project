<?php
$db_name = 'contact_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if (isset($_GET['id'])) {
    $idToEdit = $_GET['id'];
    $select_message = $conn->prepare("SELECT * FROM `contact_form` WHERE id = ?");
    $select_message->execute([$idToEdit]);
    $messageToEdit = $select_message->fetch(PDO::FETCH_ASSOC);

    // Handle the form submission for editing
    if (isset($_POST['update'])) {
        $newName = $_POST['name'];
        $newNumber = $_POST['number'];
        $newDate = $_POST['date'];
        $newGuests = $_POST['guests'];

        $updateStmt = $conn->prepare("UPDATE `contact_form` SET name = ?, number = ?, date = ?, guests = ? WHERE id = ?");
        $updateStmt->execute([$newName, $newNumber, $newDate, $newGuests, $idToEdit]);

        header("Location: view_messages.php");
        exit();
    }
} else {
    // Redirect to view_messages.php if no ID is provided
    header("Location: view_messages.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Message</title>
</head>
<body>

<h2>Edit Message</h2>

<form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" name="name" value="<?= $messageToEdit['name']; ?>" required>

    <label for="number">Number:</label>
    <input type="number" name="number" value="<?= $messageToEdit['number']; ?>" required>

    <label for="date">Date:</label>
    <input type="date" name="date" value="<?= $messageToEdit['date']; ?>" required>

    <label for="guests">Guests:</label>
    <input type="number" name="guests" value="<?= $messageToEdit['guests']; ?>" required>

    <input type="submit" name="update" value="Update">
</form>

</body>
</html>
