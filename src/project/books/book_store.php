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
            'title'          => $_POST ['title'         ] ?? null,
            'author_id'      => $_POST ['author_id'     ] ?? null,
            'publisher_id'   => $_POST ['publisher_id'  ] ?? null,
            'year'           => $_POST ['year'          ] ?? null,
            'isbn'           => $_POST ['isbn'          ] ?? null,
            'description'    => $_POST ['description'   ] ?? null,
            'format_ids'     => $_POST ['format_ids'    ] ?? "",
            'cover_filename' => $_FILES['cover_filename'] ?? null
        ];

        $year = date('Y');

        $rules = [
            'title'          => 'required|notempty|min:5|max:255',
            'publisher_id'   => 'required|notempty',
            'author_id'      => 'required|notempty',
            'year'           => 'required|notempty|minvalue:1900|maxvalue:' . $year,
            'isbn'           => 'required|notempty|min:13|max:13',
            'format_ids'     => 'required|notempty|array|min:1|max:4',
            'description'    => 'required|notempty|min:10',
            'cover_filename' => 'required|notempty|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
        ];

        $validator = new Validator ($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors() as $field => $fieldErrors) {
                $errors[$field] = $fieldErrors[0];
            }
            throw new Exception('Validation failed.');
        }

        $uploader = new ImageUpload();
        $coverFilename = $uploader->process($_FILES['cover_filename']);


        if (!$coverFilename) {
        throw new Exception('Failed to process and save the image.');
        }

        $book = new Book();
        $book->title          = $data['title'       ];
        $book->author         = $data['author'      ];
        $book->year           = $data['year'        ];
        $book->publisher_id   = $data['publisher_id'];
        $book->description    = $data['description' ];
        $book->isbn           = $data['isbn'        ];
        $book->cover_filename = $coverFilename;

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
    
        SetFlashMessage('success', 'Form validated successfully');
        redirect("book_list.php");
        }
        
    catch (Exception $e) {
        setFormErrors($errors);
        setFormData($data);
        SetFlashMessage('error', 'Error' . $e->getMessage());
        redirect('book_create.php');   
    }
?>