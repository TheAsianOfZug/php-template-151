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
        $csrf = $this->generateString(50);
        $_SESSION[$csrfName . "csrf"] = $csrf;
        return $csrf;
    }
    
    private function generateString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}