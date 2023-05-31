<?php
require_once 'auth.php';
$userid = checkAuth();
if (!$userid) {
    exit;
}
// Include the database configuration
require_once 'dbconfig.php';

// Establish the database connection
$conn = new mysqli($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

// Perform the query to retrieve booked classes
$sql = 
"SELECT data_prenotazione, ora_prenotazione, COUNT(*) AS prenotazioni
FROM prenotazioni
WHERE data_prenotazione >= CURDATE()
GROUP BY data_prenotazione, ora_prenotazione
-- HAVING COUNT(*) > 2;
";
//another sql query with data ora and id_utente where data >= CURDATE() and id_utente = $userid
$sql2 =
"SELECT data_prenotazione, ora_prenotazione, id_utente
FROM prenotazioni
WHERE data_prenotazione >= CURDATE() AND id_utente = $userid
";
// Execute the queryes
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

// Check if the query was successful
if ($result && $result2) {
    $bookedClasses = array();
    
    // Fetch the results and add them to the bookedClasses array
    while ($row = $result->fetch_assoc()) {
        $bookedClasses[] = $row;
    }
    while ($row2 = $result2->fetch_assoc()) {
        $bookedBy[] = $row2;
    }
    //if a class on bookedClasses is equal to a class on bookedBy, then add a boolean field to the bookedClasses array
    foreach ($bookedClasses as $key => $value) {
        foreach ($bookedBy as $key2 => $value2) {
            if ($value['data_prenotazione'] == $value2['data_prenotazione'] && $value['ora_prenotazione'] == $value2['ora_prenotazione']) {
                $bookedClasses[$key]['bookedByMe'] = true;
            }
        }
    }
    
    // Send the JSON response
    header('Content-Type: application/json');
    echo json_encode($bookedClasses);
} else {
    // Error occurred in the query
    $error = $conn->error;
    
    // Prepare the error response
    $response = array(
        'error' => $error
    );
    
    // Send the JSON response with the error
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
