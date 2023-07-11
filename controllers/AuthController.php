<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class AuthController extends AbstractController
{
    public function register()
    {

    }

    public function login()
    {

    }

    public function logout()
    {
        session_destroy();
        header("Location:/");
    }
}