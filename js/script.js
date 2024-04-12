

function decrementRooms() {
    const roomsInput = document.getElementById("rooms");
    let currentRooms = parseInt(roomsInput.value);

    if (currentRooms > 0) {
        currentRooms--;
        roomsInput.value = currentRooms;
    }
}

function incrementRooms() {
    const roomsInput = document.getElementById("rooms");
    let currentRooms = parseInt(roomsInput.value);
    currentRooms++;
    roomsInput.value = currentRooms;
}

function decrementAdults() {
    const adultInput = document.getElementById("adults");
    let currentAdults = parseInt(adultInput.value);

    if (currentAdults > 0) {
        currentAdults--;
        adultInput.value = currentAdults;
    }
}

function incrementAdults() {
    const adultInput = document.getElementById("adults");
    let currentAdults = parseInt(adultInput.value);
    currentAdults++;
    adultInput.value = currentAdults;
}

function decrementChildren() {
    const childrenInput = document.getElementById("children");
    let currentChildren = parseInt(childrenInput.value);

    if (currentChildren > 0) {
        currentChildren--;
        childrenInput.value = currentChildren;
    }
}

function incrementChildren() {
    const childrenInput = document.getElementById("children");
    let currentChildren = parseInt(childrenInput.value);
    currentChildren++;
    childrenInput.value = currentChildren;
}

// Function to display current date
function displayDate() {
    const today = new Date();
    const formattedDate = today.toLocaleDateString("en-US", {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    document.getElementById("current-date").textContent = formattedDate;
}

// Function to fetch and display weather data (replace with your actual API call)
function displayWeather() {
    // Replace with your weather API call and logic to extract and display relevant information
    const apiKey = "YOUR_WEATHER_API_KEY"; // Replace with your actual API key
    const location = "YOUR_LOCATION"; // Replace with your desired location

    fetch(`https://api.openweathermap.org/data/2.5/weather?q=${location}&appid=${apiKey}`)
        .then(response => response.json())
        .then(data => {
            const weatherDescription = data.weather[0].main;
            document.getElementById("current-weather").textContent = weatherDescription;
        })
        .catch(error => console.error(error));
}

// Call functions on page load
window.onload = function () {
    displayDate();
    displayWeather();
};

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("logo").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("logo").style.display = "none";
        document.getElementById("adr").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("adr").style.display = "none";
        document.getElementById("phn").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("phn").style.display = "none";
        document.getElementById("phn").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("phn").style.display = "none";
        // document.getElementById("book").style.transition = "opacity 0.5s ease-in-out";
        // document.getElementById("book").style.display = "none";
        
    } else {
        document.getElementById("logo").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("logo").style.display = "block";
        document.getElementById("adr").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("adr").style.display = "block";
        document.getElementById("phn").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("phn").style.display = "block";
        document.getElementById("book").style.transition = "opacity 0.5s ease-in-out";
        document.getElementById("book").style.display = "block";
    }
}
    // Get the current date
    var currentDate = new Date();
    
    // Format the date as "Month Year"
    var options = { year: 'numeric', month: 'long' };
    // var formattedDate = currentDate.toLocaleDateString('en-US', options);
    
    //just to show year only 
     var formattedDate = currentDate.toLocaleDateString('en-US', { year: 'numeric' });
    
    // Update the current date in the footer
    document.getElementById('current-date').textContent = formattedDate;
