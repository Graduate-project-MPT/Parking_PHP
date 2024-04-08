<?php
define("TUSER", "wp_user");
define("TMESSAGE", "wp_message");
define("TDOCUMENT", "wp_document"); {
    class DBConnector
    {
        private const URL_DB = "localhost";
        private const PORT = "3333";
        private const DB_NAME = "db";
        private const USER_NAME = "root";
        private const PASSWORD = "root";

        private $conn;

        public function __construct(){
            $this->conn = mysqli_connect(
                hostname: DBConnector::URL_DB,
                username: DBConnector::USER_NAME,
                password: DBConnector::PASSWORD,
                database: DBConnector::DB_NAME,
                port:  DBConnector::PORT
               
            );
            if (!$this->conn) {
                header("Location: Main.php?Exception=1");
                exit;
            }
        }

        public function SelectAll(string $tableName): array{
            // if ($tableName == TUSER) {
            //     return [
            //         0 =>
            //             array(
            //                 "ID" => 1,
            //                 "user_login" => "User1"
            //             ),
            //         1 =>
            //             array(
            //                 "ID" => 2,
            //                 "user_login" => "User2"
            //             ),
            //         2 =>
            //             array(
            //                 "ID" => 3,
            //                 "user_login" => "User3"
            //             ),
            //     ];
            // } else if ($tableName == TMESSAGE) {
            //     return [
            //         0 =>
            //             array(
            //                 "ID" => 1,
            //                 "message_date" => 1000000,
            //                 "message_text" => "MessID=1",
            //                 "message_answer_id" => null,
            //                 "user_id" => 1
            //             ),
            //         1 =>
            //             array(
            //                 "ID" => 2,
            //                 "message_date" => 2000000,
            //                 "message_text" => "MessID=2",
            //                 "message_answer_id" => 1,
            //                 "user_id" => 1
            //             ),
            //         2 =>
            //             array(
            //                 "ID" => 3,
            //                 "message_date" => 3000000,
            //                 "message_text" => "MessID=3",
            //                 "message_answer_id" => 2,
            //                 "user_id" => 1
            //             ),

            //         3 =>
            //             array(
            //                 "ID" => 4,
            //                 "message_date" => 3500000,
            //                 "message_text" => "MessID=4",
            //                 "message_answer_id" => 3,
            //                 "user_id" => 2
            //             ),
            //         4 =>
            //             array(
            //                 "ID" => 5,
            //                 "message_date" => 4000000,
            //                 "message_text" => "MessID=5",
            //                 "message_answer_id" => 4,
            //                 "user_id" => 2
            //             ),
            //         5 =>
            //             array(
            //                 "ID" => 6,
            //                 "message_date" => 4500000,
            //                 "message_text" => "MessID=6",
            //                 "message_answer_id" => 5,
            //                 "user_id" => 3
            //             ),
            //     ];
            // } else {
            //     return [
            //         0 =>
            //             array(
            //                 "ID" => 1,
            //                 "message_id" => 1,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         1 =>
            //             array(
            //                 "ID" => 2,
            //                 "message_id" => 2,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         2 =>
            //             array(
            //                 "ID" => 3,
            //                 "message_id" => 2,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         3 =>
            //             array(
            //                 "ID" => 4,
            //                 "message_id" => 1,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         4 =>
            //             array(
            //                 "ID" => 5,
            //                 "message_id" => 1,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         5 =>
            //             array(
            //                 "ID" => 6,
            //                 "message_id" => 4,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //         6 =>
            //             array(
            //                 "ID" => 7,
            //                 "message_id" => 4,
            //                 "document_file_url" => "https://img.freepik.com/free-photo/mountains-lake_1398-1150.jpg",
            //                 "document_file_mime" => "photo"
            //             ),
            //     ];
            // }
            $GetAllSql = "SELECT * from " . DBConnector::DB_NAME . "." . $tableName;

            return mysqli_fetch_all(mysqli_query($this->conn, $GetAllSql), MYSQLI_ASSOC);
        }

        public function InsertData(string $tableName, array $attr){
            $InsertSQL = "insert into " . DBConnector::DB_NAME . "." . $tableName . " ("; 
            {
                $is_begin = true;
                foreach ($attr as $key => $_) {
                    $InsertSQL .= ($is_begin ? "" : ",") . " " . $key;
                    $is_begin = false;
                }
            }
            $InsertSQL .= " where " . DBConnector::DB_NAME . "." . $tableName . $tableName;
            $this->conn->query($InsertSQL);
        }

        public function UpdateDataAtID(string $tableName, array $attr, int $id){
            $UpdateSQL = "update " . DBConnector::DB_NAME . "." . $tableName . " set";
            {
                $is_begin = true;
                foreach ($attr as $key => $value) {
                    $UpdateSQL .= ($is_begin ? "" : ",") . " " . $key . " = " . $value;
                    $is_begin = false;
                }
            }
            $UpdateSQL .= " where " . DBConnector::DB_NAME . "." . $tableName . "ID = " . $id;
            $this->conn->query($UpdateSQL);
        }

        public function DeleteDataAtID(string $tableName, int $id){
            $DeleteSQL = "delete from " . DBConnector::DB_NAME . "." . $tableName . " where " . DBConnector::DB_NAME . "." . $tableName . "ID = " . $id; 
            $this->conn->query($DeleteSQL);
        }
    }
}