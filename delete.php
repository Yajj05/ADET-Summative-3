<?php
$id = $_GET['id'] ?? null;
$anime = getAnimeById($id);

if (!$anime) {
    $_SESSION['alert'] = ['message' => 'Anime not found.', 'type' => 'danger'];
    header('Location: index.php?page=view');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    deleteAnime($id);
    $_SESSION['alert'] = ['message' => 'Anime deleted successfully.', 'type' => 'success'];
    header('Location: index.php?page=view');
    exit();
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Delete Anime</h3>
        </div>
        <div class="card-body">
            <p>Are you sure you want to delete this anime?</p>
            <p><strong>Title:</strong> <?php echo htmlspecialchars($anime['title']); ?></p>
            <p><strong>Genre:</strong> <?php echo htmlspecialchars($anime['genre']); ?></p>
            <p><strong>Price per Day:</strong> <?php echo htmlspecialchars($anime['price_per_day']); ?></p>
        </div>
        <div class="card-footer">
            <form action="index.php?page=delete&id=<?php echo $anime['id']; ?>" method="post">
                <button type="submit" name="confirm" class="btn btn-danger">Confirm Delete</button>
                <a href="index.php?page=view" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
