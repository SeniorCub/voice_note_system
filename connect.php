<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Leave this empty if you have not set a password
    $dbname = "voice_note_system";
    $port = 3307; // Add the new port number

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $messages_table_creation_query = mysqli_query($conn,"CREATE TABLE IF NOT EXISTS voice_notes (
     id INT AUTO_INCREMENT PRIMARY KEY,
     file_name VARCHAR(255) NOT NULL,
     file_path VARCHAR(255) NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );");
?>