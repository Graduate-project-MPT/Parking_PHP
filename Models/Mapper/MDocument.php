<?php
require_once("Models/Interface/IMapper.php");
require_once("Models/Entity/Document.php");{
    class DocumentMapper implements IMapper
    {
        private array $documentArray;

        public function __construct(array $data)
        {
            $this->documentArray = $data;
        }
        public function GetByID(int $id): Document
        {
            $dock = array_filter($this->documentArray, function ($dock) use ($id) {
                return $id == $dock["ID"];
            });
            return Document::FromData($dock);
        }
        public function GetSize(): int
        {
            return count($this->documentArray);
        }
        public function GetSearchedByID(int $id): DocumentMapper
        {
            return new DocumentMapper(array_filter($this->documentArray, function ($dock) use ($id) {
                return $id == $dock["message_id"];
            }));
        }
        public function GetAsArray(): array
        {
            return array_map(["Document", "FromData"], $this->documentArray);
        }
    }
}