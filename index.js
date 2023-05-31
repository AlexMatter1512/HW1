
exerciseForm.addEventListener("submit", function (event) {
  event.preventDefault();
  console.log(exerciseName.value);
  console.log(muscleGroup.value);
  fetch("exercises.php?exercise=" + exerciseName.value + "&muscle=" + muscleGroup.value)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data); // Display the response from the PHP file
      var exerciseContainer = document.getElementById("exerciseContainer");
      var exerciseTemplate = "";

    // Loop through the exercises array and generate the HTML template for each exercise
    //for (var i = 0; i < Math.min(data.length, 3); i++) {
      var exercise = data[Math.floor(Math.random() * data.length)];
        exerciseTemplate += "<h3>" + exercise.name + "</h3>";
        exerciseTemplate += "<img id='heart' src='assets/heart.png' alt='like'>";
        exerciseTemplate += "<p>Type: " + exercise.type + "</p>";
        exerciseTemplate += "<p>Muscle: " + exercise.muscle + "</p>";
        exerciseTemplate += "<p>Equipment: " + exercise.equipment + "</p>";
        exerciseTemplate += "<p>Difficulty: " + exercise.difficulty + "</p>";
        exerciseTemplate += "<p>Instructions: " + exercise.instructions + "</p>";
    //  };
      exerciseForm.style.display = "flex";

// Set the generated exercise template as the content of the exerciseContainer div
      exerciseContainer.innerHTML = exerciseTemplate;
      //add event listener to heart with function addLike
      document.getElementById("heart").addEventListener("click", addLike);
    })
});
document.getElementById("him").addEventListener("click", function () {
  var muscleGroups = [
    "abdominals",
    "abductors",
    "adductors",
    "biceps",
    "calves",
    "chest",
    "forearms",
    "glutes",
    "hamstrings",
    "lats",
    "lower_back",
    "middle_back",
    "neck",
    "quadriceps",
    "traps",
    "triceps"
  ];
  
  // Pick a random muscle group
  var muscle = muscleGroups[Math.floor(Math.random() * muscleGroups.length)];  
  // Make the GET request to the PHP file
  console.log("muscle: " + muscle);
  fetch("exercises.php?muscle=" + muscle)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data); // Display the response from the PHP file
      var exerciseContainer = document.getElementById("exerciseContainer");
      var exerciseTemplate = "";

    // Loop through the exercises array and generate the HTML template for each exercise
    //for (var i = 0; i < Math.min(data.length, 3); i++) {
      var exercise = data[0];
        exerciseTemplate += "<h3>" + exercise.name + "</h3>";
        exerciseTemplate += "<img id='heart' src='assets/heart.png' alt='like'>";
        exerciseTemplate += "<p>Type: " + exercise.type + "</p>";
        exerciseTemplate += "<p>Muscle: " + exercise.muscle + "</p>";
        exerciseTemplate += "<p>Equipment: " + exercise.equipment + "</p>";
        exerciseTemplate += "<p>Difficulty: " + exercise.difficulty + "</p>";
        exerciseTemplate += "<p>Instructions: " + exercise.instructions + "</p>";
    //  };
      exerciseForm.style.display = "flex";

// Set the generated exercise template as the content of the exerciseContainer div
      exerciseContainer.innerHTML = exerciseTemplate;
      //add event listener to heart with function addLike
      document.getElementById("heart").addEventListener("click", addLike);

    })
    .catch(function (error) {
      console.error("Error in request:", error);
    });
});

let smoothscroll = {
  behavieour: "smooth",
  block: "center"
}

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

function togglemenu() {
  if (mobileMenu.style.display == "none") {
    mobileMenu.style.display = "block"
  } else {
    mobileMenu.style.display = "none"
  }
}

function scrollAndHide(id){
  let element = document.getElementById(id);
  element.scrollIntoView(smoothscroll);
  togglemenu();
}

//addlike function takes the name of the exercise from the html element and sends it to the php file
function addLike() {
  var exerciseName = document.getElementById("exerciseContainer").firstChild.textContent;
  console.log(exerciseName);
  fetch("add_like.php?exerciseName=" + exerciseName)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data); // Display the response from the PHP file
    })
    .catch(function (error) {
      console.error("Error in request:", error);
    });
    //change the heart image to a cross
    document.getElementById("heart").src = "assets/remove.png";
    //remove the event listener from the heart
    document.getElementById("heart").removeEventListener("click", addLike);
    //add event listener to the heart with function removeLike
    document.getElementById("heart").addEventListener("click", removeLike);
}

//removelike function takes the name of the exercise from the html element and sends it to the php file
function removeLike() {
  var exerciseName = document.getElementById("exerciseContainer").firstChild.textContent;
  console.log(exerciseName);
  fetch("remove_like.php?exerciseName=" + exerciseName)
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      console.log(data); // Display the response from the PHP file
    })
    .catch(function (error) {
      console.error("Error in request:", error);
    });
    //change the heart image to a cross
    document.getElementById("heart").src = "assets/heart.png";
    //remove the event listener from the heart
    document.getElementById("heart").removeEventListener("click", removeLike);
    //add event listener to the heart with function removeLike
    document.getElementById("heart").addEventListener("click", addLike);
}
