<?php
require_once "FileManager.php";

class User {
    private $usersFile;

    public function __construct($usersFile) {
        $this->usersFile = $usersFile;
    }

    public function authenticate($username, $password) {
        $users = FileManager::readJson($this->usersFile);
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                return true;
            }
        }
        return false;
    }
}
