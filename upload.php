<?php
// Include the database connection
include 'connect.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the 'audio' file is set in the form data
    if (isset($_FILES['audio'])) {
        // Check if the file was uploaded without errors
        if ($_FILES['audio']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['audio']['tmp_name'];
            $fileName = $_FILES['audio']['name'];

            // Generate a unique file name (using timestamp)
            $newFileName = time() . '_' . $fileName;

            $uploadDir = 'uploads/';

            // Ensure the uploads directory exists
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $destinationPath = $uploadDir . basename($newFileName);

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                // Insert file details into the database
                $sql = "INSERT INTO voice_notes (file_name, file_path) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $newFileName, $destinationPath);
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo "File uploaded and saved to database successfully!";
                } else {
                    echo "Failed to save the file in the database.";
                }
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "File upload error code: " . $_FILES['audio']['error'];
        }
    } else {
        echo "No file was uploaded.";
    }
} else {
    echo "Invalid request method. Expecting POST.";
}
?>