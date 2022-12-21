<?php
declare(strict_types=1);

namespace login;

require_once "./imp.php";

use imp\typeOf_input;
use imp\KKJ_Encryption;
use imp\KKJ_Sanitization;
use imp\KKJ_Database;

function LogSanitize(&$data): void
{
    foreach ($data as $_ => &$value) {
        $value[0] = (new KKJ_Sanitization($value[1], $value[0]))->sanitize();
    }
}

function LogEncrypt(&$data): void
{
    foreach ($data as $_ => &$value) {
        if ($_ == "Password" || $_ == "Username") {
            continue;
        }
        $value[0] = (new KKJ_Encryption($value[1], $value[0]))->Encrypt_Element();
    }
}


$data = array(
    "Username" => array($_POST['username'], typeOf_input::STRING),
    "Password" => array($_POST['password'], typeOf_input::PASSWORD)
);

LogSanitize($data);
LogEncrypt($data);


if (isset($_POST['UserLogin'])) {
    $client = new KKJ_Database("WebProject", "Users", "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");

    $result = $client->findOne(array("Username" => $data["Username"][0]));

    if ($result) {
        if (password_verify($data["Password"][0], $result["Password"])) {
            echo "Login Successful";
            // User can be redirected to the main page
            // usage of header("Location: <URL>")
            session_id("VUE-USER-LOGGEDIN");
            session_start();
            $_SESSION["Username"] = $data["Username"][0];

            //echo $_SESSION["Username"];
            header("Location: ../HTML/index.php");

        } else {
            echo 1;
            echo "Invalid Password";
        }
    } else {
        echo "Invalid Username";
    }
} if (isset($_POST['StaffLogin'])) {
    $client = new KKJ_Database("WebProject", "Staff", "mongodb+srv://WebProjectAdmin:querty@webproject.fclikl3.mongodb.net/");

    $result = $client->findOne(["Username" => "admin"]);

    if ($result) {
        if (password_verify($data["Password"][0], $result["Password"])) {
            echo "Login Successful"; // User can be redirected to the main page
            // usage of header("Location: <URL>")
            //echo $_SESSION["Username"];
            header("Location: ../HTML/AdminPage.html");

        } else {
            echo "Invalid Password";
        }
    } else {
        echo (new KKJ_Encryption(typeOf_input::STRING, "admin"))->Encrypt_Element();
        echo "Invalid Username";
    }

}
?>