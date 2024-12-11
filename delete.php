<?php
include('config.php'); // Include the database connection file

// Check if 'id' is set in the URL query string
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the track ID from the URL

    // Prepare the DELETE query to remove the track from the database
    $query = "DELETE FROM tracks WHERE id = :id";
    $stmt = $pdo->prepare($query);

    // Bind the ID parameter and execute the query
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        // Redirect back to the all_albums.php page after successful deletion
        header("Location: all_albums.php");
        exit;
    } else {
        echo "Error deleting the track.";
    }
} else {
    echo "No track ID specified.";
}
?>
