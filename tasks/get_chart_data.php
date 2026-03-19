<?php
require_once '../config/database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['labels' => [], 'values' => []]);
    exit();
}

$user_id = $_SESSION['user_id'];

// Get task frequencies for charts
$stmt = $pdo->prepare("SELECT task_title, COUNT(*) as count FROM tasks WHERE user_id = ? GROUP BY task_title ORDER BY count DESC LIMIT 10");
$stmt->execute([$user_id]);
$results = $stmt->fetchAll();

$labels = [];
$values = [];

foreach ($results as $row) {
    $labels[] = $row['task_title'];
    $values[] = (int)$row['count'];
}

echo json_encode([
    'labels' => $labels,
    'values' => $values
]);
?>