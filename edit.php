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
$task = $_SESSION['tasks'][$taskId];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process form data
    $title = htmlspecialchars(trim($_POST['title']));
    $time = htmlspecialchars(trim($_POST['time']));
    $date = htmlspecialchars(trim($_POST['date']));

    // Perform validation (you can add more complex validation as needed)
    $errors = [];
    if (empty($title)) {
        $errors[] = "Task is required.";
    }
    if (empty($time)) {
        $errors[] = "Time is required.";
    }
    if (empty($date)) {
        $errors[] = "Date is required.";
    }

    // If no errors, edit the task
    if (empty($errors)) {
        editTask($taskId, $title, $time, $date);
        $_SESSION['alert'] = ['message' => 'Task updated successfully.', 'type' => 'success'];
        header('Location: index.php?page=view');
        exit();
    } else {
        // Set error messages
        foreach ($errors as $error) {
            $_SESSION['alert'] = ['message' => $error, 'type' => 'danger'];
        }
    }
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Task</h3>
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
            <form action="index.php?page=edit&id=<?php echo $taskId; ?>" method="post">
                <div class="form-group">
                    <label for="title">Task</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="time">Time</label>
                    <input type="text" class="form-control" id="time" name="time" value="<?php echo htmlspecialchars($task['time']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($task['date']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
        </div>
    </div>
</div>
