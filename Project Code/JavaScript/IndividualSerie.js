var modal1 = document.getElementById("myModal1");
var span1 = document.getElementsByClassName("close")[0];

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
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
};

var wButton = document.getElementsByClassName("watchlist")[0];

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

wButton.addEventListener("click", function () {
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
    var name = this.parentNode
        .querySelector("div")
        .querySelector("h4").innerHTML;
    addWatchlist(name);
});
