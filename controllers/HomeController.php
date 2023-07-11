<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class HomeController extends AbstractController
{
    public function index()
    {
        $this->render("index", []);
    }
}