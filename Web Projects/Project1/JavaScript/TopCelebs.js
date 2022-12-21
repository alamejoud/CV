var celebs = document.getElementsByClassName("celebs")[0];
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

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
