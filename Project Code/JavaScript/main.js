var left = document.getElementsByClassName("left")[0];
var right = document.getElementsByClassName("right")[0];
var slide = document.getElementsByClassName("slide");
var index = 0;
var n = 0;
var interval;
var m = 0;
var limit = false;
var active = false;
let slideIndex = 0;
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];
var logout;

window.addEventListener("load", start);

function start() {
    right.addEventListener("click", function () {
        if (!active) {
            active = true;
            changeInfo1();
            moveRight();
        }
    });

    left.addEventListener("click", function () {
        if (!active) {
            active = true;
            changeInfo2();
            moveLeft();
        }
    });

    showSlides();
}

function moveLeft() {
    if (index != 0) {
        interval = setInterval(moveLeftPart, 10);
    } else if (index == 0) {
        interval = setInterval(limitLeft, 15);
    }
}

function moveLeftPart() {
    for (var i = 0; i < 4; i++) {
        slide[i].setAttribute(
            "style",
            "margin-left: " + (-25 * index + n) + "%;"
        );
    }
    n += 0.5;
    if (n > 25) {
        n = 0;
        index--;
        active = false;
        clearInterval(interval);
    }
}

function limitLeft() {
    slide[0].setAttribute("style", "margin-left: " + m + "%;");

    if (!limit) {
        m += 0.5;
    }

    if (limit || m >= 5) {
        limit = true;
        m -= 0.5;
    }

    if (limit && m < 0) {
        m = 0;
        limit = false;
        active = false;
        clearInterval(interval);
    }
}

function moveRight() {
    if (index != 3) {
        interval = setInterval(moveRightPart, 10);
    } else if (index == 3) {
        interval = setInterval(limitRight, 5);
    }
}

function moveRightPart() {
    for (var i = 0; i < 4; i++) {
        slide[i].setAttribute(
            "style",
            "margin-left: " + (-25 * index - n) + "%;"
        );
    }
    n += 0.5;
    if (n > 25.2) {
        n = 0;
        index++;
        active = false;
        clearInterval(interval);
    }
}

function limitRight() {
    slide[3].setAttribute("style", "margin-left: " + (-75 - m) + "%;");

    if (!limit) {
        m += 0.5;
    }

    if (limit || m >= 20) {
        limit = true;
        m -= 0.5;
    }

    if (limit && m < 0) {
        m = 0;
        limit = false;
        active = false;
        clearInterval(interval);
    }
}

function changeInfo1() {
    let summary = document.getElementsByClassName("information1");
    let summary1 = document.getElementsByClassName("information2");
    let img = document.getElementsByClassName("information4");
    let title = document.getElementsByClassName("information3");
    for (i = 0; i < title.length; i++) {
        summary[i].style.display = "none";
        summary1[i].style.display = "none";
        img[i].style.display = "none";
        title[i].style.display = "none";
    }
    if (index != 3) {
        summary[index + 1].style.display = "block";
        summary1[index + 1].style.display = "block";
        img[index + 1].style.display = "block";
        title[index + 1].style.display = "flex";
    } else {
        summary[index].style.display = "block";
        summary1[index].style.display = "block";
        img[index].style.display = "block";
        title[index].style.display = "flex";
    }
}

function changeInfo2() {
    let summary = document.getElementsByClassName("information1");
    let summary1 = document.getElementsByClassName("information2");
    let img = document.getElementsByClassName("information4");
    let title = document.getElementsByClassName("information3");
    for (i = 0; i < title.length; i++) {
        summary[i].style.display = "none";
        summary1[i].style.display = "none";
        img[i].style.display = "none";
        title[i].style.display = "none";
    }
    if (index != 0) {
        summary[index - 1].style.display = "block";
        summary1[index - 1].style.display = "block";
        img[index - 1].style.display = "block";
        title[index - 1].style.display = "flex";
    } else {
        summary[index].style.display = "block";
        summary1[index].style.display = "block";
        img[index].style.display = "block";
        title[index].style.display = "flex";
    }
}

function showSlides() {
    let i;
    let slides1 = document.getElementsByClassName("mySlides1");
    let slides2 = document.getElementsByClassName("mySlides2");
    for (i = 0; i < slides1.length; i++) {
        slides1[i].style.display = "none";
        slides2[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides1.length) {
        slideIndex = 1;
    }
    slides1[slideIndex - 1].style.display = "inline-block";
    slides2[slideIndex - 1].style.display = "inline-block";
    setTimeout(showSlides, 4000);
}

var modal1 = document.getElementById("myModal1");
var span1 = document.getElementsByClassName("close")[1];

function l() {
    modal1.style.display = "block";
}

logout = document.getElementById("logout");
if (logout != null) {
    logout.addEventListener("click", function () {
        l();
    });
}

span1.onclick = function () {
    modal1.style.display = "none";
    t.setAttribute("src", "");
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
        t.setAttribute("src", "");
    } else if (event.target == modal1) {
        modal1.style.display = "none";
    }
};

var trailers = document.getElementsByClassName("trailer");
var t = document.getElementById("t");

for (var i = 0; i < trailers.length / 2; i++) {
    trailers[i].addEventListener("click", function () {
        playTrailer(this, "movies");
    });
}

for (var i = trailers.length / 2; i < trailers.length; i++) {
    trailers[i].addEventListener("click", function () {
        playTrailer(this, "series");
    });
}

function playTrailer(t, type) {
    getYtId(
        t.parentElement.parentElement.querySelector("p").querySelector("a")
            .innerText,
        type
    );
}
var asyncRequest;

function getYtId(name, type) {
    try {
        asyncRequest = new XMLHttpRequest();
        asyncRequest.addEventListener(
            "readystatechange",
            processResponse,
            false
        );
        asyncRequest.open(
            "GET",
            "../HTML/" + type + "_yt_id.php?name=" + name,
            true
        );
        asyncRequest.send(null);
    } catch (exception) {
        alert("Request Failed");
    }
}

function processResponse() {
    if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
        var yt_id = asyncRequest.responseText;
        t.setAttribute(
            "src",
            "https://www.youtube.com/embed/" + yt_id + "?autoplay=1&mute=1"
        );
        modal.style.display = "block";
    }
}

span.onclick = function () {
    modal.style.display = "none";
    t.setAttribute("src", "");
};

var celebs = document.getElementsByClassName("celebs")[0];

console.log(celebs);

var imgs = celebs.querySelectorAll("img");

for (var i = 0; i < imgs.length; i++) {
    imgs[i].addEventListener("click", function () {
        var n = this.parentNode.parentNode
            .querySelectorAll("div")[1]
            .querySelector("p")
            .innerHTML.split(" ");
        var link = "https://en.wikipedia.org/wiki/";

        for (var i = 0; i < n.length; i++) {
            link += n[i];
            if (i != n.length - 1) {
                link += "_";
            }
        }
        if (n[0] == "Chris" && n[1] == "Evans") {
            link += "_(actor)";
        }
        t.setAttribute("src", link);
        modal.style.display = "block";
    });
}

var wButton = document.getElementsByClassName("watchlist");

var asyncRequest1;

function addWatchlist(name) {
    try {
        asyncRequest1 = new XMLHttpRequest();
        asyncRequest1.addEventListener(
            "readystatechange",
            processResponse1,
            false
        );
        asyncRequest1.open(
            "GET",
            "../HTML/addWatchlist.php?name=" + name,
            true
        );
        asyncRequest1.send(null);
    } catch (exception) {
        alert("Request Failed");
    }
}

function processResponse1() {
    if (asyncRequest1.readyState == 4 && asyncRequest1.status == 200) {
        var r = asyncRequest1.responseText;
    }
}

for (var i = 0; i < wButton.length; i++) {
    wButton[i].addEventListener("click", function () {
        if (this.className == "watchlist checked") {
            this.querySelector("span")
                .querySelector("svg")
                .setAttribute("class", "svg-inline--fa fa-plus");
            this.className = "watchlist unchecked";
        } else {
            this.querySelector("span")
                .querySelector("svg")
                .setAttribute("class", "svg-inline--fa fa-check");
            this.className = "watchlist checked";
        }
        var name = this.parentNode.parentNode
            .querySelector("p")
            .querySelector("a").innerHTML;
        addWatchlist(name);
    });
}
