<?php
require_once("Models/Interface/IDocument.php");{
    class Document implements IDocument
    {
        private string $url;
        private bool $is_photo;

        public function __construct(string $url, bool $is_photo)
        {
            $this->url = $url;
            $this->is_photo = $is_photo;
        }
        public function GetUrl(): string
        {
            return $this->url;
        }

        public function GetName(): string
        {
            return basename($this->url);
        }
        public function IsPhoto(): bool{
            return $this->is_photo;
        }

        public static function FromData(array $dock): Document
        {
            return new Document($dock["document_file_url"], $dock["document_file_mime"] == "photo");
        }
    }
}