<?php
include 'db.php';
session_start();


$post_id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $post_id, $_SESSION['user_id']);

if ($stmt->execute()) {
    echo "Post deleted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
