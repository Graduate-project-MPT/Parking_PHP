<?php {
    interface IMapper
    {
        public function __construct(array $data);
        public function GetByID(int $id);
        public function GetSize(): int;
        public function GetSearchedByID(int $id);
        public function GetAsArray(): array;
    }
}