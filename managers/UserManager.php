<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class UserManager extends AbstractManager
{
    public function getUserByEmail(string $email) : ?User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE users.email = :email");
        $parameters = [
            "email" => $email
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result !== null)
        {
            $user = new User($result["username"], $result["email"], $result["password"]);
            $user->setId($result["id"]);

            return $user;
        }

        return $result;
    }

    public function getUserByUsername(string $username) : ?User
    {
        return null;
    }

    public function getUserById(int $id) :?User
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE users.id = :id");
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result !== false)
        {
            $user = new User($result["username"], $result["email"], $result["password"]);
            $user->setId($result["id"]);

            return $user;
        }

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