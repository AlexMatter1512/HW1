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

// Check if the booking belongs to the user
$checkQuery = "SELECT * FROM prenotazioni WHERE id_utente = '$userid' AND data_prenotazione = '$date' AND ora_prenotazione = '$hour'";
$checkResult = $conn->query($checkQuery);

if ($checkResult && $checkResult->num_rows > 0) {
    // The booking belongs to the user, perform the cancellation
    $cancelQuery = "DELETE FROM prenotazioni WHERE id_utente = '$userid' AND data_prenotazione = '$date' AND ora_prenotazione = '$hour'";
    $cancelResult = $conn->query($cancelQuery);

    if ($cancelResult) {
        // Cancellation successful
        $response = array(
            'success' => true
        );
    } else {
        // Error occurred while canceling the booking
        $error = $conn->error;

        // Prepare the error response
        $response = array(
            'success' => false,
            'error' => 'Errore durante l\'annullamento della prenotazione: ' . $error
        );
    }
} else {
    // The booking does not belong to the user or doesn't exist
    $response = array(
        'success' => false,
        'error' => 'La prenotazione non appartiene all\'utente corrente o non esiste.'
    );
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
