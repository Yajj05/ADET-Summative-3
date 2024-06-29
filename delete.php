<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'functions.php';

if (!isset($_GET['id']) || !isset($_SESSION['tasks'][$_GET['id']])) {
    $_SESSION['alert'] = ['message' => 'Invalid task ID.', 'type' => 'danger'];
    header('Location: index.php?page=view');
    exit();
}

$taskId = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete the task
    deleteTask($taskId);
    $_SESSION['alert'] = ['message' => 'Task deleted successfully.', 'type' => 'success'];
    header('Location: index.php?page=view');
    exit();
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Delete Task</h3>
        </div>
        <div class="card-body">
            <?php if (isset($_SESSION['alert'])) : ?>
                <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['alert']['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['alert']); ?>
            <?php endif; ?>
            <p>Are you sure you want to delete this task?</p>
            <form action="index.php?page=delete&id=<?php echo $taskId; ?>" method="post">
                <button type="submit" class="btn btn-danger">Delete</button>
                <a href="index.php?page=view" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
