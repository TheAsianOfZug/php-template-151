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
        if ($data["email"] == "")
        {
            $this->showregister();
            return;
        }
        if (array_key_exists("email", $data) and array_key_exists("password", $data))
        {
            $password = $data["password"];
            $passwordErr = "";
            if (strlen($password) <= '8')
            {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            }
            elseif (!preg_match("#[0-9]#", $password))
            {
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            }
            elseif (!preg_match("#[a-z]#", $password))
            {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            }
            elseif (!preg_match("#[A-Z]+#", $password))
            {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            }
            if ($passwordErr == "")
            {
                $stmt = $this->registerService->getUsers($data);
                
                if ($stmt->rowCount() != 0)
                {
                    echo $this->template->render("register.html.php", [
                        "email" => $data["email"]
                    ]);
                    echo 'User already exists';
                }
                try
                {
                    $this->registerService->registerUser($data);
                    echo $this->template->render("homepage.html.php", [
                        "email" => $data["email"]
                    ]);
                    echo "Registered Successful";
                }
                catch (Exception $e)
                {
                    
                    echo $this->template->render("register.html.php", [
                        "email" => $data["email"]
                    ]);
                }
                return;
            }
            else
            {
                $this->showregister();
                echo $passwordErr;
                return;
            }
        }
    }
}