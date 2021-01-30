//search research studies

//enter function
// Get the input field
var input = document.getElementById("rs-input");

// Execute a function when the user releases a key on the keyboard
input.addEventListener("keyup", function(event) {
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("research-search-button").click();
  }
});

//button function
function researchBtn() {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("research-livesearch").innerHTML = this.responseText;
        }
      };
      var token = document.getElementById("rs-input").value;
      xmlhttp.open("GET", "admin_research_search.php?query=" + token, true);
      xmlhttp.send();
}
//end of search research studies