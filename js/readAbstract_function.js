// This abstract function is for read more and read less

function readAbstract() {
  var dots = document.getElementById("dots");
  var moreText = document.getElementById("readMore");
  var btnText = document.getElementById("readBtn");

  if (dots.style.display === "none") {
    dots.style.display = "inline";
    btnText.innerHTML = "Read more..."; 
    moreText.style.display = "none";
  } else {
    dots.style.display = "none";
    btnText.innerHTML = "Read less"; 
    moreText.style.display = "inline";
  }
}