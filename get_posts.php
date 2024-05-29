<?php
include 'db.php';
session_start();

$sql = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

$posts = array();
while($row = $result->fetch_assoc()) {
    $row['editable'] = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id'];
    $posts[] = $row;
}

echo json_encode($posts);
?>
