<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class RoomController extends AbstractController
{
    private RoomManager $manager;
    private CategoryManager $cm;
    private MessageManager $mm;

    public function __construct()
    {
        $this->manager = new RoomManager();
        $this->cm = new CategoryManager();
        $this->mm = new MessageManager();
    }

    public function index(string $roomId)
    {
        $id = intval($roomId);

        $room = $this->manager->getRoomById($id);
        $messages = $this->mm->getMessagesByRoom($room);

        $categories = $this->cm->getAllCategories();
        $cats = [];

        foreach($categories as $category)
        {
            $item = [];
            $item["category"] = $category;
            $item["rooms"] = $this->manager->getRoomsByCategory($category);
            $cats[] = $item;
        }

        $this->render("room/index", [
            "room" => $room,
            "categories" => $cats,
            "messages" => $messages
        ]);
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