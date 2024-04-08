<?php {
    interface IDocument
    {
        public function __construct(string $url, bool $is_photo);
        public function GetUrl(): string;
        public function GetName(): string;
        public function IsPhoto(): bool;
        public static function FromData(array $dock);
    }
}