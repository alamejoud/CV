<?php
declare(strict_types=1);
namespace signup;

require_once "./imp.php";

use imp\typeOf_input;
use imp\KKJ_Encryption;
use imp\KKJ_Sanitization;
use imp\KKJ_Database;

$NUMBER = 100;
$Sanitize_called = false;
$emailCheck = "";
$usernameCheck = "";

$movie_list = array($NUMBER);
$series_list = array($NUMBER);

for ($i = 0; $i < $NUMBER; $i++) {
    $movie_list[$i] = false;
    $series_list[$i] = false;
}

function Sanitize(&$data): void
{
    foreach ($data as $_ => &$value) {
        if ($_ == "Movies" || $_ == "Series") {
            continue;
        }
        $value[0] = (new KKJ_Sanitization($value[1], $value[0]))->sanitize();
    }
    $GLOBALS["Sanitize_called"] = true;
}

$Encrypt_called = false;
function Encrypt(&$data): void
{
    foreach ($data as $_ => &$value) {
        if ($_ == "Movies" || $_ == "Series") {
            continue;
        }

        if ($_ == "Username") {
            $GLOBALS["usernameCheck"] = $value[0];
            continue;
        }

        $value[0] = (new KKJ_Encryption($value[1], $value[0]))->Encrypt_Element();
        if ($_ == "Email") {
            $GLOBALS["emailCheck"] = $value[0];
        } 
    }
    $GLOBALS["Encrypt_called"] = true;
}

function UserInsert($data): void
{
    $flag = true;

    $temp_array = array();
    foreach ($data as $key => $value) {
        if ($key == "Movies" || $key == "Series") {
            $temp_array[$key] = $value;
        } else {
            $temp_array[$key] = $value[0];
        }
    }

    $client = new KKJ_Database("WebProject", "Users", "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");

    if ($client->findOne(array("Username" => $GLOBALS["usernameCheck"]))) {
        echo "<br> User already exists <br>";
        $flag = false;
    }
    if ($client->findOne(array("Email" => $GLOBALS["emailCheck"]))) {
        echo "<br> Email already exists <br>";
        $flag = false;
    }

    if ($flag) {
        $client->insertOne($temp_array);
        header("Location: ../HTML/Login.html");

    } else {
        header("Location: ../HTML/SignUp.html");
    }
}

$data = array(
    "FirstName" => array($_POST["FirstName"], typeOf_input::STRING),
    "LastName" => array($_POST["LastName"], typeOf_input::STRING),
    "Username" => array($_POST["Username"], typeOf_input::STRING),
    "Email" => array($_POST["Email"], typeOf_input::EMAIL),
    "Password" => array($_POST["Password"], typeOf_input::PASSWORD),
    "Phone" => array($_POST["Phone#"], typeOf_input::NUMBER),
    "Movies" => $movie_list,
    "Series" => $series_list
);

Sanitize($data);
Encrypt($data);
UserInsert($data);

?>