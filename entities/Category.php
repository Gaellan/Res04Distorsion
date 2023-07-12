<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Category implements JsonSerializable
{
    private ?int $id;
    private string $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $array = [];
        $array["id"] = $this->id;
        $array["name"] = $this->name;

        return $array;
    }
}