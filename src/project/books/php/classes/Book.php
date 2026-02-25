<?php
class Book {
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;
    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->author = $data['author'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->year = $data['year'] ?? null;
            $this->isbn = $data['isbn'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->cover_filename = $data['cover_filename'] ?? null;
        }
    }

    public function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }
        return $books;
    }

    public function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new Book($row);
        }
    }

    public function save()
    {
        if ($this->id) {
            $stmt = $this->db->prepare("UPDATE books
                SET title = :title,
                author = :author,
                publisher_id = :publisher_id,
                year = :year,
                isbn = :isbn,
                description = :description,
                cover_filename = :cover_filename
                WHERE id = :id
            ");

            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
            ];
        } else {
            $stmt = $this->db->prepare("INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");

            $params = [
                'id' => $this->id,
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
            ];
        }

        $status = $stmt->execute($params);

        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %s; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);
        }

        // Ensure one row affected
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public function update(){
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute(['id' => 1]);

            $book = $stmt->fetch();
             if ($book) {
                echo "Found: " . $book['title'] . "<br/>";
            } else {
                echo "Book not found" . "<br/>";
            }

            $stmt = $db->prepare("UPDATE books
            SET description = :description
            WHERE id = :id
            ");


            $stmt->execute([
                'description' => 'Updated description text.' . time(),
                'id' => 1
            ]);

            echo "Updated " . $stmt->rowCount() . " row(s)" . "<br/>";
            $book = $stmt->fetch();

            if ($book) {
                echo $book;
            } else{
                echo "Not Updated";
            }
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }
}