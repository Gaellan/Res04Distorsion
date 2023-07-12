<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CategoryManager extends AbstractManager
{
    public function getAllCategories() : array
    {
        return [];
    }

    public function getCategoryById(int $id) :?Category
    {
        return null;
    }

    public function getCategoryByName(string $name) :?Category
    {
        $query = $this->db->prepare("SELECT * FROM category WHERE category.name = :name");
        $parameters = [
            "name" => $name
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result !== false)
        {
            $category = new Category($result["name"]);
            $category->setId($result["id"]);

            return $category;
        }

        return null;
    }

    public function createCategory(Category $category) : ?Category
    {
        $query = $this->db->prepare("INSERT INTO category (id, name) VALUES (null, :name)");
        $parameters = [
            "name" => $category->getName(),
        ];

        $query->execute($parameters);

        $category->setId($this->db->lastInsertId());

        return $category;
    }
}