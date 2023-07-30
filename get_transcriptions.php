<?php
// Database configuration
$dbHost = 'localhost'; // Replace with your database host (e.g., 'localhost')
$dbUser = 'ifakka'; // Replace with your database username
$dbPass = '012345@#AbCdEh'; // Replace with your database password
$dbName = 'test'; // Replace with the name of your database (e.g., 'test')
<?php
// Database configuration (same as in process_audio.php)
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

// Fetch all transcriptions from the database
$sql = "SELECT text FROM transcriptions";
$result = $conn->query($sql);

// Prepare an array to hold the fetched transcriptions
$transcriptions = array();

if ($result->num_rows > 0) {
    // Loop through the result and store transcriptions in the array
    while ($row = $result->fetch_assoc()) {
        $transcriptions[] = $row['text'];
    }
}

// Close the database connection
$conn->close();

// Send the transcriptions as JSON
header('Content-Type: application/json');
echo json_encode($transcriptions);
?>
