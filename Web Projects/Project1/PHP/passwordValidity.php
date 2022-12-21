<?php
declare(strict_types=1);
namespace passwordValidity;

// * The purpose of this class is to check if the password is valid or not
/* 
 ? The password is valid if it has at least 8 characters
 ?  1 uppercase
 ?  1 lowercase
 ?  1 number
 
*/

class PasswordCheck
{
    private string $password;

    function __construct(string $password)
    {
        $this->password = $password;
    }

    function __destruct()
    {
    }

    function checkPassword(): bool
    {
        $password = $this->password;
        $uppercase = preg_match("/[A-Z]/", $password);
        $lowercase = preg_match("/[a-z]/", $password);
        $number = preg_match("/[0-9]/", $password);

        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }
}

?>