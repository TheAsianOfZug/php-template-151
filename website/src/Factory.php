<?php
namespace dhu;

use dhu\Controller\IndexController;
use dhu\Service\Login\LoginPdoService;
class Factory
{
    private $config;
    public static function createFromIniFile($filename)
    {
        return new Factory(parse_ini_file($filename, true));
    }
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    public function getTemplateEngine()
    {
        return new SimpleTemplateEngine(__DIR__ . "/../templates/");
    }
    public function getIndexController()
    {
        return new Controller\IndexController($this->getTemplateEngine());
    }
    public function getLoginController()
    {
        return new Controller\LoginController($this->getTemplateEngine(), $this->getLoginPdoService());
    }
    public function getRegisterController()
    {
        return new Controller\RegisterController($this->getTemplateEngine(), $this->getRegisterPdoService());
    }
    private function getPDO()
    {
        return new \PDO("mysql:host=mariadb;dbname=battleShip;charset=utf8", $this->config["database"]["user"], "my-secret-pw", [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }
    public function getLoginPdoService()
    {
        return new Service\Login\LoginPdoService($this->getPDO());
    }
    public function getRegisterPdoService()
    {
        return new Service\Register\RegisterPdoService($this->getPDO());
    }
}