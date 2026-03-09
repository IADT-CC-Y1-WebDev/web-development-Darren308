<?php

    require_once 'php/lib/config.php';
    require_once 'php/lib/session.php';
    require_once 'php/lib/forms.php';
    require_once 'php/lib/utils.php';

    $data = [];
    $errors = [];

    startSession();

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method.');
        }
        $data = [
            'title' => $_POST['title'] ?? null,
            'publisher_id' => $_POST['publisher_id'] ?? null,
            'year' => $_POST['year'] ?? null,
            'isbn' => $_POST['isbn'] ?? null,
            'description' => $_POST['description'] ?? null,
            'format_ids' => $_POST['format_ids'] ?? null,
            'cover_filename' => $_FILES['cover_filename'] ?? null
        ];
        $year = date('Y');
        $rules = [
            'title' => 'required|notempty|min:5|max:255',
            'publisher_id' => 'required|notempty|integer',
            'year' => 'required|notempty|minvalue:1900|maxvalue:' . $year,
            'isbn' => 'required|notempty|min:13|max:13',
            'format_ids' => 'required|notempty|array|min:1|max:4',
            'description' => 'required|notempty|min:10',
            'cover_filename' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
        ];

        $validator = new Validator ($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors() as $field => $fieldErrors) {
                $errors[$field] = $fieldErrors[0];
            }
            throw new Exception('Validation failed.');
        }

        $uploader = new ImageUpload();
        $imageFilename = $uploader->process($_FILES['cover_filename']);

        clearFormData();
        clearFormErrors();
    
        SetFlashMessage('success', 'Form validated successfully');
        redirect("book_list.php");
        }
        
    catch (Exception $e) {
        setFormErrors($errors);
        setFormData($data);
        SetFlashMessage('error', 'Form validation failed');
        redirect('book_create.php');   
    }
?>