<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_GET['id'];
    $title = htmlspecialchars(trim($_POST['title']));
    $genre = htmlspecialchars(trim($_POST['genre']));
    $price_per_day = htmlspecialchars(trim($_POST['price_per_day']));

    // Validate inputs (add more validation as needed)
    $errors = [];
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($genre)) {
        $errors[] = "Genre is required.";
    }
    if (empty($price_per_day)) {
        $errors[] = "Price per day is required.";
    } elseif (!is_numeric($price_per_day) || $price_per_day <= 0) {
        $errors[] = "Invalid price per day.";
    }

    if (empty($errors)) {
        editAnime($id, $title, $genre, $price_per_day);
        $_SESSION['alert'] = ['message' => 'Anime updated successfully.', 'type' => 'success'];
        header('Location: index.php?page=view');
        exit();
    } else {
        // Set error messages
        foreach ($errors as $error) {
            $_SESSION['alert'] = ['message' => $error, 'type' => 'danger'];
        }
    }
}

$id = $_GET['id'] ?? null;
$anime = getAnimeById($id);

if (!$anime) {
    $_SESSION['alert'] = ['message' => 'Anime not found.', 'type' => 'danger'];
    header('Location: index.php?page=view');
    exit();
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Anime</h3>
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
            <form action="index.php?page=edit&id=<?php echo $anime['id']; ?>" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($anime['title']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" value="<?php echo htmlspecialchars($anime['genre']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price_per_day">Price per Day</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" value="<?php echo htmlspecialchars($anime['price_per_day']); ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Update Anime</button>
                <a href="index.php?page=view" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
