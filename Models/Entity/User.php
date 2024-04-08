<?php
require_once("Models/Interface/IUser.php");{
    class User implements IUser
    {
        private int $id;
        private string $login;
        public function __construct(
            int $id,
            string $login
        ) {
            $this->id = $id;
            $this->login = $login;
        }
        public function GetID(): int
        {
            return $this->id;
        }
        public function GetLogin(): string
        {
            return $this->login;
        }
        public static function FromData(array $user): User
        {
            return new User($user["ID"], $user["user_login"]);
        }
    }
}