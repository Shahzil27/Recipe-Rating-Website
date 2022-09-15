// registering events for the recipe detail page

document.getElementById("posBtn").addEventListener("click", PositiveButton, false);
document.getElementById("negBtn").addEventListener("click", NegativeButton, false);

var buttons = document.getElementsByClassName("Rate-Button");
buttons[0].addEventListener("click", AjaxRateButton);                 // changed from submit to click and from RateButton to AjaxrateButton


document.getElementById("myRating").addEventListener("input", HandleButtons, false); 