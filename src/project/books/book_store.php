<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';
require_once 'php/lib/session.php';

startSession();

try {
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $this->id,
        'title' => $this->title,
        'publisher_id' => $this->publisher_id,
        'year' => $this->year,
        'isbn' => $this->isbn,
        'description' => $this->description,
        'cover_filename' => $this->cover_filename,
    ];

    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'publisher_id' => 'required|integer',
        'year' => 'required|notempty|min:10|max:5000',
        'isbn' => 'required|array|min:1|max:10',
        'description' => 'required|notempty|min:1|max:255',
        'cover_filename' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $author = Author::findById($data['author_id']);
    if (!$author) {
        throw new Exception('Selected author does not exist.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover_filename']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    $book = new Book();
    $book->title = $data['title'];
    $book->year = $data['year'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->description = $data['description'];
    $book->isbn = $data['isbn'];
    $book->cover_filename = $imageFilename;

    $book->save();
    if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
        foreach ($data['format_ids'] as $formatId) {
            if (Format::findById($formatId)) {
                BookFormat::create($book->id, $formatId);
            }
        }
    }

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');

    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}