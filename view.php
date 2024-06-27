<div class="container mt-4">
    <h2>All Anime Rentals</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Genre</th>
                <th>Price per Day</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getAnimes() as $anime) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($anime['title']); ?></td>
                    <td><?php echo htmlspecialchars($anime['genre']); ?></td>
                    <td>$<?php echo htmlspecialchars($anime['price_per_day']); ?></td>
                    <td>
                        <a href="index.php?page=edit&id=<?php echo $anime['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="index.php?page=delete&id=<?php echo $anime['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
