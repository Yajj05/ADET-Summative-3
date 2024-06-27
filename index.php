<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'functions.php';

// Initialize variables
$page = isset($_GET['page']) ? $_GET['page'] : 'view'; // Default page is 'view'
$pageTitle = '';
$pageContent = '';

// Set page title and content based on the requested page
switch ($page) {
    case 'add':
        $pageTitle = 'New Anime';
        $pageContent = 'add.php';
        break;
    case 'edit':
        $pageTitle = 'Edit Anime';
        $pageContent = 'edit.php';
        break;
    case 'delete':
        $pageTitle = 'Delete Anime';
        $pageContent = 'delete.php';
        break;
    case 'view_single':
        $pageTitle = 'View Anime Details';
        $pageContent = 'view_single.php';
        break;
    default:
        $pageTitle = 'All Anime';
        $pageContent = 'view.php';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom styles -->
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 15px;
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Anime Management</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo $page === 'add' ? 'active' : ''; ?>" href="index.php?page=add">
                    <i class="fas fa-plus-square mr-2"></i>Add Anime
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $page === 'view' ? 'active' : ''; ?>" href="index.php?page=view">
                    <i class="fas fa-video mr-2"></i>View All Anime
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $pageTitle; ?></h3>
            </div>
            <div class="card-body">
                <?php include $pageContent; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
