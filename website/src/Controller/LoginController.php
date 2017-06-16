<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;
use dhu\Service\Login\LoginService;
class LoginController
{
    
    /**
     *
     * @var dhu\SimpleTemplateEngine Template engines to render output
     */
    private $template;
    private $loginService;
    
    /**
     *
     * @param
     *            dhu\SimpleTemplateEngine
     */
    public function __construct(SimpleTemplateEngine $template, LoginService $loginService)
    {
        $this->template = $template;
        $this->loginService = $loginService;
    }
    public function showlogin()
    {
        $csrf = $this->factory->generateCsrf("login");
        echo $this->template->render("login.html.php", [
            "login" => $csrf
        ]);
    }
    public function login(array $data)
    {
        if (! array_key_exists("email", $data) or ! array_key_exists("password", $data))
        {
            $this->showlogin();
            return;
        }
        
        if ($this->loginService->authenticate($data['email'], $data['password']))
        {
            session_destroy();
            session_start();
            $_SESSION["email"] = $data["email"];
            header("Location: /");
        }
        else
        {
            echo $this->template->render("login.html.php", [
                "email" => $data["email"]
            ]);
        }
    }
}