<?php {
    interface IUser
    {
        public function __construct(
            int $id,
            string $login
        );
        public function GetID(): int;
        public function GetLogin(): string;
        public static function FromData(array $user);
    }
}