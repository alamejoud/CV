var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

var trailers = document.getElementsByClassName("trailer");
var t = document.getElementById("t");

for (var i = 0; i < trailers.length; i++) {
    trailers[i].addEventListener("click", playTrailer);
}

function playTrailer() {
    var yt_id;
    for (var i = 0; i < data.Movies.length; i++) {
        if (
            data.Movies[i].name ==
            this.parentElement.parentElement
                .querySelector("p")
                .querySelector("a").innerText
        ) {
            yt_id = data.Movies[i].youtube_id;
        }
    }
    t.setAttribute(
        "src",
        "https://www.youtube.com/embed/" + yt_id + "?autoplay=1&mute=1"
    );
}

window.addEventListener("load", function () {
    for (var i = 0; i < trailers.length; i++) {
        trailers[i].addEventListener("click", function () {
            modal.style.display = "block";
        });
    }
});

span.onclick = function () {
    modal.style.display = "none";
    t.setAttribute("src", "");
};

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
        t.setAttribute("src", "");
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
