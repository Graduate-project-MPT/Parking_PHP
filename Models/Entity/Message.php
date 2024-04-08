<?php
require_once("Models/Interface/IMessage.php");{
    class Message implements IMessage
    {
        private int $id;
        private string $date;
        private string $text;
        private null|int $user_id;

        public function __construct(
            int $id,
            string $date,
            string $text,
            null|int $user_id
        ) {
            $this->id = $id;
            $this->date = $date;
            $this->text = $text;
            $this->user_id = $user_id;
        }
        public function GetID(): int
        {
            return $this->id;
        }
        public function GetDate(): string
        {
            return $this->date;
        }
        public function GetText(): string
        {
            return $this->text;
        }
        public function GetSenderID(): null|int
        {
            return $this->user_id;
        }
        public static function FromData(array $mess): Message
        {
            return new Message(
                $mess["ID"],
                date("F j, Y, g:i a", $mess["message_date"]),
                ($mess["message_text"] == null? "" : $mess["message_text"]),
                $mess["user_id"]
            );
        }
    }
}