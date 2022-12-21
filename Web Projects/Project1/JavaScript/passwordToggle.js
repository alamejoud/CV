"use strict";

const toggle = document.getElementById("toggle");
const password = document.getElementById("password");

const IMG = {
    show: "../Images/show.png",
    hide: "../Images/hide.png",
};

toggle.addEventListener("click", () => {
    password.type = password.type === "password" ? "text" : "password";

    switch (password.type) {
        case "password":
            toggle.setAttribute("style", `background-image: url(${IMG.show})`);
            break;
        case "text":
            toggle.setAttribute("style", `background-image: url(${IMG.hide})`);
            break;
        default:
            break;
    }
});
