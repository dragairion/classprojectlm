<?php
include('config.php'); // Include the database connection file

// Query to fetch all songs from the tracks table
$query = "SELECT * FROM tracks";
$stmt = $pdo->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Songs</title>
   
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>All Songs</h1>
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
    <h2>Song List</h2>
    <div class="track-container">
        <?php
        // Check if there are any songs in the database
        if ($stmt->rowCount() > 0) {
            // Loop through each row and display the song details
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='track'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p><strong>Artist:</strong> " . htmlspecialchars($row['artist']) . "</p>";
                echo "<p><strong>Album:</strong> " . htmlspecialchars($row['album']) . "</p>";
                echo "<p class='genre'><strong>Genre:</strong> " . htmlspecialchars($row['genre']) . "</p>";
                echo "<p class='release-year'><strong>Release Year:</strong> " . htmlspecialchars($row['release_year']) . "</p>";
                // Add the delete button with a link to delete.php
                echo "<a href='delete.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No songs found.</p>";
        }
        ?>
    </div>
</div>

<footer>
    <p>&copy; 2024 Music Collection</p>
</footer>

</body>
</html>
