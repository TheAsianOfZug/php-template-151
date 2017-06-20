<?php
namespace dhu\Service\Register;

interface RegisterService
{
    public function registerUser($data);
    public function getUsers($data);
}