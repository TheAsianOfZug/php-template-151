<?php
namespace dhu\Service\Login;

class LoginPdoService implements LoginService
{

    private $pdo;

    public function __construct(\Pdo $pdo)
    {
        $this->pdo = $pdo;
    }

    public function authenticate($username, $password)
    {
        $hashedPassword = md5($password);
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $hashedPassword);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1)
        {
            $_SESSION['email'] = $username;
            return true;
        } else
        {
            return false;
        }
    }
}