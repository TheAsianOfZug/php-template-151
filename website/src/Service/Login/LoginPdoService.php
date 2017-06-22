<?php
namespace dhu\Service\Login;

use dhu\HelperUtil;
class LoginPdoService implements LoginService
{
    private $pdo;
    public function __construct(\Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
    public function authenticate($username, $password)
    {
        $hashedPassword = HelperUtil::getHashedPassword($password);
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $hashedPassword);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1)
        {
            $_SESSION['email'] = $username;
            return true;
        }
        else
        {
            return false;
        }
    }
    public function forgotPassword(array $data)
    {
        HelperUtil::sendMail($data, "Passwort vergessen", "Hallo " . $data["email"] . ",</br> Du hast anscheinend das Passwort vergessen. Naja, Pech, denn diese Funktion ist noch nicht richtig implementiert. Probier es <a href='https://localhost/setNewPassword?user=".$data["email"]."'>hier</a>.");
        
    }
    
    public function setNewPassword(array $data)
    {
        $hashedPassword = HelperUtil::getHashedPassword($password);
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $hashedPassword);
        $stmt->execute();
        
        if ($stmt->rowCount() == 1)
        {
            return false;
        }
        else
        {
            $stmt = $this->pdo->prepare("UPDATE user SET password=? WHERE email=?");
            $stmt->bindValue(2, $username);
            $stmt->bindValue(1, $hashedPassword);
            $stmt->execute();
            return true;
        }
    }
}