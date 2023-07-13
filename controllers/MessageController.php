<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class MessageController extends AbstractController
{
    private UserManager $um;
    private RoomManager $rm;
    private MessageManager $mm;

    public function __construct()
    {
        $this->um = new UserManager();
        $this->rm = new RoomManager();
        $this->mm = new MessageManager();
    }

    public function add()
    {
        // if the form is submitted
        if(isset($_POST["form-name"]) && $_POST["form-name"] === "create-message")
        {
            $title = $_POST["message-title"];
            $content = $_POST["message-content"];
            $userId = $_SESSION["user"];
            $roomId = $_POST["room-id"];

            $user = $this->um->getUserById(intval($userId));
            $room = $this->rm->getRoomById(intval($roomId));
            $timezone = new DateTimeZone('Europe/Paris');
            $currentDatetime = new DateTime('now', $timezone);
            $message = new Message($title, $content, $user, $room, $currentDatetime);
            $this->mm->createMessage($message);

            $this->renderJson(["message" => $message]);
        }
    }
}