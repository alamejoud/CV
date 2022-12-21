<?php
require '../../vendor/autoload.php';
require_once "../PHP/imp.php";

$client = new MongoDB\Client;

session_start();

$db = $client->WebProject;
$series = $db->Series;
$users = $db->Users;
$s = $series->findOne(['id' => (int) $_GET['sid']]);

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
    <title id="title">Vue/
        <?php echo $s['name'] ?>
    </title>

    <link rel="shortcut icon" href="../Images/Log.png" type="image/x-icon" />
    <link rel="stylesheet" href="../CSS/individualSerie.css" />
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

    <div class="grid">
        <div class="two">
            <iframe width="100%" height="100%"
                src="https://www.youtube.com/embed/<?php echo $s['youtube_id'] ?>?autoplay=1&mute=1"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen id="movie_trailer"></iframe>
        </div>

        <div class="one">
            <div class="upper_section">
                <img width="200px" id="movie_banner" src="../Series Banner/<?php echo $s['img_banner'] ?>" />
                <div>
                    <h4 id="movie_title"><?php echo $s['name'] ?></h4>
                    <hr />
                    <div id="movie_details">
                        <p>
                            <?php echo "Rating: " . $s['rating'] ?>
                        </p>
                        <p>
                            <?php echo "Genre: " . $s['genre'] ?>
                        </p>
                    </div>
                </div>
                <?php

                if ($user != " ") {
                    if ($u['Series'][$s['id']]) {
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
                } ?>
            </div>

            <div class="lower_section">
                <hr />
                <p id="movie_description">
                    <?php echo $s['description'] ?>
                </p>
            </div>
        </div>
    </div>
    <div id="myModal1" class="modal">
        <div class="modal-content" style="background-color: gray;">
            <span class="close">&times;</span>
            <h1 style="text-align: center;">Are you sure you want to logout?</h1>

            <a href="index.php?logout=true"><button class="navigation">Log Out</button></a>

        </div>
    </div>
</body>
<script src="../JavaScript/IndividualSerie.js"></script>
<script src="../JavaScript/font.js"></script>

</html>