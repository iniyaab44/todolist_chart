<?php
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: auth/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle task addition
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])) {
    $task_number = $_POST['task_number'];
    $task_title = $_POST['task_title'];
    $description = $_POST['description'];
    $task_date = $_POST['task_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    
    if (!empty($task_title)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, task_number, task_title, description, task_date, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $task_number, $task_title, $description, $task_date, $start_time, $end_time]);
        $success = "Task added successfully!";
    }
}

// Get user's tasks
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tasks = $stmt->fetchAll();

include 'includes/header.php';
?>

<!-- Task Manager Title in Body (Centered) -->
<div class="page-title">
    <h1>Task Manager</h1>
</div>

<!-- Section 1: Add New Task -->
<section class="form-container">
    <h2>Add New Task</h2>
    
    <?php if(isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>
    
    <form id="taskForm" method="POST" action="">
        <div class="form-group">
            <label for="task_number">Task Number:</label>
            <input type="text" id="task_number" name="task_number" placeholder="Enter task number">
        </div>
        
        <div class="form-group">
            <label for="task_title">Task Title *:</label>
            <input type="text" id="task_title" name="task_title" required placeholder="Enter task title">
        </div>
        
        <div class="form-group">
            <label for="description">Task Description:</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter detailed task description"></textarea>
        </div>
        
        <div class="form-group">
            <label for="task_date">Date:</label>
            <input type="date" id="task_date" name="task_date">
        </div>
        
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" id="start_time" name="start_time">
        </div>
        
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" id="end_time" name="end_time">
        </div>
        
        <button type="submit" name="add_task" class="btn">Add Task</button>
    </form>
</section>

<!-- Section 2: Task Overview Table -->
<section class="table-container">
    <h2>Task Overview</h2>
    
    <?php if(count($tasks) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Task #</th>
                <th>Task Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tasks as $task): ?>
            <tr>
                <td><?php echo htmlspecialchars($task['task_number'] ?: '-'); ?></td>
                <td><?php echo htmlspecialchars($task['task_title']); ?></td>
                <td><?php echo htmlspecialchars($task['description'] ?: '-'); ?></td>
                <td><?php echo $task['task_date'] ? date('Y-m-d', strtotime($task['task_date'])) : '-'; ?></td>
                <td><?php echo $task['start_time'] ? date('h:i A', strtotime($task['start_time'])) : '-'; ?></td>
                <td><?php echo $task['end_time'] ? date('h:i A', strtotime($task['end_time'])) : '-'; ?></td>
                <td><?php echo date('Y-m-d', strtotime($task['created_at'])); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="text-align: center; padding: 30px;">No tasks yet. Add your first task above!</p>
    <?php endif; ?>
</section>

<!-- Section 3: Task Analytics -->
<section class="chart-container">
    <h2>Task Analytics</h2>
    
    <?php if(count($tasks) > 0): ?>
    <div class="charts">
        <div class="chart-box">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="chart-box">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <?php else: ?>
    <p style="text-align: center; padding: 30px;">Add some tasks to see analytics!</p>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>