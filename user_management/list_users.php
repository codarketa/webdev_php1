//by codarketa

<?php
// config.php file ma include garxa(Include the config.php file)
include 'config.php';

// sabai users lai fetch(tanne) SQL query banaunxa(Create an SQL query to fetch all users)
$sql = "SELECT * FROM users";
// query chalayera result linxa (Run the query and get the result)
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    <a href="add_user.php">Add User</a> <!-- (Place an "Add User" link) -->
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php
        // check garxa ki result ma kunai rows cha ki chaina (Check if there are any rows in the result)
        if ($result->num_rows > 0) { // >0 vanu ko matlab euta vayepani rows huna paryo
            // sabai rows lai loop garxa (Loop through all rows)
            while($row = $result->fetch_assoc()) {
                // row ko data display garxa (Display the row data)
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['id']}'>Edit</a>  <!-- Edit link rakheko -->
                            <a href='delete_user.php?id={$row['id']}'>Delete</a> <!-- Delete link rakhnus  -->
                        </td>
                      </tr>";
            }
        } else {
            // kunai users chaina bhane message display garxa (Display a message if no users are found)
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        // (Close the database connection)
        $conn->close();
        ?>
    </table>
</body>
</html>
