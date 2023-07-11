<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class Room
{
    private ?int $id;
    private string $name;
    private ?string $description;
    private Category $category;

    /**
     * @param string $name
     * @param string|null $description
     */
    public function __construct(string $name, ?string $description, Category $category)
    {
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
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

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
}