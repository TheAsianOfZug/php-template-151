<?php
namespace dhu;

use dhu\Controller\IndexController;

class Factory
{

    private $config;

    public static function createFromIniFile($filename)
    {
        return new Factory(parse_ini_file($filename, true));
    }

    public function __construct(array $config)
    {
        $this->$config = $config;
    }

    public function getTemplateEngine()
    {
        return new SimpleTemplateEngine(__DIR__ . "/../templates/");
    }

    public function getIndexController()
    {
        return new IndexController($this->getTemplateEngine());
    }

    public function getLoginController()
    {
        return new IndexController($this->getTemplateEngine(), $this->getLoginPdoService());
    }

    public function getRegisterController()
    {
        return new RegisterController($this->getTemplateEngine(), $this->getLoginPdoService());
    }

    private function getPDO()
    {
        return new PDO("mysql:host=mariadb;dbname=app;charset=utf8", $this->$config["database"]["user"], "my-secret-pw");
    }

    public function getLoginPdoService()
    {
        return new LoginPdoService($this->getPDO());
    }
}