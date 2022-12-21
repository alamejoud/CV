<?php
require '../../vendor/autoload.php';
$client = new MongoDB\Client;

$db = $client->WebProject;
$series = $db->Series;

$name = $_GET['name'];
$s = $series->findOne(["name" => $name]);
echo $s["youtube_id"];
?>