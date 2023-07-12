<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class HomeController extends AbstractController
{
    private CategoryManager $cm;
    private RoomManager $rm;

    public function __construct()
    {
        $this->cm = new CategoryManager();
        $this->rm = new RoomManager();
    }

    public function index()
    {
        $categories = $this->cm->getAllCategories();
        $cats = [];

        foreach($categories as $category)
        {
            $item = [];
            $item["category"] = $category;
            $item["rooms"] = $this->rm->getRoomsByCategory($category);
            $cats[] = $item;
        }

        if(isset($_SESSION["user"]))
        {
            $this->render("room/index", [
                "categories" => $cats
            ]);
        }
        else
        {
            header("Location:/login");
        }
    }
}