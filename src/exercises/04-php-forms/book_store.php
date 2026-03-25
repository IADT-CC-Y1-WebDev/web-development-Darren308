<?php
    require_once './lib/config.php';
    require_once './lib/session.php';
    require_once './lib/forms.php';
    require_once './lib/utils.php';

    $data = [];
    $errors = [];

    // Start the session
    startSession();

    try {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method.');
        }

        $data = [
            'title' => $_POST['title'] ?? null,
            'author' => $_POST['author'] ?? null,
            'publisher_id' => $_POST['publisher_id'] ?? null,
            'year' => $_POST['year'] ?? null,
            'isbn' => $_POST['isbn'] ?? null,
            'description' => $_POST['description'] ?? null,
            'format_ids' => $_POST['format_ids'] ?? null,
            'cover' => $_FILES['cover'] ?? null
        ];
        $year = date('Y');
        $rules = [
            'title' => 'required|notempty|min:5|max:255',
            'author' => 'required|notempty|min:1|max:255',
            'publisher_id' => 'required|notempty|integer',
            'year' => 'required|notempty|minvalue:1900|maxvalue:' . $year,
            'isbn' => 'required|notempty|min:13|max:13',
            'format_ids' => 'required|notempty|array|min:1|max:4',
            'description' => 'required|notempty|min:10',
            'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
        ];
        $validator = new Validator ($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors() as $field => $fieldErrors) {
                $errors[$field] = $fieldErrors[0];
            }
            throw new Exception('Validation failed.');
        }

        $uploader = new ImageUpload();
        $imageFilename = $uploader->process($_FILES['cover']);

        clearFormData();
        clearFormErrors();
        SetFlashMessage('success', 'Form validated successfully');
        redirect("success.php");
        }
        
    catch (Exception $e) {

        setFormErrors($errors);
        setFormData($data);
        SetFlashMessage('error', 'Form validation failed');
        redirect('book_create.php');   
    }
?>