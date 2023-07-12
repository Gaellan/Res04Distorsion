<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CategoryManager extends AbstractManager
{
    public function getAllCategories() : array
    {
        $list = [];
        $query = $this->db->prepare("SELECT * FROM category");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if($result !== false)
        {
            foreach($result as $item)
            {
                $category = new Category($item["name"]);
                $category->setId($item["id"]);
                $list[] = $category;
            }
        }

        return $list;
    }

    public function getCategoryById(int $id) :?Category
    {
        $query = $this->db->prepare("SELECT * FROM category WHERE category.id = :id");
        $parameters = [
            "id" => $id
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