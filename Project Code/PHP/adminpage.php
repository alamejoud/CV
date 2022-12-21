<?php
namespace adminpage;

require_once "./imp.php";
use imp\typeOf_input;
use imp\KKJ_Database;

$hidden = $_POST['mode'];
$data;

switch ($hidden) {
    case "Movies":
        $data = array(
            "Name" => array($_POST['Name'], typeOf_input::STRING),
            "Rating" => array($_POST['Rating'], typeOf_input::STRING),
            "Genre" => array($_POST['Genre'], typeOf_input::STRING),
            "Trailer" => array($_POST['Trailer'], typeOf_input::STRING),
            "Description" => array($_POST['Description'], typeOf_input::STRING),
        );
        break;
    case "Series":
        $data = array(
            "Name" => array($_POST['Name'], typeOf_input::STRING),
            "Rating" => array($_POST['Rating'], typeOf_input::STRING),
            "Genre" => array($_POST['Genre'], typeOf_input::STRING),
            "Seasons" => array($_POST['Seasons'], typeOf_input::STRING),
            "Trailer" => array($_POST['Trailer'], typeOf_input::STRING),
            "Description" => array($_POST['Description'], typeOf_input::STRING),
        );
        break;

    case "Celebrities":
        $data = array(
            "Name" => array($_POST['Name'], typeOf_input::STRING),
            "Age" => array($_POST['Age'], typeOf_input::STRING),
            "Description" => array($_POST['Description'], typeOf_input::STRING),
        );
        break;
}

$client = new KKJ_Database("WebProject", $hidden, "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");
$temp_array = array();
foreach ($data as $key => $value) {
    $temp_array[$key] = $value[0];
}

$client->insertOne($temp_array);
echo "Data Inserted";
header("Location: ../HTML/adminpage.html");
?>