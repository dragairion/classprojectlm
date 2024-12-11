<?php
// browse.php
// Include database configuration
include 'config.php';

try {
    $stmt = $pdo->query("SELECT * FROM tracks ORDER BY id DESC");
    $tracks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Music Collection</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Browse Music Collection</h1>
</header>
<nav>
    <a href="index.php">Home</a>
    <a href="add.php">Add New Music</a>
    <a href="browse.php">Browse Collection</a>
</nav>
<div class="container">
    <?php if ($tracks): ?>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Album</th>
                    <th>Genre</th>
                    <th>Release Year</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tracks as $track): ?>
                    <tr>
                        <td><?= htmlspecialchars($track['title']) ?></td>
                        <td><?= htmlspecialchars($track['artist']) ?></td>
                        <td><?= htmlspecialchars($track['album']) ?></td>
                        <td><?= htmlspecialchars($track['genre']) ?></td>
                        <td><?= htmlspecialchars($track['release_year']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No music found in the collection.</p>
    <?php endif; ?>
</div>
</body>
</html>