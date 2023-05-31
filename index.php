<?php 
    require_once 'auth.php';
    $userid = checkAuth()
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="index.css" />
    <link rel="icon" type="image/x-icon" href="assets/favicon.png">
    <script src="index.js" defer="true"></script>
    <title>Crossgym Augusta</title>
  </head>
  <body>
    
    <header id="mainHeader">
      <div id="panino" onclick="togglemenu()">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <h2 class="mainHeaderItem" onclick="chi_siamo.scrollIntoView(smoothscroll)">Chi siamo</h2>
      <h2 class="mainHeaderItem" onclick="i_nostri_corsi.scrollIntoView(smoothscroll)">I nostri corsi</h2>
      <img id="logo" src="pics/logo_bad.jpg" alt="">
      <h2 class="mainHeaderItem" onclick="dove_siamo.scrollIntoView(smoothscroll)">Dove siamo</h2>
      <h2 class="mainHeaderItem" onclick="contatti.scrollIntoView(smoothscroll)">Contatti</h2>
    </header>
    <div id="mobileMenu">
      <h2 class="mobileMenuItem" onclick="scrollAndHide('chi_siamo')">Chi siamo</h2>
      <h2 class="mobileMenuItem" onclick="scrollAndHide('i_nostri_corsi')">I nostri corsi</h2>
      <h2 class="mobileMenuItem" onclick="scrollAndHide('dove_siamo')">Dove siamo</h2>
      <h2 class="mobileMenuItem" onclick="scrollAndHide('contatti')">Contatti</h2>
    </div>
    <div class="login_signup">
        <div id="BB">
          <img id="him" src="assets/bb.png" alt="">
          click me!
        </div>
      <?php
        if(!$userid){
          echo "<a class='mainHeaderItem2' href='signup.php'>ISCRIVITI</a>";
          echo "<a class='mainHeaderItem2' href='login.php'>ACCEDI</a>";
        }
        else{
          echo "<a class='mainHeaderItem2' href='profile.php'>PROFILO</a>";
          echo "<a class='mainHeaderItem2' href='prenotazioni.php'>PRENOTA UNA CLASSE</a>";
          echo "<a class='mainHeaderItem2' href='logout.php'>LOGOUT</a>";
        }
      ?>
    </div>

    <form id="exerciseForm">
      <h3>Exercise Finder</h3>
      <label for="exerciseName">Name:</label>
      <input type="text" id="exerciseName" name="exerciseName" placeholder="Exercise Name (optional)">
      <br>
      <!-- <label for="exerciseType">Type:</label>
      <select id="exerciseType" name="exerciseType">
        <option value="">Any</option>
        <option value="cardio">Cardio</option>
        <option value="olympic_weightlifting">Olympic Weightlifting</option>
        <option value="plyometrics">Plyometrics</option>
        <option value="powerlifting">Powerlifting</option>
        <option value="strength">Strength</option>
        <option value="stretching">Stretching</option>
        <option value="strongman">Strongman</option>
      </select>
      <br> -->
      <label for="muscleGroup">Muscle:</label>
      <select id="muscleGroup" name="muscleGroup">
        <option value="">Any</option>
        <option value="abdominals">Abdominals</option>
        <option value="abductors">Abductors</option>
        <option value="adductors">Adductors</option>
        <option value="biceps">Biceps</option>
        <option value="calves">Calves</option>
        <option value="chest">Chest</option>
        <option value="forearms">Forearms</option>
        <option value="glutes">Glutes</option>
        <option value="hamstrings">Hamstrings</option>
        <option value="lats">Lats</option>
        <option value="lower_back">Lower Back</option>
        <option value="middle_back">Middle Back</option>
        <option value="neck">Neck</option>
        <option value="quadriceps">Quadriceps</option>
        <option value="traps">Traps</option>
        <option value="triceps">Triceps</option>
      </select>
      <br>
      <!-- <label for="difficulty">Difficulty:</label>
      <select id="difficulty" name="difficulty">
        <option value="">Any</option>
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="expert">Expert</option>
      </select>
      <br> -->
      <input id="btn" type="submit" value="Search">
    </form>

    <div id="exerciseContainer"></div>
    <article id="chi_siamo">
      <h1>Chi siamo</h1>
      <p>
        "Lorem ipsum dolor sit amet, 
        consectetur adipiscing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, 
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
        Duis aute irure dolor in reprehenderit in voluptate velit 
        esse cillum dolore eu fugiat nulla pariatur."
      </p>
      <!-- Slideshow container -->
      <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
          <img class="slideImage" src="pics/img1.jpg" style="width: 100%" />
          <div class="text">La nostra community</div>
        </div>

        <div class="mySlides fade">
          <img class="slideImage" src="pics/img2.jpg" style="width: 100%" />
          <div class="text">La nostra community</div>
        </div>

        <div class="mySlides fade">
          <img class="slideImage" src="pics/img3.jpg" style="width: 100%" />
          <div class="text">La nostra community</div>
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
      <br />

      <!-- The dots/circles -->
      <div style="text-align: center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </article>
    <article id="i_nostri_corsi">
      <h1>I nostri corsi</h1>
      <div id="elenco_corsi">
        <p>
          <strong>CrossFit:</strong><br>
          Tutte le classi durano un'ora. <br>
          <ul>
            <li>
              <strong>Giorni dispari</strong><br>
              <ul>
                <li><strong>Mattina</strong><br>
                  9:00 - 14:00
                </li>
                <li><strong>Sera</strong><br>
                  15:00 - 21:00
                </li>
              </ul>
            </li>
            <li>
              <strong>Giorni pari</strong><br>
              <ul>
                <li><strong>Mattina</strong><br>
                  12:00 - 14:00
                </li>
                <li><strong>Sera</strong><br>
                  17:00 - 21:00
                </li>
              </ul>
            </li>
          </ul>
        </p>
        <p>
          <strong>Pilates:</strong><br>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Adipisci, eos nesciunt, corrupti veritatis facere architecto 
          dolore debitis non praesentium cum, consectetur aspernatur a est.
        </p>
        <p>
          <strong>Open:</strong><br>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </p>
      </div>
    </article>
    <article id="dove_siamo">
      <h1>Dove Siamo</h1>
      <p>
        La nostra palestra si trova <strong>proprio all'ingresso della citta' di Augusta (SR):</strong><br>
      </p>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6577.072797253041!2d15.203681815708599!3d37.25482012887775!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1313c367ff5cf517%3A0xaeb559a6465cb22e!2sNuovo%20Circolo%20Tennis%20Augusta!5e1!3m2!1sit!2sit!4v1683212923926!5m2!1sit!2sit" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </article>
    <article id="contatti">
      <h1>Contatti</h1>
        <div id="social">
          <div class="social" id="instagram">
            <img class="social" src="pics/instagram.png" alt="instagram logo">
            <a href="https://www.instagram.com/crossgym_augusta/?hl=it">crossgym augusta</a>
          </div>
          <div class="social" id="facebook">
            <img class="social" src="pics/facebook.png" alt="facebook logo">
            <a href="https://www.facebook.com/crossgymaugusta/?locale=it_IT">crossgym augusta</a>
          </div>
        </div>
    </article>

    <footer>
      <p>made with❤️ by <a id="Alex" href="https://www.instagram.com/_alexmatter/?hl=it">Alex</a>, a member of this wonderful community</p>
    </footer>
  </body>
</html>
