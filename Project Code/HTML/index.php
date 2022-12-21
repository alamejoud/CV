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
    <title>Vue</title>
    <meta charset="uft-8" />
    <link rel="shortcut icon" href="../Images/Log.png" type="image/x-icon" />
    <link rel="stylesheet" href="../CSS/index.css" />
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
                <button class="navigation firstNav">Home</button>
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
                <a href="watchlist.php"><button class="navigation">Watchlist</button></a>
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
        <section class="main">
            <section class="Summary">
                <h1 class="information1 fade">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Mario Movie']);
                    echo $m1['name']; ?>
                </h1>
                <h1 class="information1 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Black Adam']);
                    echo $m1['name']; ?>
                </h1>
                <h1 class="information1 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Black Panther: Wakanda Forever']);
                    echo $m1['name']; ?>
                </h1>
                <h1 class="information1 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Black Panther: Wakanda Forever']);
                    echo $m1['name']; ?>
                </h1>
                <hr color="#a7a7a7" />
                <p class="information2 fade">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Mario Movie']);
                    echo $m1['description']; ?>
                </p>
                <p class="information2 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Black Adam']);
                    echo $m1['description']; ?>
                </p>
                <p class="information2 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Black Panther: Wakanda Forever']);
                    echo $m1['description']; ?>
                </p>
                <p class="information2 fade" style="display: none">
                    <?php
                    $m1 = $movies->findOne(['name' => 'Luckiest Girl Alive']);
                    echo $m1['description']; ?>
                </p>
            </section>
            <section class="Picture">
                <div class="slides">
                    <div class="slide">
                        <img class="image" src="../Movies/Super_Mario_Movie.jpg" alt="" />
                    </div>
                    <div class="slide">
                        <img class="image" src="../Movies/Black_Adam.jpg" alt="" />
                    </div>
                    <div class="slide">
                        <img class="image" src="../Movies/Black_Panther.jpg" alt="" />
                    </div>
                    <div class="slide">
                        <img class="image" src="../Movies/Luckiest_Girl_Alive.webp" alt="" />
                    </div>
                </div>
                <button class="left">
                    <i class="fa-solid fa-arrow-left fa-2xl"></i>
                </button>
                <button class="right">
                    <i class="fa-solid fa-arrow-right fa-2xl"></i>
                </button>
                <div class="banner-watchlist information4 fade">
                    <a href="IndividualMovies.php?mid=30">
                        <?php
                        echo '<img
                                class="banner"
                                src="../Movies Banner/' . $movies->findOne(['name' => 'Mario Movie'])['img_banner'] . '"
                                alt=""
                            />';
                        ?>
                    </a>
                </div>

                <div class="banner-watchlist information4 fade" style="display: none">
                    <a href="IndividualMovies.php?mid=9">
                        <?php
                        echo '<img
                                class="banner"
                                src="../Movies Banner/' . $movies->findOne(['name' => 'Black Adam'])['img_banner'] . '"
                                alt=""
                            />';
                        ?>
                    </a>
                </div>

                <div class="banner-watchlist information4 fade" style="display: none">
                    <a href="IndividualMovies.php?mid=10">
                        <?php
                        echo '<img
                                class="banner"
                                src="../Movies Banner/' . $movies->findOne(['name' => 'Black Panther: Wakanda Forever'])['img_banner'] . '"
                                alt=""
                            />';
                        ?>
                    </a>
                </div>

                <div class="banner-watchlist information4 fade" style="display: none">
                    <a href="IndividualMovies.php?mid=29">
                        <?php
                        echo '<img
                                class="banner"
                                src="../Movies Banner/' . $movies->findOne(['name' => 'Luckiest Girl Alive'])['img_banner'] . '"
                                alt=""
                            />';
                        ?>
                    </a>
                </div>
                <div>
                    <a href="IndividualMovies.php?mid=30">
                        <div class="title information3 fade">
                            <div>
                                <i class="fa-duotone fa-circle-play fa-2xl"></i>
                            </div>
                            <h1>The Super Mario Bros Movie</h1>
                        </div>
                    </a>
                    <a href="IndividualMovies.php?mid=9">
                        <div class="title information3 fade" style="display: none">
                            <div>
                                <i class="fa-duotone fa-circle-play fa-2xl"></i>
                            </div>
                            <h1>Black Adam</h1>
                        </div>
                    </a>
                    <a href="IndividualMovies.php?mid=10">
                        <div class="title information3 fade" style="display: none">
                            <div>
                                <i class="fa-duotone fa-circle-play fa-2xl"></i>
                            </div>
                            <h1>Black Panther: Wakanda Forever</h1>
                        </div>
                    </a>
                    <a href="IndividualMovies.php?mid=29">
                        <div class="title information3 fade" style="display: none">
                            <div>
                                <i class="fa-duotone fa-circle-play fa-2xl"></i>
                            </div>
                            <h1>Luckiest Girl Alive</h1>
                        </div>
                    </a>
                </div>
            </section>
        </section>
        <section class="New-Things-To-Watch">
            <h1 class="title">New Things to Watch</h1>
            <div class="content">
                <div class="iContent mySlides1 fade">
                    <figure>
                        <a href="IndividualMovies.php?mid=21">
                            <img src="../Movies/The_Gray_Man.jpg" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=21">The Gray Man</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="iContent mySlides2 fade">
                    <figure>
                        <a href="IndividualMovies.php?mid=24">
                            <img src="../Movies/Dobaaraa.jpg" alt="" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=24">Dobaaraa</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="iContent mySlides1 fade" style="display: none">
                    <figure>
                        <a href="IndividualMovies.php?mid=26">
                            <img src="../Movies/Superpets.jpg" alt="" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=26">Superpets</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="iContent mySlides2 fade" style="display: none">
                    <figure>
                        <a href="IndividualMovies.php?mid=25">
                            <img src="../Movies/Gold.jpg" alt="" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=25">Gold</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="iContent mySlides1 fade" style="display: none">
                    <figure>
                        <a href="IndividualMovies.php?mid=22">
                            <img src="../Movies/The_355.jpg" alt="" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=22">The 355</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="iContent mySlides2 fade" style="display: none">
                    <figure>
                        <a href="IndividualMovies.php?mid=23">
                            <img src="../Movies/Lou.jpg" alt="" />
                        </a>
                        <figcaption>
                            <a href="IndividualMovies.php?mid=23">Lou</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>
        <section class="Top Movies">
            <h1 class="title">
                <a href="TopMovies.php">
                    Top Movies
                    <span><i class="fa-duotone fa-chevrons-right"></i></span>
                </a>
            </h1>
            <div class="banners">
                <?php
                for ($i = 0; $i < 7; $i++) {
                    $m = $movies->findOne(['id' => $i]);
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
                } ?>
            </div>
        </section>
        <section class="Top Series">
            <h1 class="title">
                <a href="TopSeries.php">
                    Top Series
                    <span><i class="fa-duotone fa-chevrons-right"></i></span>
                </a>
            </h1>
            <div class="banners">
                <?php
                for ($i = 0; $i < 7; $i++) {
                    $s = $series->findOne(['id' => $i]);
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
                } ?>
            </div>
        </section>
        <section class="Top Celebs">
            <h1 class="title">
                <a href="TopCelebs.php">
                    Top Celebs
                    <span><i class="fa-duotone fa-chevrons-right"></i></span>
                </a>
            </h1>
            <div class="celebs">
                <?php
                for ($i = 0; $i < 5; $i++) {
                    $c = $celebs->findOne(['id' => $i]);
                    echo '<div class="celeb">
                                    <div class="celebImg">
                                        <img src="../Celebs/' . $c['img'] . '" alt="" />
                                    </div>
                                    <div class="celebInfo">
                                        <p>' . $c['name'] . '</p>
                                        <p class="age">' . $c['age'] . '</p>
                                    </div>
                            </div>';

                }
                ?>
            </div>
        </section>
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
</body>
<script src="../JavaScript/main.js"></script>
<script src="../JavaScript/font.js"></script>

</html>