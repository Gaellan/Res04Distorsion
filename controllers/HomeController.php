<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class HomeController extends AbstractController
{
    public function index()
    {
        if(isset($_SESSION["user"]))
        {
            $this->render("room/index", []);
        }
        else
        {
            header("Location:/login");
        }
    }
}