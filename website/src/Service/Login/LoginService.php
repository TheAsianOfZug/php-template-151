<?php
namespace dhu\Service\Login;

interface LoginService
{
    public function authenticate($username, $password);
    public function forgotPassword(array $data);
    public function setNewPassword(array $data);
}