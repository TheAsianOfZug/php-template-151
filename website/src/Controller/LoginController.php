<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;

class LoginController
{

    /**
     *
     * @var dhu\SimpleTemplateEngine Template engines to render output
     */
    private $template;

    private $pdo;

    /**
     *
     * @param
     *            dhu\SimpleTemplateEngine
     */
    public function __construct(SimpleTemplateEngine $template, \PDO $pdo)
    {
        $this->template = $template;
        $this->pdo = $pdo;
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
        
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $data["email"]);
        $stmt->bindValue(2, $data["password"]);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1)
        {
            $_SESSION['email'] = $data['email'];
            header("Location: /");
            echo "Login Successful";
        } else
        {
            echo $this->template->render("login.html.php", [
                "email" => $data["email"]
            ]);
        }
    }
}
