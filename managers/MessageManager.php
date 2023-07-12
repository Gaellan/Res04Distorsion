<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class MessageManager extends AbstractManager
{
    private RoomManager $rm;
    private UserManager $um;

    public function __construct()
    {
        parent::__construct();
        $this->rm = new RoomManager();
        $this->um = new UserManager();
    }

    public function getMessagesByRoom(Room $room) : Array
    {
        $list = [];
        $query = $this->db->prepare("SELECT * FROM messages WHERE room_id=:roomId");
        $parameters = [
          "roomId" => $room->getId()
        ];
        $query->execute($parameters);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach($results as $result)
        {
            $room = $this->rm->getRoomById($result["room_id"]);
            $author = $this->um->getUserById($result["author_id"]);
            $format = 'Y-m-d H:i:s';
            $dateTime = DateTime::createFromFormat($format, $result["date"]);
            $message = new Message($result["title"], $result["content"], $author, $room, $dateTime);
            $list[] = $message;
        }

        return $list;
    }

    public function createMessage(Message $message) : ?Message
    {
        $query = $this->db->prepare("INSERT INTO messages(id, title, content, author_id, room_id, date) VALUES (null, :title, :content, :author, :room, :date)");
        $parameters = [
          "title" => $message->getTitle(),
          "content" => $message->getContent(),
          "author" => $message->getAuthor()->getId(),
          "room" => $message->getRoom()->getId(),
          "date" => date('Y-m-d H:i:s')
        ];
        $query->execute($parameters);
        $message->setId($this->db->lastInsertId());

        return $message;
    }
}