var dataImage = localStorage.getItem("photo");
var myImg = document.getElementById('photo');

if(dataImage == null)
{
    console.log("Pushing image to local storage");
    myImg.src = `michal.jpg`;
    var imgData = getBase64Image(myImg);
    localStorage.setItem("photo", imgData);
}
else
{
    console.log("Loading image from local storage");
    myImg.src = dataImage;
}

function getBase64Image(img){
    var canvas = document.createElement("canvas");
    canvas.width = img.width;
    canvas.height = img.height;

    var ctx = canvas.getContext("2d");
    ctx.drawImage(img, 0, 0, img.width, img.height);

    var dataURL = canvas.toDataURL("image/jpg")

    return dataURL;
}