<?php
require_once("Models/Interface/IMapper.php");
require_once("Models/Entity/User.php");{
    class UserMapper implements IMapper
    {
        private array $userArray;

        public function __construct(array $data)
        {
            $this->userArray = $data;
        }
        public function GetByID(int $id): User
        {
            $user = array_filter($this->userArray, function ($user) use ($id) {
                return $id == $user["ID"];
            });
            if(count($user) == 0)
            {
                throw new Exception("NUll user");
            }
            return User::FromData(reset($user));
        }
        public function GetSize(): int
        {
            return count($this->userArray);
        }
        public function GetSearchedByID(int $id): UserMapper
        {
            return new UserMapper(array_filter($this->userArray, function ($user) use ($id) {
                return $id == $user["ID"];
            }));
        }
        public function GetSearchedByLogin(string $login): UserMapper
        {
            return new UserMapper(array_filter($this->userArray, function ($user) use ($login) {
                return str_contains($user["user_login"], $login);
            }));
        }
        public function GetAsArray(): array
        {
            return array_map(["User", "FromData"], $this->userArray);
        }
    }
}