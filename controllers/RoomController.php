<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class RoomController extends AbstractController
{
    private RoomManager $manager;
    private CategoryManager $cm;

    public function __construct()
    {
        $this->manager = new RoomManager();
        $this->cm = new CategoryManager();
    }

    public function index()
    {

    }

    public function add()
    {
        // if the form is submitted
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "create-room")
        {
            $name = $_POST["room-name"];
            $category = $_POST["category-id"];
            $room = $this->manager->getRoomByNameAndCategory($name, $category);

            // if the name is not already taken
            if($room === null)
            {
                $cat = $this->cm->getCategoryById(intval($category));
                $room = $this->manager->createRoom(new Room($name, null, $cat));

                $this->renderJson([
                    "room" => $room
                ]);
            }
            else
            {
                $this->renderJson([
                    "error" => "Ce salon existe déjà"
                ]);
            }

        }
    }
}