<?php
error_reporting(E_ALL);

require_once ("../vendor/autoload.php");
$tmpl = new dhu\SimpleTemplateEngine(__DIR__ . "/../templates/");
$pdo = new PDO("mysql:host=mariadb;dbname=app;charset=utf8", "root", "my-secret-pw");

switch ($_SERVER["REQUEST_URI"])
{
    case "/":
        (new dhu\Controller\IndexController($tmpl))->homepage();
        break;
    
    case "/login":
        $controller = new dhu\Controller\LoginController($tmpl, $pdo);
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            $controller->showlogin();
        } else
        {
            $controller->login($_POST);
        }
        break;
    default:
        $matches = [];
        if (preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches))
        {
            (new dhu\Controller\IndexController($tmpl))->greet($matches[1]);
            break;
        }
        echo "Not Found";
}