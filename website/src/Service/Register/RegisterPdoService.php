<?php
namespace dhu\Service\Register;

use dhu\HelperUtil;
class RegisterPdoService implements RegisterService
{
    private $pdo;
    public function __construct(\Pdo $pdo)
    {
        $this->pdo = $pdo;
    }
    public function registerUser($data)
    {
        $password = HelperUtil::getHashedPassword($date['password']);
        $stmt = $this->pdo->prepare("INSERT INTO user(email, password) VALUES(?, ?)");
        $stmt->bindValue(1, $data["email"]);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        $_SESSION['email'] = $data['email'];
        header("Location: /");
        echo "Registered Successful";
    }
    

    public function getUsers($data)
    {
        $password = md5($data['password']);
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
        $stmt->bindValue(1, $data["email"]);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        return $stmt;
    }
}