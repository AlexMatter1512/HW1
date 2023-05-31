<?php

require_once 'auth.php';
$userid = checkAuth();
if (!$userid) {
    header("Location: login.php");
    exit;
}
// Include the database configuration
require_once 'dbconfig.php';

// Retrieve the POST data
$date = $_POST['date'];
$hour = $_POST['hour'];

// Establish the database connection
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Perform the booking by inserting into the database
$bookingQuery = "INSERT INTO prenotazioni (id_utente, data_prenotazione, ora_prenotazione) VALUES ('$userid','$date', '$hour')";
$bookingResult = $conn->query($bookingQuery);

if ($bookingResult) {
    // The booking was successful, retrieve the ID of the new booking
    $bookingId = $conn->insert_id;

    // Prepare the success response
    $response = array(
        'success' => true,
        'id_prenotazione' => $bookingId
    );
} else {
    // Error occurred while inserting the booking
    $error = $conn->error;

    // Prepare the error response
    $response = array(
        'success' => false,
        'error' => 'Errore durante la prenotazione: ' . $error
    );
}


// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
