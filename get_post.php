<?php
include 'db.php';
session_start();

$post_id = $_GET['id'];

$sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
    $post['editable'] = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id'];
    echo json_encode($post);
} else {
    echo "Post not found.";
}

$stmt->close();
$conn->close();
?>
