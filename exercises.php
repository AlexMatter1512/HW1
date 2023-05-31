<?php
$token = "EJyJjggBnerT2aP8Bcjnbg==5EN3ft0PEG1LJOXL";
if (isset($_GET['muscle']) && empty($_GET['exercise'])) {
    $muscle = $_GET['muscle'];
    $url = "https://api.api-ninjas.com/v1/exercises?muscle=" . urlencode($muscle);

    $options = array(
        'http' => array(
            'header' => "X-Api-Key: $token\r\n",
            'method' => 'GET'
        )
    );
    $context = stream_context_create($options);
    
    $result = file_get_contents($url, false, $context);
    
    if ($result === false) {
        echo "Error making API request";
    } else {
        echo $result;
    }
} else if (isset($_GET['exercise']) && empty($_GET['muscle'])) {
    $exercise = $_GET['exercise'];
    $url = "https://api.api-ninjas.com/v1/exercises?name=" . urlencode($exercise);

    $options = array(
        'http' => array(
            'header' => "X-Api-Key: $token\r\n",
            'method' => 'GET'
        )
    );
    $context = stream_context_create($options);
    
    $result = file_get_contents($url, false, $context);
    
    if ($result === false) {
        echo "Error making API request";
    } else {
        echo $result;
    }
} else if (isset($_GET['exercise']) && isset($_GET['muscle'])) {
    $exercise = $_GET['exercise'];
    $muscle = $_GET['muscle'];
    $url = "https://api.api-ninjas.com/v1/exercises?name=" . urlencode($exercise) . "&muscle=" . urlencode($muscle);

    $options = array(
        'http' => array(
            'header' => "X-Api-Key: $token\r\n",
            'method' => 'GET'
        )
    );
    $context = stream_context_create($options);
    
    $result = file_get_contents($url, false, $context);
    
    if ($result === false) {
        echo "Error making API request";
    } else {
        echo $result;
    }
} else {
    echo "Error: no parameters provided";
}


?>
