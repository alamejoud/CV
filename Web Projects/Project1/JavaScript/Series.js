var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

var trailers = document.getElementsByClassName("trailer");
var t = document.getElementById("t");

for (var i = 0; i < trailers.length; i++) {
    trailers[i].addEventListener("click", playTrailer);
}

function playTrailer() {
    getYtId(
        this.parentElement.parentElement.querySelector("p").querySelector("a")
            .innerText
    );
}
var asyncRequest;

function getYtId(name) {
    try {
        asyncRequest = new XMLHttpRequest();
        asyncRequest.addEventListener(
            "readystatechange",
            processResponse,
            false
        );
        asyncRequest.open("GET", "../HTML/series_yt_id.php?name=" + name, true);
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

var modal1 = document.getElementById("myModal1");
var span1 = document.getElementsByClassName("close")[1];

function l() {
    modal1.style.display = "block";
}

logout = document.getElementById("logout");
logout.addEventListener("click", function () {
    l();
});

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
