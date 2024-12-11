<?php
include('config.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];

    // Validate input data
    if (!empty($title) && !empty($artist) && !empty($album) && !empty($genre) && !empty($release_year)) {
        try {
            // Insert data into the database using a prepared statement
            $query = "INSERT INTO tracks (title, artist, album, genre, release_year) 
                      VALUES (:title, :artist, :album, :genre, :release_year)";
            $stmt = $pdo->prepare($query);

            // Bind parameters to the query
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':artist', $artist);
            $stmt->bindParam(':album', $album);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':release_year', $release_year);

            // Execute the query
            $stmt->execute();

            // Success message
            echo "<p>Song added successfully!</p>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "<p>Please fill in all fields.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Song</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Add a New Song</h1>
        <nav>
    <ul>
        <li><a href="all_albums.php">All Albums</a></li>
        <li><a href="all_songs.php">All Songs</a></li>
        <li><a href="artists.php">All Artists</a></li>
        <li><a href="new_album.php">Add New Album</a></li>
        <li><a href="new_song.php">Add New Song</a></li>
    </ul>
</nav>

        <nav>
    <ul>
        <li><a href="all_albums.php">All Albums</a></li>
        <li><a href="all_songs.php">All Songs</a></li>
        <li><a href="artists.php">All Artists</a></li>
        <li><a href="new_album.php">Add New Album</a></li>
        <li><a href="new_song.php">Add New Song</a></li>
    </ul>
</nav>

    </header>
    
    <main>
        <form method="POST">
            <label for="title">Song Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="artist">Artist:</label>
            <input type="text" id="artist" name="artist" required><br><br>

            <label for="album">Album:</label>
            <input type="text" id="album" name="album" required><br><br>

            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required><br><br>

            <label for="release_year">Release Year:</label>
            <input type="number" id="release_year" name="release_year" required><br><br>

            <button type="submit">Add Song</button>
        </form>
    </main>
</body>
</html>
