<?php
namespace ajax_signup;

require_once "./passwordValidity.php";
use passwordValidity\PasswordCheck;

$pass = $_REQUEST["mode"];

$flag = (new PasswordCheck($pass))->checkPassword();

if ($flag) {
    echo "Password is valid";
} else {
    echo "false";
}
?>