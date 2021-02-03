// This abstract function is for read more and read less

function readAbstract(rsid) {
  var dots = document.getElementById("dots_"+rsid);
  var moreText = document.getElementById("readMore_"+rsid);
  var btnText = document.getElementById("readBtn_"+rsid);

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