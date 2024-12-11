<?php
include('config.php'); // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $album_name = $_POST['album_name'];
    $artist_name = $_POST['artist_name'];
    $release_year = $_POST['release_year'];
    $genre = $_POST['genre'];

    // Prepare the SQL query to insert the data into the tracks table
    $query = "INSERT INTO tracks (title, artist, album, genre, release_year) 
              VALUES (:album_name, :artist_name, :album_name, :genre, :release_year)";
    
    $stmt = $pdo->prepare($query);
    
    // Bind the values to the query
    $stmt->bindParam(':album_name', $album_name);
    $stmt->bindParam(':artist_name', $artist_name);
    $stmt->bindParam(':release_year', $release_year);
    $stmt->bindParam(':genre', $genre);

    // Execute the query and check if the insert was successful
    if ($stmt->execute()) {
        echo "<p>Album successfully added!</p>";
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
    <title>New Album</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Add a New Album</h1>
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
    <h2>Enter New Album Details</h2>

    <!-- Form to add a new album -->
    <form action="new_album.php" method="POST">
        <label for="album_name">Album Name:</label>
        <input type="text" id="album_name" name="album_name" required><br><br>

        <label for="artist_name">Artist Name:</label>
        <input type="text" id="artist_name" name="artist_name" required><br><br>

        <label for="release_year">Release Year:</label>
        <input type="number" id="release_year" name="release_year" min="1900" max="2099" required><br><br>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required><br><br>

        <button type="submit">Add Album</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Music Collection</p>
</footer>

</body>
</html>

