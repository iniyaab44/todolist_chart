<?php
require_once '../config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_number = $_POST['task_number'];
    $task_title = $_POST['task_title'];
    $description = $_POST['description'];
    $task_date = $_POST['task_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $user_id = $_SESSION['user_id'];
    
    // Validate and insert task
    if (!empty($task_title)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task_number, task_title, description, task_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $task_number, $task_title, $description, $task_date, $start_time, $end_time]);
        
        // Redirect back to home page
        header('Location: ../index.php?success=1');
        exit();
    }
}

header('Location: ../index.php');
exit();
?>