//Assigns html tags to a variable
var x = document.getElementById("login");
var y = document.getElementById("signup");
var z = document.getElementById("btn");

//Changes the position of the forms on-click
function signup() {
    x.style.left = "-985%";
    y.style.left = "15%";
    z.style.left = "50%";
}

function login() {
    x.style.left = "15%";
    y.style.left = "1000%";
    z.style.left = "0%";
}