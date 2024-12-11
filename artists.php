<?php
include('config.php'); // Include the database connection file

// Query to fetch unique artists from the tracks table
$query = "SELECT DISTINCT artist FROM tracks";
$stmt = $pdo->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artists</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Artists</h1>
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
    <h2>Artist List</h2>
    <div class="artist-container">
        <?php
        // Check if there are any artists in the database
        if ($stmt->rowCount() > 0) {
            // Loop through each artist and display their name
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='artist'>";
                echo "<h3>" . htmlspecialchars($row['artist']) . "</h3>";
                echo "</div>";
            }
        } else {
            echo "<p>No artists found.</p>";
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Music Collection</p>
</footer>

</body>
</html>
