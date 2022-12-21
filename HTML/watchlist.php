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
    <title>My Watchlist</title>

    <link rel="shortcut icon" href="../Images/Log.png" type="image/x-icon" />
    <link rel="stylesheet" href="../CSS/watchlist.css" />
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
                <form method="post" action="search.php">
                    <div class="input-wrapper">
                        <input class="search" type="text" name="search" placeholder="Type..." size="80"
                            autocomplete="off" />
                        <input class="search_button" type="submit" name="submit" value="Search" />
                    </div>
                </form>
            </li>
            <li>
                <button class="navigation firstNav">Watchlist</button>
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
        <h1>My Movies</h1>
        <section class="main movies">
            <?php
            $e0 = true;
            $c = 0;
            foreach ($movies->find([]) as $a) {
                $c++;
            }
            ;
            for ($i = 0; $i < $c; $i++) {
                $m = $movies->findOne(['id' => $i]);
                if ($u["Movies"][$i]) {
                    $e0 = false;
                    echo '
                    <div class="banner">
                        <a href="../HTML/IndividualMovies.php?mid=' . strval($m['id']) . '"
                            ><img
                                src="../Movies Banner/' . $m['img_banner'] . '"
                                alt=""
                        /></a>
                        <div class="info">
                            <span class="rating">
                                <span><i class="fa-solid fa-star"></i></span
                                >' . $m['rating'] . '
                            </span>
                            <p>
                                <a href="../HTML/IndividualMovies.php?mid=' . strval($m['id']) . '">' . $m['name'] . '</a>
                            </p>
                            <div class="button-section">
                                ';
                    if ($user != " ") {
                        if ($u['Movies'][$i]) {
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
                    </div>
                    ';
                }
            }?>
        </section>
        <?php 
        if ($e0) {
            echo '<div class="empty">
                        <p>There are no movies for you to watch</p>
                        <a href="TopMovies.php"><button>Go to Movies</button></a>
                    </div>';
        }?>
        <h1>My Series</h1>
        <section class="main series">
            <?php
            $e1 = true;
            $c = 0;
            foreach ($series->find([]) as $a) {
                $c++;
            }
            ;
            for ($i = 0; $i < $c; $i++) {
                $s = $series->findOne(['id' => $i]);
                if ($u["Series"][$i]) {
                    $e1 = false;
                    echo '
                <div class="banner">
                    <a href="IndividualSeries.php?sid=' . strval($s['id']) . '"
                        ><img
                            src="../Series Banner/' . $s['img_banner'] . '"
                            alt=""
                    /></a>
                    <div class="info">
                        <span class="rating">
                            <span><i class="fa-solid fa-star"></i></span>
                            ' . $s['rating'] . '
                        </span>
                        <p>
                            <a href="IndividualSeries.php?sid=' . strval($s['id']) . '">' . $s['name'] . '</a>
                        </p>
                        <div class="button-section">
                            ';
                    if ($user != " ") {
                        if ($u['Series'][$i]) {
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
                </div>
                ';
                }
            }?>
        </section>
        <?php 
        if ($e1) {
            echo '<div class="empty">
                <p>There are no series for you to watch</p>
                <a href="TopSeries.php"><button>Go to Series</button></a>
            </div>';
        }?>
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
    <script src="../JavaScript/WatchlistPage.js"></script>
</body>

</html>