<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class HomeController extends AbstractController
{
    /** TODO: index method */
    public function index()
    {
        $this->render("index", []);
    }
}