<?php
require_once("Models/Interface/IMapper.php");
require_once("Models/Entity/Message.php");{
    class MessageMapper implements IMapper
    {
        private const ONE_DAY_TIC = 86400;
        private array $messageArray;

        public function __construct(array $data)
        {
            $this->messageArray = $data;
            array_multisort(array_column($this->messageArray, "ID"), SORT_DESC, $this->messageArray);
        }
        public function GetByID(int $id): MessageMapper
        {
            $mess = array_filter($this->messageArray, function ($mess) use ($id) {
                return $id == $mess["ID"];
            });
            return new MessageMapper($mess);
        }
        public function GetSize(): int
        {
            return count($this->messageArray);
        }
        public function GetSearchedByID(int|null $id = null): MessageMapper
        {
            return new MessageMapper(array_filter($this->messageArray, function ($mess) use ($id) {
                return $id == $mess["message_answer_id"];
            }));
        }
        public function GetSearchByUserID(int $user_id): MessageMapper
        {
            return new MessageMapper(array_filter($this->messageArray, function ($mess) use ($user_id) {
                return $user_id == $mess["user_id"] && $mess["message_answer_id"] == null;
            }));
        }
        public function GetSearchByDates(int $begin_date, int $end_date): MessageMapper
        {
            return new MessageMapper(array_filter($this->messageArray, function ($mess) use ($begin_date, $end_date) {
                return 
                       $mess["message_date"] >= $begin_date && 
                       $mess["message_date"] <= ($end_date + MessageMapper::ONE_DAY_TIC) &&
                       $mess["message_answer_id"] == null;
            }));
        }
        public function GetAsArray(): array
        {
            return array_map(["Message", "FromData"], $this->messageArray);
        }
    }
}