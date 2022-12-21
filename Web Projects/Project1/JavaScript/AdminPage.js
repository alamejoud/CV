class InputHandler {
    constructor(option) {
        this.option = option;
    }

    handleInput() {
        switch (this.option) {
            case "Movies":
                this.movies();
                break;

            case "Series":
                this.series();
                break;

            case "Celebrities":
                this.celebrities();

            default:
                break;
        }
        Banner.classList.remove("hidden");
    }

    AjaxHandler() {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
            }
        };
        xhr.open("GET", "../PHP/adminpage.php?mode=" + this.option, true);
        xhr.send();
    }

    clear() {
        const check =
            document.querySelector(".info table") ||
            document.querySelector(".info h3");
        check ? check.remove() : null;

        const img = document.querySelector(".Banner");
        img.style = `background-image: none;`;
        document.getElementById("bannerLabel").innerHTML = '<i class="fa-solid fa-plus"></i> Upload Banner';
    }

    movies() {
        this.clear();

        const CellNames = ["Name", "Rating", "Genre", "Trailer", "Description"];
        this.createTable(CellNames);
    }

    series() {
        this.clear();

        const CellNames = [
            "Name",
            "Rating",
            "Genre",
            "Trailer",
            "Description",
        ];
        this.createTable(CellNames);
    }

    celebrities() {
        this.clear();

        const CellNames = ["Name", "Age"];
        this.createTable(CellNames);
    }

    createTable(array) {
        const main = document.querySelector(".info");
        const table = document.createElement("table");

        for (let i = 0; i < array.length + 1; i++) {
            if (i === array.length) {
                const row = document.createElement("tr");
                const cell = document.createElement("td");
                cell.setAttribute("colspan", "2");
                const button = document.createElement("button");
                button.innerHTML = `<i class="fa-solid fa-plus"></i> Add`;
                button.setAttribute("type", "submit");

                // add a hidden input to the form
                const hidden = document.createElement("input");
                hidden.type = "hidden";
                hidden.name = "mode";
                hidden.value = this.option;
                hidden.required = true;
                document.querySelector("form").appendChild(hidden);

                cell.appendChild(button);
                row.appendChild(cell);
                table.appendChild(row);
            } else {
                const row = document.createElement("tr");
                const cellOne = document.createElement("td");
                const cellTwo = document.createElement("td");
                const cellThree = document.createElement("input");
                

                cellOne.innerHTML = array[i];
                if (array[i] === "Age" || array[i] === "Rating") {
                    cellThree.type = "number";
                } else {
                    cellThree.type = "text";
                }
                cellThree.name = array[i];
                cellThree.required = true;
                cellTwo.appendChild(cellThree);

                row.appendChild(cellOne);
                row.appendChild(cellTwo);
                table.appendChild(row);
            }
        }
        main.appendChild(table);
    }
}

const Banner = document.querySelector(".Banner");
window.addEventListener("load", () => {
    Banner.classList.add("hidden");

    const Welcome = document.createElement("h3");
    Welcome.innerHTML =
        "Welcome to the Admin Page<br><br>Please select what you wish to add";
    Welcome.style.cssText = `
    text-align: left;
    margin-top: 20px;
    animation: fadeIn 1s ease-in-out;
    -moz-animation: fadeIn 1s ease-in-out;
    -webkit-animation: fadeIn 1s ease-in-out;
    -o-animation: fadeIn 1s ease-in-out; 
    -ms-animation: fadeIn 1s ease-in-out;`;

    document.querySelector(".info").appendChild(Welcome);
});

const labels = document.getElementsByTagName("li");
const options = [...labels].splice(1, labels.length);

options.forEach((elem) => {
    elem.addEventListener("click", () => {
        new InputHandler(elem.innerText.replace(/ /g, "")).handleInput();
    });
});

document.querySelector("#banner").addEventListener("change", function () {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
        const uploaded_image = reader.result;
        document.querySelector(
            ".Banner"
        ).style = `background-image: url(${uploaded_image}); z-index: 2;`;
        document.getElementById("bannerLabel").innerHTML = "";
    });
    reader.readAsDataURL(this.files[0]);
});
