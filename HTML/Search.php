<?php
require '../../vendor/autoload.php';
require_once "../PHP/imp.php";
$client = new MongoDB\Client;

$db = $client->WebProject;
$movies = $db->Movies;
$series = $db->Series;
$celebs = $db->Celebrities;
$users = $db->Users;

session_id("VUE-USER-LOGGEDIN");
session_start();

$user = " ";

if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    session_destroy();
} else if (isset($_SESSION["Username"])) {
    $user = $_SESSION["Username"];
    $u = $users->findOne(['Username' => $user]);
}

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Search Results</title>

    <link rel="shortcut icon" href="../Images/Log.png" type="image/x-icon" />
    <link rel="stylesheet" href="../CSS/search.css" />
</head>

<body>
    <nav>
        <ul>
            <li>
                <div class="logo">
                    <img src="../Images/NewLogo.png" alt="" />
                </div>
            </li>
            <li>
                <a href="index.php"><button class="navigation">Home</button></a>
            </li>
            <li class="form">
                <form method="post" action="" autocomplete="on">
                    <div class="input-wrapper">
                        <input class="search" type="text" name="search" placeholder="Type..." size="80" />
                        <input class="search_button" type="submit" name="submit" value="Search" />
                    </div>
                </form>
            </li>
            <li>
                <a href="watchlist.php">
                    <button class="navigation">Watchlist</button>
                </a>
            </li>
            <li>
                <?php
                if ($user == " ") {
                    echo '<a href="Login.html"
                        ><button class="navigation">Login</button></a
                        >';
                } else {
                    echo '<button class="navigation firstNav" id="logout">' . $u["Username"] . '</button>';
                }
                ?>
            </li>
        </ul>
    </nav>
    <div class="body">
        <h1>Movies</h1>

        <section class="main movies">
            <?php
            $counter = 0;
            $results = $movies->find([]);
            $pattern = "/^" . $_POST['search'] . "/i";

            foreach ($results as $key => $value) {
                $temp = explode(" ", $value['name']);
                for ($i = 0; $i < count($temp); $i++) {
                    if (preg_match($pattern, $temp[$i]) && $_POST['search'] != "" && $_POST['search'] != " ") {
                        $counter++;
                        echo '<div class="banner">
                                <a href="../HTML/IndividualMovies.php?mid=' . strval($value['id']) . '"
                                    ><img
                                        src="../Movies Banner/' . $value['img_banner'] . '"
                                        alt=""
                                /></a>
                                <div class="info">
                                    <span class="rating">
                                        <span><i class="fa-solid fa-star"></i></span
                                        >' . $value['rating'] . '
                                    </span>
                                    <p>
                                        <a href="../HTML/IndividualMovies.php?mid=' . strval($value['id']) . '">' . $value['name'] . '</a>
                                    </p>
                                    <div class="button-section">
                                ';
                            if ($user != " ") {
                                if ($u['Movies'][$value['id']]) {
                                    echo '<button class="watchlist checked">
                                    <span
                                        ><i class="fa-solid fa-check"></i
                                    ></span>
                                    Watchlist
                                </button>';
                                } else {
                                    echo '<button class="watchlist unchecked">
                                    <span
                                        ><i class="fa-solid fa-plus"></i
                                    ></span>
                                    Watchlist
                                </button>';
                                }
                            } else {
                                echo '<a href="Login.html">
                                    <button class="watchlist unchecked">
                                            <span
                                                ><i class="fa-solid fa-plus"></i
                                            ></span>
                                            Watchlist
                                        </button></a>';
                            }
                            echo '
                                </div>
                                    <div class="button-section">
                                        <button class="trailer">
                                            <span>
                                                <i class="fa-solid fa-play"></i>
                                            </span>
                                            Trailer
                                        </button>
                                    </div>
                                </div>
                            </div>';
                        break;
                    }
                }
            }
            if ($counter == 0) {
                echo '<p>No Movies Found</p>';
            }
            ?>
        </section>
        <h1>Series</h1>

        <section class="main">
            <?php
            $counter = 0;
            $results = $series->find([]);
            $pattern = "/^" . $_POST['search'] . "/i";

            foreach ($results as $key => $value) {
                $temp = explode(" ", $value['name']);
                for ($i = 0; $i < count($temp); $i++) {
                    if (preg_match($pattern, $temp[$i]) && $_POST['search'] != "" && $_POST['search'] != " ") {
                        $counter++;
                        echo '<div class="banner">
                                <a href="IndividualSeries.php?sid=' . strval($value['id']) . '"
                                    ><img
                                        src="../Series Banner/' . $value['img_banner'] . '"
                                        alt=""
                                /></a>
                                <div class="info">
                                    <span class="rating">
                                        <span><i class="fa-solid fa-star"></i></span
                                        >' . $value['rating'] . '
                                    </span>
                                    <p>
                                        <a href="IndividualSeries.php?sid=' . strval($value['id']) . '">' . $value['name'] . '</a>
                                    </p>
                                    <div class="button-section">
                                ';
                            if ($user != " ") {
                                if ($u['Series'][$value['id']]) {
                                    echo '<button class="watchlist checked">
                                    <span
                                        ><i class="fa-solid fa-check"></i
                                    ></span>
                                    Watchlist
                                </button>';
                                } else {
                                    echo '<button class="watchlist unchecked">
                                    <span
                                        ><i class="fa-solid fa-plus"></i
                                    ></span>
                                    Watchlist
                                </button>';
                                }
                            } else {
                                echo '<a href="Login.html">
                                    <button class="watchlist unchecked">
                                            <span
                                                ><i class="fa-solid fa-plus"></i
                                            ></span>
                                            Watchlist
                                        </button></a>';
                            }
                            echo '
                                </div>
                                    <div class="button-section">
                                        <button class="trailer">
                                            <span>
                                                <i class="fa-solid fa-play"></i>
                                            </span>
                                            Trailer
                                        </button>
                                    </div>
                                </div>
                            </div>';
                        break;
                    }
                }
            }
            if ($counter == 0) {
                echo '<p>No Series Found</p>';
            }
            ?>
        </section>
        <h1>Celebs</h1>
        <div class="celebs">
            <?php
            $counter = 0;
            $results = $celebs->find([]);
            $pattern = "/^" . $_POST['search'] . "/i";

            foreach ($results as $key => $value) {
                $temp = explode(" ", $value['name']);
                for ($i = 0; $i < count($temp); $i++) {
                    if (preg_match($pattern, $temp[$i]) && $_POST['search'] != "" && $_POST['search'] != " ") {
                        $counter++;
                        echo '<div class="celeb">
                                        <div class="celebImg">
                                            <img src="../Celebs/' . $value['img'] . '" alt="" />
                                        </div>
                                        <div class="celebInfo">
                                            <p>' . $value['name'] . '</p>
                                            <p class="age">' . $value['age'] . '</p>
                                        </div>
                                </div>';
                        break;
                    }
                }
            }
            if ($counter == 0) {
                echo '<p>No Celebs Found</p>';
            }
            ?>
        </div>
    </div>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>

            <iframe id="t"> </iframe>
        </div>
    </div>
    <div id="myModal1" class="modal">
        <div class="modal-content" style="background-color: gray;">
            <span class="close">&times;</span>
            <h1 style="text-align: center;">Are you sure you want to logout?</h1>

            <a href="index.php?logout=true"><button class="navigation">Log Out</button></a>

        </div>
    </div>
    <footer>
        <ul>
            <h2>CONTACT US</h2>
            <p>
                +96176728472 <br />+96176395034 <br />+96171235623
                <br />+96103102932
            </p>
        </ul>
    </footer>
    <script src="../JavaScript/font.js"></script>
    <script src="../JavaScript/search.js"></script>
</body>

</html>