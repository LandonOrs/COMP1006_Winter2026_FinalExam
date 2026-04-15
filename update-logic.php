<?php
session_start();

// Only allow POST requests for update logic to prevent direct URL access
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
require 'db.php';
// Get the image ID and new details from the POST request
$id = $_POST['id'] ?? null;
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
// Validate input
if (!$id || !$title || !$description) {
    die('Please provide all required fields.');
}
// Update the image details in the database
$stmt = $pdo->prepare("UPDATE images SET title = :title, description = :description
WHERE id = :id");
$stmt->execute(['title' => $title, 'description' => $description, 'id
' => $id]);
// Redirect back to the index page after updating
header("Location: index.php");
exit();
