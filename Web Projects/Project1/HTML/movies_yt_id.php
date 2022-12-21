<?php
require '../../vendor/autoload.php';
$client = new MongoDB\Client;

$db = $client->WebProject;
$movies = $db->Movies;

$name = $_GET['name'];
$m = $movies->findOne(["name" => $name]);
echo $m["youtube_id"];
?>