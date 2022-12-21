const _style = {
    ERROR: `border-bottom: 1px solid red; transition : 0.25s;`,
    SUCCESS: `border-bottom: 1px solid #228B22; transition : 0.25s;`,
    FOCUS_DEFAULT: `border-bottom: 1px solid #c3073f; transition : 0.25s;`,
    CHECK: `color: #228B22; transition : 0.25s;`,
};

const myFunctions = {
    _check: (pass) => {
        return (
            pass.length >= 8 &&
            pass.match(/[A-Z]/g) &&
            pass.match(/[0-9]/g) &&
            !pass.includes(" ", null)
        );
    },

    _reset() {
        if (this == document.getElementById("Password")) {
            document
                .getElementById("requirements")
                .classList.remove("show_req");
        }
        return this.removeAttribute("style");
    },

    _input() {
        const check = document.getElementById("check");
        if (this.value === null || this.value === "") {
            return (
                this.setAttribute("style", _style.FOCUS_DEFAULT),
                check.removeAttribute("style")
            );
        }

        const password = document.getElementById("Password");
        const verify_password = document.getElementById("rePassword");

        switch (this) {
            case password:
                return myFunctions._check(password.value)
                    ? ((password.style = _style.SUCCESS),
                      check.setAttribute("style", _style.CHECK))
                    : ((password.style = _style.ERROR),
                      check.removeAttribute("style"));

            case verify_password:
                return password.value === verify_password.value
                    ? (verify_password.style = _style.SUCCESS)
                    : (verify_password.style = _style.ERROR);

            default:
                return this.setAttribute("style", _style.FOCUS_DEFAULT);
        }
    },

    _focus() {
        const value = this.value;
        const Pass = document.getElementById("Password");
        if (this == Pass) {
            document.getElementById("requirements").classList.add("show_req");
        }

        if (value === null || value === "") {
            this.setAttribute("style", _style.FOCUS_DEFAULT);
        }

        return myFunctions._check(value)
            ? (this.style = _style.SUCCESS)
            : (this.style = _style.ERROR);
    },
};

const elements = document.getElementsByTagName("input");
[...elements].forEach((element) => {
    if (element.type === "password") {
        element.addEventListener("focus", myFunctions._focus);
        element.addEventListener("input", myFunctions._input);
        element.addEventListener("blur", myFunctions._reset);
    }

    if (element.type === "button") {
        element.addEventListener("click", () => {
            if (
                document.getElementById("Password").value ===
                    document.getElementById("rePassword").value &&
                myFunctions._check(document.getElementById("Password").value)
            ) {
                element.setAttribute("type", "submit");
            }
        });
    }
});
