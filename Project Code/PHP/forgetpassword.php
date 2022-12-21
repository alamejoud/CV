<?php
declare(strict_types=1);
namespace forgetPassword;

require_once "./imp.php";
require_once "./passwordValidity.php";

use imp\typeOf_input;
use imp\KKJ_Sanitization;
use passwordValidity\PasswordCheck;


$data = array(
    "Email" => array($_POST["email"], typeOf_input::EMAIL),
    "Password" => array($_POST["pass"], typeOf_input::PASSWORD),
    "ConfirmPass" => array($_POST["confirm"], typeOf_input::PASSWORD)
);

function ForgetSanitize(&$data): void
{
    foreach ($data as $_ => &$value) {
        $value[0] = (new KKJ_Sanitization($value[1], $value[0]))->sanitize();
    }
}
ForgetSanitize($data);

$Pass = new PasswordCheck($data["Password"][0]);
if ($Pass->checkPassword()) {
    if ($data["Password"][0] === $data["ConfirmPass"][0]) {
        echo "Passwords are valid and match, proceed to send email and update database";
    } else {
        echo "Passwords given do not match";
    }
} else {
    echo "Password does not match constraints<br>send response to client";
    die;
}
?>