<?php
use dhu\Factory;

error_reporting(E_ALL);

require_once ("../vendor/autoload.php");
$factory = Factory::createFromIniFile(__DIR__ . "/../sconfig.ini");

switch ($_SERVER["REQUEST_URI"])
{
    case "/":
        $factory->getIndexController()->homepage();
        break;
    
    case "/login":
        $controller = $factory->getLoginController();
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $controller->showlogin();
        }
        else
        {
            $controller->login($_POST);
        }
        break;
    
    case "/register":
        $controller = $factory->getRegisterController();
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $controller->showregister();
        }
        else
        {
            $controller->register($_POST);
        }
        break;
    default:
        $matches = [];
        if (preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches))
        {
            $factory->getIndexController()->greet($matches[1]);
            break;
        }
        echo "Not Found";
        break;
}