<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $username = $_SESSION['username'];

    // Get the user_id from the username
    $user_query = "SELECT id FROM users WHERE username = '$username'";
    $user_result = $conn->query($user_query);

    if ($user_result->num_rows > 0) {
        $user_row = $user_result->fetch_assoc();
        $user_id = $user_row['id'];

        // Insert the post with the user_id
        $sql = "INSERT INTO posts (title, body, user_id) VALUES ('$title', '$body', $user_id)";
        if ($conn->query($sql) === TRUE) {
            echo "Post created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "User not found";
    }
}

$conn->close();
?>
