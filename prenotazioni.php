<?php
    require_once 'auth.php';
    $userid = checkAuth();
    if (!$userid) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Prenotazione Classe</title>
    <link rel="stylesheet" type="text/css" href="prenotazioni.css">
    <script src="prenotazioni.js" defer></script>
</head>
<body>
    
    <div id='header'>
            <h1>Prenotazione Classe</h1>
            <div id='navigation'>
                <a href="index.php" class='button'>Home</a>
                <div id="separator"></div>
                <a href='logout.php' class='button'>LOGOUT</a>
            </div>
            
    </div>
    <div id="booking-container">
        <h2>Seleziona un orario disponibile:</h2>
        <?php
        $giorniSettimana = array("Lunedì","Martedì","Mercoledì","Giovedì","Venerdì","Sabato","Domenica");
        $start_date = time(); // Data corrente
        $end_date = strtotime('+3 days', $start_date);
        $current_date = $start_date;

        // Genera gli orari disponibili per ogni giorno
        echo "<div id='lists'>"; 
        while ($current_date <= $end_date) {
            $date = date('d-m-Y', $current_date);
            $dateforsql = date('Y-m-d', $current_date);
            $day = (date('N', $current_date) - 1); // Numero del giorno della settimana (0 = lunedì, 6 = domenica)
            
            if ($day < 6) {
                echo "<div class='list'>";
                $odd_day = $day % 2 != 0; // Verifica se il giorno è dispari
                echo "<h3>$giorniSettimana[$day] $date</h3>";
                echo "<ul>";
                for ($hour = 9; $hour <= 20; $hour++) {
                    if ($odd_day && (($hour >= 10 && $hour <= 13) || ($hour >= 15 && $hour <= 21))) {
                        echo "<li class='available' data-date='$dateforsql' data-hour='00:$hour:00'>$hour:00</li>";
                    } elseif (!$odd_day && (($hour >= 12 && $hour <= 14) || ($hour >= 17 && $hour <= 21))) {
                        echo "<li class='available' data-date='$dateforsql' data-hour='00:$hour:00'>$hour:00</li>";
                    }
                }
                echo "</ul>";
                echo "</div>";
            }
            
            $current_date = strtotime('+1 day', $current_date);
        }
        echo "</div>";
        ?>
    </div>
    <div id="confirmationContainer">
        <h2>Conferma Prenotazione</h2>
        <p id="confirmation-message"></p>
    </div>
</body>
</html>
