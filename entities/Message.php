<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Message
{
    private ?int $id;
    private ?string $title;
    private string $content;
    private User $author;
    private Room $room;
    private DateTime $datetime;

    /**
     * @param string|null $title
     * @param string $content
     * @param User $author
     * @param Room $room
     * @param DateTime $datetime
     */
    public function __construct(?string $title, string $content, User $author, Room $room, DateTime $datetime)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->room = $room;
        $this->datetime = $datetime;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return Room
     */
    public function getRoom(): Room
    {
        return $this->room;
    }

    /**
     * @param Room $room
     */
    public function setRoom(Room $room): void
    {
        $this->room = $room;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }

    /**
     * @param DateTime $datetime
     */
    public function setDatetime(DateTime $datetime): void
    {
        $this->datetime = $datetime;
    }

}