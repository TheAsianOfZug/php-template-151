<?php
namespace dhu\Controller;

use dhu\SimpleTemplateEngine;

class RegisterController
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

    public function showregister()
    {
        echo $this->template->render("register.html.php");
    }

    public function register(array $data)
    {
        if (! array_key_exists("email", $data) or ! array_key_exists("password", $data))
        {
            $passwordErr = "";
            if (strlen($_POST["password"]) <= '8')
            {
                $passwordErr += "Your Password Must Contain At Least 8 Characters!";
            } elseif (! preg_match("#[0-9]+#", $password))
            {
                $passwordErr += "Your Password Must Contain At Least 1 Number!";
            } elseif (! preg_match("#[A-Z]+#", $password))
            {
                $passwordErr += "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif (! preg_match("#[a-z]+#", $password))
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
        
        $stmt = $this->getUsers($data);
        
        if ($stmt->rowCount() != 0)
        {
            echo $this->template->render("register.html.php", [
                "email" => $data["email"]
            ]);
            echo 'User already exists';
        } else
        {
            $password = md5($data['password'] + $salt);
            $stmt = $this->pdo->prepare("INSERT INTO user(email, password) VALUES(?, ?)");
            $stmt->bindValue(1, $data["email"]);
            $stmt->bindValue(2, $password);
            $stmt->execute();
            $_SESSION['email'] = $data['email'];
            header("Location: /");
            echo "Registered Successful";
        }
    }

    /**
     *
     * @param
     *            data
     */
    private function getUsers($data)
    {
        $password = md5($data['password']);
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $data["email"]);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        return $stmt;
    }
}