<?php
// Include the database connection
include 'connect.php';

// Fetch all saved voice notes from the database
$sql = "SELECT * FROM voice_notes ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Voice Notes</title>
</head>
<body>
    <h1>Saved Voice Notes</h1>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while ($voiceNote = mysqli_fetch_assoc($result)): ?>
                <li>
                    <p>File Name: <?php echo htmlspecialchars($voiceNote['file_name']); ?></p>
                    <audio controls>
                        <source src="<?php echo htmlspecialchars($voiceNote['file_path']); ?>" type="audio/wav">
                        Your browser does not support the audio element.
                    </audio>
                    <p>Created At: <?php echo htmlspecialchars($voiceNote['created_at']); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No voice notes found.</p>
    <?php endif; ?>
</body>
</html>
