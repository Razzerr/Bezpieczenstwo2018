function myFunction() {
    var x = document.getElementById("mm");
    if (x.className === "main_menu") {
        x.className += " responsive";
    } else {
        x.className = "main_menu";
    }
}