<?php
namespace adminpage;

require_once "./imp.php";
use imp\typeOf_input;
use imp\KKJ_Database;

$hidden = $_POST['mode'];
$data;

switch ($hidden) {
    case "Movies":
        $client = new KKJ_Database("WebProject", $hidden, "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");
        $result = $client->findMany([]);
        $c = 0;
        foreach ($result as $key => $value) {
            $c++;
        }
        $data = array(
            "id" => $c,
            "name" => $_POST['Name'],
            "rating" => $_POST['Rating'],
            "description" => $_POST['Description'],
            "youtube_id" => $_POST['Trailer'],
            "img_banner" => $_POST['img_banner'],
            "genre" => $_POST['Genre'],
        );
        break;

    case "Series":
        $client = new KKJ_Database("WebProject", $hidden, "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");
        $result = $client->findMany([]);
        $c = 0;
        foreach ($result as $key => $value) {
            $c++;
        }
        $data = array(
            "id" => $c,
            "name" => $_POST['Name'],
            "rating" => $_POST['Rating'],
            "description" => $_POST['Description'],
            "youtube_id" => $_POST['Trailer'],
            "img_banner" => $_POST['img_banner'],
            "genre" => $_POST['Genre'],
        );
        break;

    case "Celebrities":
        $client = new KKJ_Database("WebProject", $hidden, "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");
        $result = $client->findMany([]);
        $c = 0;
        foreach ($result as $key => $value) {
            $c++;
        }
        $data = array(
            "id" => $c,
            "name" => $_POST['Name'],
            "age" => $_POST['Age'],
            "img" => $_POST['img_banner'],
        );
        break;
}

$client = new KKJ_Database("WebProject", $hidden, "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");

$client->insertOne($data);
header("Location: ../HTML/adminpage.html");
?>