<?php
namespace dhu\Service\Login;

interface LoginService
{

    public function authenticate($username, $password);
}