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

function facebookChat() {
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v10.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
}

externalLinks();
fadeIn();
facebookChat();
