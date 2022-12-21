<?php
require '../../vendor/autoload.php';
require_once "../PHP/imp.php";
$client = new MongoDB\Client;

$db = $client->WebProject;
$movies = $db->Movies;
$series = $db->Series;
$users = $db->Users;

session_id("VUE-USER-LOGGEDIN");
session_start();

$user = " ";

if (isset($_GET["logout"]) && $_GET["logout"] == "true") {
    session_destroy();
} else if (isset($_SESSION["Username"])) {
    $user = $_SESSION["Username"];
}

$u = $users->findOne(["Username" => $user]);

$name = $_GET['name'];
$s = $series->findOne(["name" => $name]);
$m = $movies->findOne(["name" => $name]);
if ($s != null) {
    $seriesArray = $u["Series"];
    $seriesArray[(int) $s["id"]] = !$seriesArray[(int) $s["id"]];
    $users->updateOne(["Username" => $user], ['$set' => ["Series" => $seriesArray], '$currentDate' => ["lastModified" => true]]);
    echo $s["id"];
} else if ($m != null) {
    $moviesArray = $u["Movies"];
    $moviesArray[(int) $m["id"]] = !$moviesArray[(int) $m["id"]];
    $users->updateOne(["Username" => $user], ['$set' => ["Movies" => $moviesArray], '$currentDate' => ["lastModified" => true]]);
    echo $m["id"];
}
?>