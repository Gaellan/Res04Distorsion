<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class User implements JsonSerializable
{
    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        $array = [];
        $array["id"] = $this->id;
        $array["username"] = $this->username;
        $array["email"] = $this->email;
        $array["password"] = $this->password;

        return $array;
    }
}