<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and process form data
    $title = htmlspecialchars(trim($_POST['title']));
    $genre = htmlspecialchars(trim($_POST['genre']));
    $price_per_day = htmlspecialchars(trim($_POST['price_per_day']));

    // Perform validation (you can add more complex validation as needed)
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

    // If no errors, add the anime
    if (empty($errors)) {
        addAnime($title, $genre, $price_per_day);
        $_SESSION['alert'] = ['message' => 'Anime added successfully.', 'type' => 'success'];
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
            <h3 class="card-title">Add New Anime</h3>
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
            <form action="index.php?page=add" method="post">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" class="form-control" id="genre" name="genre" placeholder="Enter genre" required>
                </div>
                <div class="form-group">
                    <label for="price_per_day">Price per Day</label>
                    <input type="number" class="form-control" id="price_per_day" name="price_per_day" placeholder="Enter price per day" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Anime</button>
            </form>
        </div>
    </div>
</div>