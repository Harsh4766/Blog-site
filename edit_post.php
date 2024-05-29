<?php
include 'db.php';
session_start();


$post_id = $_POST['id'];
$title = $_POST['title'];
$body = $_POST['body'];

$sql = "UPDATE posts SET title = ?, body = ? WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $title, $body, $post_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo "Post updated successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
