<?php
namespace dhu;

use dhu\Controller\IndexController;
use dhu\Controller\LoginController;
use dhu\Controller\RegisterController;
use dhu\Controller\GameController;

use dhu\Service\Login\LoginPdoService;
use dhu\Service\Register\RegisterPdoService;
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
        return new IndexController($this->getTemplateEngine());
    }
    public function getLoginController()
    {
        return new LoginController($this->getTemplateEngine(), $this->getLoginPdoService());
    }
    public function getRegisterController()
    {
        return new RegisterController($this->getTemplateEngine(), $this->getRegisterPdoService());
    }
    public function getGameController()
    {
        return new GameController($this->getTemplateEngine());
    }
    private function getPDO()
    {
        return new \PDO("mysql:host=mariadb;dbname=battleShip;charset=utf8", $this->config["database"]["user"], "my-secret-pw", [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }
    public function getLoginPdoService()
    {
        return new LoginPdoService($this->getPDO());
    }
    public function getRegisterPdoService()
    {
        return new RegisterPdoService($this->getPDO());
    }
    public static function getMailer()
    {
        return \Swift_Mailer::newInstance(\Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, "ssl")->setUsername("gibz.module.151@gmail.com")->setPassword("Pe$6A+aprunu"));
    }
}