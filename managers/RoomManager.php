<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class RoomManager extends AbstractManager
{
    public function getRoomsByCategory(Category $category) : array
    {
        $list = [];
        $query = $this->db->prepare("SELECT * FROM rooms WHERE category_id=:cat_id");
        $parameters = [
            "cat_id" => $category->getId()
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($result as $item)
        {
            $room = new Room($item["name"], $item["description"], $category);
            $room->setId($item["id"]);
            $list[] = $room;
        }
        return $list;
    }

    public function getRoomById(int $id) : ?Room
    {
        $query = $this->db->prepare("SELECT * FROM rooms WHERE id=:id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result !== false)
        {
            $queryCat = $this->db->prepare("SELECT * FROM category WHERE id = :id");
            $catParameters = [
                "id" => $result["category_id"]
            ];
            $queryCat->execute($catParameters);
            $resultCat = $queryCat->fetch(PDO::FETCH_ASSOC);

            if($resultCat !== false)
            {
                $category = new Category($resultCat["name"]);
                $category->setId($resultCat["id"]);
            }
            else
            {
                $category = null;
            }

            if($category)
            {
                $room = new Room($result["name"], $result["description"], $category);
                $room->setId($id);

                return $room;
            }
        }
        return null;
    }

    public function getRoomByNameAndCategory(string $name, int $categoryId) : ?Room
    {
        $query = $this->db->prepare("SELECT * FROM rooms WHERE rooms.name = :name AND rooms.category_id = :catId");
        $parameters = [
            "name" => $name,
            "catId" => $categoryId
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result !== false)
        {
            $queryCat = $this->db->prepare("SELECT * FROM category WHERE id = :id");
            $catParameters = [
                "id" => $categoryId
            ];
            $queryCat->execute($catParameters);
            $resultCat = $queryCat->fetch(PDO::FETCH_ASSOC);

            if($resultCat !== false)
            {
                $category = new Category($resultCat["name"]);
                $category->setId($resultCat["id"]);
            }
            else
            {
                $category = null;
            }

            if($category)
            {
                $room = new Room($result["name"], $result["description"], $category);
                $room->setId($result["id"]);

                return $room;
            }
        }
        return null;
    }

    public function createRoom(Room $room) : ?Room
    {
        $query = $this->db->prepare("INSERT INTO rooms (id, name, description, category_id) VALUES (null, :name, :description, :category_id)");
        $parameters = [
            "name" => $room->getName(),
            "description" => $room->getDescription(),
            "category_id" => $room->getCategory()->getId()
        ];

        $query->execute($parameters);

        $room->setId($this->db->lastInsertId());

        return $room;
    }
}