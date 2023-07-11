<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class UserManager extends AbstractManager
{
    public function getUserByEmail(string $email) : ?User
    {
        return null;
    }

    public function getUserByUsername(string $username) : ?User
    {
        return null;
    }

    public function getUserById(int $id) :?User
    {
        return null;
    }

    public function createUser(User $user) : ?User
    {
        $query = $this->db->prepare("INSERT INTO users(id, username, email, password) VALUES (null, :username, :email, :password)");
        $parameters = [
            "username" => $user->getUsername(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword()
        ];

        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());
        return $user;
    }
}