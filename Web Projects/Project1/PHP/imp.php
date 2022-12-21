<?php
declare(strict_types=1);
namespace imp;

require_once "../../vendor/autoload.php";

use MongoDB\Client;

/*
! This class covers:
* Handling Sanitization
* Handling Un/Encryption
*/

enum typeOf_input: string
{
    case PASSWORD = "password";
    case EMAIL = "email";
    case NUMBER = "number";
    case STRING = "default";
}

class KKJ_Encryption
{
    private string $input;
    private typeOf_input $typeOf_input_enum;

    function __construct(typeOf_input $typeOf_input, string $input)
    {
        $this->typeOf_input_enum =  $typeOf_input;
        $this->input = $input;
    }

    function __destruct()
    {
    }

    // * De/Encrypting functions

    function Encrypt_Element(): string
    {
        switch ($this->typeOf_input_enum) {
            case typeOf_input::PASSWORD:
                $this->input = password_hash($this->input, PASSWORD_BCRYPT, array("cost" => 16));
                break;

            default:
                $this->input = openssl_encrypt($this->input, "AES-128-ECB", "WHAT");
                break;
        }

        return $this->get_input();
    }

    function Decrypt_Element():string 
    {
        switch($this->typeOf_input_enum) {
            case typeOf_input::STRING:
            case typeOf_input::EMAIL:
            case typeOf_input::NUMBER:
                $this->input = openssl_decrypt($this->input, "AES-128-ECB", "WHAT");
                break;

            default:
                break;
        }

        return $this->get_input();
    }

    function verify_password(string $password): bool
    {
        return password_verify($password, $this->input);
    }

    // * Getters

    private function get_input(): string
    {
        return $this->input;
    }
}


class KKJ_Sanitization
{
    private string $input;
    private typeOf_input $typeOf_input_enum;

    function __construct(typeOf_input $typeOf_input, string $input)
    {
        $this->typeOf_input_enum =  $typeOf_input;
        $this->input = $input;
    }

    function __destruct()
    {
    }

    // * Sanitizing functions

    function sanitize(): string
    {
        switch ($this->typeOf_input_enum) {
            case typeOf_input::EMAIL:
                $this->input = filter_var($this->input, FILTER_SANITIZE_EMAIL);
                break;

            case typeOf_input::NUMBER:
                $this->input = filter_var($this->input, FILTER_SANITIZE_NUMBER_INT);
                break;

            default:
                $this->input =htmlspecialchars($this->input, ENT_QUOTES, 'UTF-8', true);
                break;
                
        }

        return $this->getInput();
    }

    private function getInput(): string {
        return $this->input;
    }
}


class KKJ_Database {
    private string $database_name;
    private string $collection_name;
    private string $connection_string;
    private Client $client;

    function __construct(string $database_name, string $collection_name, string $connection_string)
    {
        $this->database_name = $database_name;
        $this->collection_name = $collection_name;
        $this->connection_string = $connection_string;

        $this->client = new Client;
    }

    function __destruct() 
    {
    }

    function insertOne(array $data)
    {
        $this->client->selectDatabase($this->database_name)->selectCollection($this->collection_name)->insertOne($data);
    }

    function insertMany(array $data) 
    {
        $this->client->selectDatabase($this->database_name)->selectCollection($this->collection_name)->insertMany($data);
    }

    function findOne(array $data) 
    {
        return $this->client->selectDatabase($this->database_name)->selectCollection($this->collection_name)->findOne($data);
    }

    function findMany(array $data) 
    {
        return $this->client->selectDatabase($this->database_name)->selectCollection($this->collection_name)->find($data);
    }
}
?>