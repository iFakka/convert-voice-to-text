<?php
// Database configuration
$dbHost = 'localhost';
$dbUser = 'ifakka';
$dbPass = '012345@#AbCdEh';
$dbName = 'test';

// Connect to MySQL server
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the transcribed text from the POST request
if (isset($_POST['transcription'])) {
    $transcription = $_POST['transcription'];

    // Prepare the SQL statement to insert the text into the database
    $sql = "INSERT INTO transcriptions (text) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $transcription); // 's' indicates a string data type

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Voice-to-text conversion successful and text stored in the database.";
    } else {
        echo "Error storing text in the database: " . $conn->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "No transcription data received.";
}

// Close the database connection
$conn->close();
?>
