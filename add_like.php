<?php
require_once 'auth.php';

$userid = checkAuth();
if (!$userid) {
    echo json_encode("error");
    exit;
}

require_once 'dbconfig.php';

// Check if the exercise name is provided
if (isset($_GET['exerciseName'])) {
    // Retrieve the exercise name from the query string
    $exerciseName = $_GET['exerciseName'];

    // Create a new mysqli instance
    $conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    // Check for connection errors
    if ($conn->connect_error) {
        $response = array("success" => false, "message" => "Database connection error: " . $conn->connect_error);
        echo json_encode($response);
        exit;
    }

    // Prepare the SQL statement to insert the exercise preference
    $stmt = $conn->prepare("INSERT INTO likes (user_id, exercise) VALUES (?, ?)");

    // Bind the values for user_id and exercise
    $stmt->bind_param('is', $userid, $exerciseName);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Return a success message
        $response = array("success" => true, "message" => "Exercise preference added successfully");
        echo json_encode($response);
    } else {
        // Return an error message if execution fails
        $response = array("success" => false, "message" => "Error: " . $stmt->error);
        echo json_encode($response);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // Return an error message if the exercise name is not provided
    $response = array("success" => false, "message" => "Exercise name not provided");
    echo json_encode($response);
}
?>
