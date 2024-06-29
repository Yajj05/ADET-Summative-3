<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$tasks = isset($_SESSION['tasks']) ? $_SESSION['tasks'] : [];
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Tasks</h3>
        </div>
        <div class="card-body">
            <?php if (empty($tasks)) : ?>
                <p>No tasks found. <a href="index.php?page=add">Add a new task</a>.</p>
            <?php else : ?>
                <ul class="list-group">
                    <?php foreach ($tasks as $index => $task) : ?>
                        <li class="list-group-item">
                            <strong><?php echo htmlspecialchars($task['title']); ?></strong><br>
                            Time: <?php echo htmlspecialchars($task['time']); ?><br>
                            Date: <?php echo htmlspecialchars($task['date']); ?><br>
                            <a href="index.php?page=edit&id=<?php echo $index; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="index.php?page=delete&id=<?php echo $index; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
