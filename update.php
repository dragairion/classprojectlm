<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $artist_id = $_POST['artist_id'];
    $genre_id = $_POST['genre_id'];
    $release_year = $_POST['release_year'];

    $sql = "UPDATE music SET title = ?, artist_id = ?, genre_id = ?, release_year = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $artist_id, $genre_id, $release_year, $id]);

    header("Location: browse.php");
    exit;
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the music record
    $sql = "SELECT * FROM music WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $music = $stmt->fetch();

    // Fetch all artists for the dropdown
    $artist_sql = "SELECT id, name FROM Artists";
    $artists = $pdo->query($artist_sql)->fetchAll(PDO::FETCH_ASSOC);

    // Fetch all genres for the dropdown
    $genre_sql = "SELECT id, name FROM Genres";
    $genres = $pdo->query($genre_sql)->fetchAll(PDO::FETCH_ASSOC);
}

if (!$music) {
    echo "Music not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Music</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Update Music</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $music['id'] ?>">
        
        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($music['title']) ?>" required>
        
        <label>Artist:</label>
        <select name="artist_id" required>
            <?php foreach ($artists as $artist): ?>
                <option value="<?= $artist['id'] ?>" <?= $artist['id'] == $music['artist_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($artist['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label>Genre:</label>
        <select name="genre_id" required>
            <?php foreach ($genres as $genre): ?>
                <option value="<?= $genre['id'] ?>" <?= $genre['id'] == $music['genre_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($genre['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label>Release Year:</label>
        <input type="number" name="release_year" value="<?= $music['release_year'] ?>" required>
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
