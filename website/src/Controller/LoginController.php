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
        echo $this->template->render("login.html.php");
    }

    public function login(array $data)
    {
        if (! array_key_exists("email", $data) or ! array_key_exists("password", $data))
        {
            $this->showlogin();
            return;
        }
        
        if ($this->loginService->authenticate($data['email'], md5($data['password'])))
        {
            header("Location: /");
        } else
        {
            echo $this->template->render("login.html.php", [
                "email" => $data["email"]
            ]);
        }
    }
}