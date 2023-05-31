<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <link rel='stylesheet' href='profile.css'>
        <script src='profile.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>Crossgym - <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>
        <header>
            <nav>
                <div class="nav-container">
                    <div id="logo">
                         Crossgym Augusta
                    </div>
                    <div id="links">
                        <a href='index.php'>HOME</a>
                        <div id="separator"></div>
                        <a href='logout.php' class='button'>LOGOUT</a>
                    </div>
                    <div id="menu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div class="userInfo">
                    <div class="avatar" style="background-image: url(<?php echo $userinfo['propic'] == null ? "assets/default_avatar.png" : $userinfo['propic'] ?>)">
                    </div>
                    <h1><?php echo $userinfo['name']." ".$userinfo['surname']; ?></h1>
                    <p>Username: <?php echo $userinfo['username']; ?></p>
                    <p>Email: <?php echo $userinfo['email']; ?></p>
                    <!-- Add additional user information fields as needed -->

                </div>               
            </nav>
        </header>

        <section class="likes">
            <h2>your likes</h2>
            <div class="likes-container">
                <?php

                // Retrieve the user's likes from the database
                $query = "SELECT * FROM likes WHERE user_id = '$userid'";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Display each like information
                        echo "<div class='like'>";
                        
                        echo "<p class='exercise' data-exercise='".$row['exercise']."'> Exercise: " . $row['exercise'] . "</p><br>";
                        // echo of exercise container with the same data-exercise attribute as the exercise paragraph
                        echo "<div class='exercise-container' data-exercise='".$row['exercise']."'></div>";
                        echo "<div><p> Like ID: " . $row['id'] . "</p><img class='heart' data-exercise='".$row['exercise']."' src='assets/remove.png' alt='like'></div><br>";
                        // Display additional like information fields as needed
                        echo "</div>";
                    }
                } else {
                    echo "No likes found.";
                }
                ?>
            </div>
    </section>

    </body>
</html>

<?php mysqli_close($conn); ?>