<?php
    class Book
    {
        // public properties for each database column
        public $id;
        public $title;
        public $author;
        public $publisher_id;
        public $year;
        public $isbn;
        public $description;
        public $cover_filename;

        // private $db property for database connection
        private $db;

        public function __construct($data = [])
        {
            $this->db = DB::getInstance()->getConnection();

            if (!empty($data)) {
                $this->id = $data['id']??null;
                $this->title = $data['title']??null;
                $this->author = $data['author']??null;
                $this->publisher_id = $data['publisher_id']??null;
                $this->year = $data['year']??null;
                $this->isbn = $data['isbn']??null;
                $this->description = $data['description']??null;
                $this->cover_filename = $data['cover_filename']??null;

            }
        }

        public static function findAll()
        {
        }

        public static function findById($id)
        {
        }


        public static function findByPublisher($publisherId)
        {
        }


        public function save()
        {
        }

        public function delete()
        {
        }

    
        public function toArray()
        {
        }
    }
?>