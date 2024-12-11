<?php
include('config.php');
$id = $_GET['id'];

$query = "SELECT * FROM albums WHERE id = $id";
$result = mysqli_query($conn, $query);
$album = mysqli_fetch_assoc($result);

$query_songs = "SELECT * FROM songs WHERE album_id = $id";
$songs_result = mysqli_query($conn, $query_songs);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $album['album_title']; ?> Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1><?php echo $album['album_title']; ?></h1>
    <p>Artist: <?php echo $album['artist']; ?></p>
    <p>Genre: <?php echo $album['genre']; ?></p>
    <p>Release Date: <?php echo $album['release_date']; ?></p>
    <p>Notable Fact: <?php echo $album['notable_fact']; ?></p>

    <h2>Songs</h2>
    <table>
        <thead>
            <tr>
                <th>Song Title</th>
                <th>Writer</th>
                <th>Length</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($song = mysqli_fetch_assoc($songs_result)) { ?>
                <tr>
                    <td><a href="song_details.php?id=<?php echo $song['id']; ?>"><?php echo $song['song_title']; ?></a></td>
                    <td><?php echo $song['writer']; ?></td>
                    <td><?php echo $song['length']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
