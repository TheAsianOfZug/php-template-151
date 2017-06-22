<?php
namespace dhu;

class HelperUtil
{
    public static function getHashedPassword($password)
    {
        $salt = "This1sARand0mSa1t$";
        $hashedPassword = md5($password + $salt);
        return $hashedPassword;
    }
    
    public static function generateCsrf($csrfName)
    {
        if($csrfName == null)
        {
            return "";
        }
        $csrf = HelperUtil::generateString(50);
        $_SESSION[$csrfName . "csrf"] = $csrf;
        return $csrf;
    }
    
    private static function generateString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $length - 1)];
        }
        return $randomString;
    }
    
    public static function sendMail(array $data,string $subject, string $bodyContent)
    {
        $message = \Swift_Message::newInstance()->setSubject($subject)
        ->setFrom(array(
            'noreply@battleShip.ch' => 'BattleShip'
        ))
        ->setTo(array(
            $data["email"] => $data["email"]
        ))
        ->setBody($bodyContent, 'text/html')
        ->setContentType("text/html");
        Factory::getMailer()->send($message);
    }
}