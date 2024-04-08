<?php {
    interface IMessage
    {
        public function __construct(
            int $id,
            string $date,
            string $text,
            null|int $user_id
        );
        public function GetID(): int;
        public function GetDate(): string;
        public function GetText(): string;
        public function GetSenderID(): null|int;
        public static function FromData(array $mess);
    }
}