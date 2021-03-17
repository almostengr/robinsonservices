var opacity = 0;
var intervalID = 0;
// window.onload = fadeIn;

function fadeIn() {
    setInterval(show, 50);
}

function show() {
    var body = document.getElementById("services");
    opacity = Number(window.getComputedStyle(body).getPropertyValue("opacity"));
    if (opacity < 1) {
        opacity = opacity + 0.1;
        body.style.opacity = opacity
    } else {
        clearInterval(intervalID);
    }
}

function externalLinks() {
    var anchors = document.getElementsByTagName('a');
    for (var i = 0; i < anchors.length; i++) {
        if (anchors[i].getAttribute("href").startsWith("http")) {
            anchors[i].target = "_blank";
        }
    }
}
externalLinks();
fadeIn();