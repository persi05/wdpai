<?php

require_once __DIR__."/../../Database.php";

class Repository {
    protected $database;

    public function __construct() {
        $this->database = new Database();
    }

}

 public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (email, password, firstname, lastname)
            VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $user['email'],
            $user['password'],
            $user['firstname'],
            $user['lastname']
        ]);
    }