<?php
include('config.php'); // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $title = $_POST['title'];
    $artist = $_POST['artist'];
    $album = $_POST['album'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];

    // Prepare the SQL query to insert the data into the tracks table
    $query = "INSERT INTO tracks (title, artist, album, genre, release_year) 
              VALUES (:title, :artist, :album, :genre, :release_year)";
    
    $stmt = $pdo->prepare($query);
    
    // Bind the values to the query
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':artist', $artist);
    $stmt->bindParam(':album', $album);
    $stmt->bindParam(':genre', $genre);
    $stmt->bindParam(':release_year', $release_year);

    // Execute the query and check if the insert was successful
    if ($stmt->execute()) {
        echo "<p>Song successfully added!</p>";
    } else {
        echo "<p>Something went wrong. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Song</title>
    <link rel="stylesheet" href="style.css">
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

</header>

<div class="container">
    <h2>Enter Song Details</h2>

    <!-- Form to add a new song -->
    <form action="add_song.php" method="POST">
        <label for="title">Song Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="artist">Artist Name:</label>
        <input type="text" id="artist" name="artist" required><br><br>

        <label for="album">Album Name:</label>
        <input type="text" id="album" name="album" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>

        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" min="1900" max="2099" required><br><br>

        <button type="submit">Add Song</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Music Collection</p>
</footer>

</body>
</html>
