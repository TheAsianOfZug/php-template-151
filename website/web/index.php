<?php
use dhu\Factory;

error_reporting(none);
session_start();

require_once ("../vendor/autoload.php");
$factory = Factory::createFromIniFile(__DIR__ . "/../config.ini");

switch ($_SERVER["REQUEST_URI"])
{
    case "/":
        $controller = $factory->getIndexController();
        $controller->showHomepage();
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
    
    case "/forgotPassword":
        $controller = $factory->getLoginController();
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $controller->showForgotPassword($_GET);
        }
        else
        {
            $controller->showForgotPassword($_POST);
        }
        break;
        
    case "/setNewPassword":
        $controller = $factory->getLoginController();
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $controller->showSetNewPassword($_GET);
        }
        else
        {
            $controller->setNewPassword($_POST);
        }
        break;
    
    case "/logout":
        $controller = $factory->getLoginController();
        session_destroy();
        $controller->showLogin();
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
        
    case "/game":
        $controller = $factory->getGameController();
        $controller->showGameField();
        break;
            
    default:
        echo $factory->getIndexController()->showHomepage();
        break;
}