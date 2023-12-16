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

// Handle record deletion
if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    $deleteStmt = $conn->prepare("DELETE FROM `contact_form` WHERE id = ?");
    $deleteStmt->execute([$idToDelete]);
    header("Location: view_messages.php");
    exit();
}

// Retrieve messages from the database
$select_messages = $conn->query("SELECT * FROM `contact_form`");
$messages = $select_messages->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages</title>
</head>
<body>

<h2>Contact Form Messages</h2>

<table border="1">
    <tr>
        <th>Name</th>
        <th>Number</th>
        <th>Date</th>
        <th>Guests</th>
        <th>Action</th>
    </tr>

    <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $message['name']; ?></td>
            <td><?= $message['number']; ?></td>
            <td><?= $message['date']; ?></td>
            <td><?= $message['guests']; ?></td>
            <td>
                <!-- Edit Button -->
                <a href="edit_message.php?id=<?= $message['id']; ?>">Edit</a>

                <!-- Delete Button -->
                <a href="?delete=<?= $message['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
