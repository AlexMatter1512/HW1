var exerciseName;
var exerciseElement;
//add event listener to the elements with heart class with function removeLike
document.querySelectorAll(".heart").forEach(item => {
    item.addEventListener("click", removeLike);
    });

//add event listener to the elements with exercise class with function showExercise
document.querySelectorAll(".exercise").forEach(item => {
    item.addEventListener("click", showExercise);
    });



function addLike(event) {
    var exerciseName = event.currentTarget.dataset.exercise;
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
      event.currentTarget.src = "assets/remove.png";
      //remove the event listener from the heart
      event.currentTarget.removeEventListener("click", addLike);
      //add event listener to the heart with function removeLike
      event.currentTarget.addEventListener("click", removeLike);
  }

function removeLike(event) {
    var exerciseName = event.currentTarget.dataset.exercise;
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
      event.currentTarget.src = "assets/heart.png";
      //remove the event listener from the heart
      event.currentTarget.removeEventListener("click", removeLike);
      //add event listener to the heart with function removeLike
      event.currentTarget.addEventListener("click", addLike);
  }

function showExercise(event) {
    exerciseName = event.currentTarget.dataset.exercise;
    exerciseElement = event.currentTarget.parentElement;
    fetch("exercises.php?exercise=" + exerciseName)
    .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        console.log(data); // Display the response from the PHP file
        // exerciseContainer is the div with class exerciseContainer and dataset.exercise equal to event.currentTarget.dataset.exercise
        //var exerciseContainer = document.querySelector(".exerciseContainer[data-exercise='" + exerciseName + "']");
        //console.log(exerciseContainer);
        var exerciseTemplate = "";
  
      // Loop through the exercises array and generate the HTML template for each exercise
      //for (var i = 0; i < Math.min(data.length, 3); i++) {
        var exercise = data[0];
          exerciseTemplate += "<div class='exerciseElement'><p>Type: " + exercise.type + "</p>";
          exerciseTemplate += "<p>Muscle: " + exercise.muscle + "</p>";
          exerciseTemplate += "<p>Equipment: " + exercise.equipment + "</p>";
          exerciseTemplate += "<p>Difficulty: " + exercise.difficulty + "</p>";
          exerciseTemplate += "<p>Instructions: " + exercise.instructions + "</p></div>";
      //  };
        console.log(exerciseTemplate);
  
        // add the generated exercise template as the content of the exerciseContainer div
        exerciseElement.innerHTML += exerciseTemplate;
        document.querySelectorAll(".heart").forEach(item => {
            item.addEventListener("click", removeLike);
            });
      })
      .catch(function (error) {
        console.error("Error in request:", error);
      });
  };    