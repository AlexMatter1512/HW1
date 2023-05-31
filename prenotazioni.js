// Get all the list items
var listItems = document.querySelectorAll(".list li");

checkBookingStatus();

// Add event listeners to each list item
listItems.forEach(function (listItem) {
  if (!listItem.classList.contains("booked")) {
    listItem.addEventListener("click", book);
  }
});

function book() {
  var date = this.dataset.date;
  var hour = this.dataset.hour;
  // Make the booking request
  bookClass(date, hour);
  //delay the checkBookingStatus function to wait for the booking to be completed
  setTimeout(checkBookingStatus, 1000);
}

console.log(listItems);

// Function to make the booking request
function bookClass(date, hour) {
  // Create a new FormData object
  console.log(date);
  console.log(hour);
  var formData = new FormData();

  // Add the date and hour to the FormData
  formData.append("date", date);
  formData.append("hour", hour);

  // Make the fetch request to the PHP file
  fetch("book_class.php", {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      // Display the confirmation message
      if (data.success) {
        var confirmationMessage =
          "Prenotazione effettuata con successo!\nID Prenotazione: " +
          data.id_prenotazione;
        console.log(confirmationMessage);
        document.getElementById("confirmation-message").textContent =
          confirmationMessage;
        confirmationContainer.style.display = "block";
      } else {
        var errorMessage = "Errore durante la prenotazione: " + data.error;
        console.log(errorMessage);
        document.getElementById("confirmation-message").textContent =
          errorMessage;
      }
    })
    .catch(function (error) {
      console.error("Errore nella richiesta:", error);
    });
}
// Function to check the booking status
function checkBookingStatus() {
  console.log("checkBookingStatus");
  var listItems = document.querySelectorAll(".list li");
  // Make the fetch get request to the PHP file to check the booking status
  fetch("check_booking.php")
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      // for item in data add class booked to the corrispoding list item
      data.forEach(function (item) {
        //console.log(item);

        var date = item.data_prenotazione;
        var hour = item.ora_prenotazione;
        //console.log(date);
        //console.log(hour);
        //console.log('[data-date="' + date + '"][data-hour="' + hour + '"]');
        var listItem = document.querySelector(
          '[data-date="' + date + '"][data-hour="' + hour + '"]'
        );
        //console.log(listItem);
        //if item has bookedByMe = true add class bookedByMe to the corrispoding list item and change the event listener to cancel
        if (item.bookedByMe) {
          listItem.classList.add("bookedByMe");
          console.log("add class bookedByMe");
          listItem.removeEventListener("click", book);
          listItem.addEventListener("click", cancel);
        }
        //if item has prenotazioni > 19 remove class available and remove the event listener from the booked list item
        if (item.prenotazioni > 19) {
          //listItem.classList.remove('available');
          listItem.classList.add("booked");
          listItem.removeEventListener("click", book);
        }
        //add number of bookings to the innerHTML of the booked list item from item.prenotazioni
        listItem.innerHTML =
          hour.split(":")[1] +
          ":" +
          hour.split(":")[2] +
          ' <span class="bookings">prenotazioni: ' +
          item.prenotazioni +
          "</span>";
      });
      // for each list item withou class bookedByMe remove event listener cancel and add event listener book
      listItems.forEach(function (listItem) {
        if (!listItem.classList.contains("bookedByMe")) {
          listItem.removeEventListener("click", cancel);
          listItem.addEventListener("click", book);
        }
      });
    })
    .catch(function (error) {
      console.error("Error in request:", error);
    });
}
function cancel(event) {
  //remove the class bookedByMe from the currenttarget
  event.currentTarget.classList.remove("bookedByMe");
  var date = this.dataset.date;
  var hour = this.dataset.hour;
  cancelClass(date, hour);
}
function cancelClass(date, hour) {
  console.log(date);
  console.log(hour);
  var formData = new FormData();
  formData.append("date", date);
  formData.append("hour", hour);

  fetch("cancel_class.php", {
    method: "POST",
    body: formData,
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (data) {
      if (data.success) {
        var confirmationMessage = "Prenotazione annullata con successo!";
        console.log(confirmationMessage);
        document.getElementById("confirmation-message").textContent = confirmationMessage;

          var listItem = document.querySelector(
            '[data-date="' + date + '"][data-hour="' + hour + '"]'
          );
          var bookingsSpan = listItem.querySelector(".bookings");
          // check if the number of bookings inside the span element is equal to 1
          if (bookingsSpan.textContent === "prenotazioni: 1") {
            // Remove the span element with the number of bookings
            listItem.removeChild(bookingsSpan);
          }
      } else {
        var errorMessage =
          "Errore durante l'annullamento della prenotazione: " + data.error;
        console.log(errorMessage);
        document.getElementById("confirmation-message").textContent = errorMessage;
      }
      setTimeout(checkBookingStatus, 1000);
    })
    .catch(function (error) {
      console.error("Errore nella richiesta:", error);
    });
}

