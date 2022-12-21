<?php
require '../../vendor/autoload.php';
$client = new MongoDB\Client;

$db = $client->WebProject;
$celebs = $db->Celebrities;
session_id("VUE-USER-LOGGEDIN");
session_start();

$user = " ";

if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    session_destroy();
} else if (isset($_SESSION["Username"])) {
    $user = $_SESSION["Username"];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Top Celebs</title>
    <meta charset="uft-8" />
    <link rel="shortcut icon" href="../Images/Log.png" type="image/x-icon" />
    <link rel="stylesheet" href="../CSS/TopCelebs.css" />
    <script src="../JS/font.js"></script>
</head>

<body>
    <nav>
        <ul>
            <li>
                <div class="logo">
                    <img src="../Images/Logo.png" alt="" />
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
                    echo '<button class="navigation firstNav" id="logout">' . $user . '</button>';
                }
                ?>
            </li>
        </ul>
    </nav>
    <div class="body">
        <h1>Top Celebs</h1>
        <p>All your favorite celebrities from around the world.</p>

        <div class="celebs">
            <?php
            $c = 0;
            foreach ($celebs->find([]) as $a) {
                $c++;
            }
            ;
            for ($i = 0; $i < $c; $i++) {
                $ce = $celebs->findOne(['id' => $i]);
                echo '<div class="celeb">
                                    <div class="celebImg">
                                        <img src="../Celebs/' . $ce['img'] . '" alt="" />
                                    </div>
                                    <div class="celebInfo">
                                        <p>' . $ce['name'] . '</p>
                                        <p class="age">' . $ce['age'] . '</p>
                                    </div>
                            </div>';

            }
            ?>
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
</body>

<script src="../JavaScript/TopCelebs.js"></script>

</html>