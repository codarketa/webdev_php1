<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: list_users.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <br>
        <label>Password (leave blank to keep current password):</label>
        <input type="password" name="password">
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <br>
        <input type="submit" value="Update User">
    </form>
</body>
</html>
