<?php
include 'db.php';
session_start();


$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$comment = $_POST['comment'];

$sql = "INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $post_id, $user_id, $comment);

if ($stmt->execute()) {
    echo "Comment added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
