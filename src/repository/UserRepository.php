<?php

require_once __DIR__."/Repository.php";

class UserRepository extends Repository {

    public function getUsers(): ?array {
        $query = $this->database->connect()->prepare(
          "
          SELECT * FROM users;
          "  
        );
        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
}