<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CategoryController extends AbstractController
{
    private CategoryManager $manager;

    public function __construct()
    {
        $this->manager = new CategoryManager();
    }

    public function add()
    {
        // if the form is submitted
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "create-category")
        {
            $name = $_POST["category-name"];
            $category = $this->manager->getCategoryByName($name);
            // if the name is not already taken
            if($category === null)
            {
                $category = $this->manager->createCategory(new Category($name));

                $this->renderJson([
                    "category" => $category
                ]);
            }

        }
    }
}