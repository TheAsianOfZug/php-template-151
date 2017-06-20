<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;
use dhu\HelperUtil;
use dhu\Service\Register\RegisterPdoService;
class RegisterController
{
    
    /**
     *
     * @var dhu\SimpleTemplateEngine Template engines to render output
     */
    private $template;
    private $registerService;
    /**
     *
     * @param
     *            dhu\SimpleTemplateEngine
     */
    public function __construct(SimpleTemplateEngine $template, RegisterPdoService $registerService)
    {
        $this->template = $template;
        $this->registerService = $registerService;
    }
    public function showregister()
    {
        $csrf = HelperUtil::generateCsrf("registration");
        echo $this->template->render("register.html.php", [
            "registration" => $csrf
        ]);
    }
    public function register(array $data)
    {
        if (! array_key_exists("email", $data) or ! array_key_exists("password", $data))
        {
            $passwordErr = "";
            if (strlen($_POST["password"]) <= '8')
            {
                $passwordErr += "Your Password Must Contain At Least 8 Characters!";
            }
            elseif (! preg_match("#[0-9]+#", $password))
            {
                $passwordErr += "Your Password Must Contain At Least 1 Number!";
            }
            elseif (! preg_match("#[A-Z]+#", $password))
            {
                $passwordErr += "Your Password Must Contain At Least 1 Capital Letter!";
            }
            elseif (! preg_match("#[a-z]+#", $password))
            {
                $passwordErr += "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            if (! $passwordErr != "")
            {
                $this->showregister();
                echo $passwordErr;
                return;
            }
            if ($data['password'])
            {
                $this->showregister();
                return;
            }
        }
        
        $stmt = $this->registerService->getUsers($data);
        
        if ($stmt->rowCount() != 0)
        {
            echo $this->template->render("register.html.php", [
                "email" => $data["email"]
            ]);
            echo 'User already exists';
        }
        
        $this->registerService->registerUser($data);
    }
}