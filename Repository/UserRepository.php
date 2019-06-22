<?php

namespace Repository;

use Entity\User;
use PDO;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(User::class, "users");
    }

    public function getUserRoleId($userId) {
        $statement = $this->pdo->query("SELECT role_id FROM users_roles_view WHERE user_id=$userId LIMIT 1 ");
        $result =  $statement->fetch(PDO::FETCH_ASSOC);
        return isset($result["role_id"]) ? $result["role_id"] : null;
    }

    public function getAllUserData($userId) {
        $statement = $this->pdo->query("SELECT * FROM all_user_data WHERE id=$userId LIMIT 1");
        $result =  $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addUserRole($roleId) {
        $stmt = $this->pdo->query("SELECT id FROM users ORDER BY id DESC LIMIT 1");
        $newestUserId = $stmt->fetch();
        if (isset($newestUserId["id"])) {
            $stmt = $this->pdo->query("UPDATE users_roles SET role_id = {$roleId} WHERE user_id = {$newestUserId["id"]}");
            return $stmt->execute();
        }

        return false;
    }

    public function addUserWithData(User $user, Array $user_data) {
        //Prepare our INSERT SQL statement.
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        //Execute the statement and insert our serialized object string.
        $userAddResult = $stmt->execute($user->getArrayValues());
        $newUserId = $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO users_data (user_id, first_name, last_name, phone_number) VALUES (?, ?, ?, ?)");
        $userAddResult2 = $stmt->execute([$newUserId, $user_data["first_name"], $user_data["last_name"], $user_data["phone_number"]]);
        return $userAddResult && $userAddResult2;
    }

    public function save(User $user)
    {
        //Prepare our INSERT SQL statement.
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        //Execute the statement and insert our serialized object string.
        return $stmt->execute($user->getArrayValues());
    }
}