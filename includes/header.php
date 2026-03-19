<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if current page is in auth folder
$is_auth_page = strpos($_SERVER['PHP_SELF'], '/auth/') !== false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <div class="nav-links">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="/index.php">Home</a>
                        <a href="/auth/logout.php">Logout</a>
                    <?php else: ?>
                   
                        <?php if(!$is_auth_page): ?>
                            <a href="/auth/login.php">Login</a>
                            <a href="/auth/register.php">Register</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div> 
                
                <!-- Spacer to balance the layout -->
                <div class="nav-spacer"></div>
            </nav>
        </header>
        <main>