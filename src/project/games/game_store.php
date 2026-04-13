<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'release_date' => $_POST['release_date'] ?? null,
        'genre_id' => $_POST['genre_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'release_date' => 'required|notempty',
        'genre_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'platform_ids' => 'required|array|min:1|max:10',
        'image' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $genre = Genre::findById($data['genre_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['image']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    $game = new Game();
    $game->title = $data['title'];
    $game->release_date = $data['release_date'];
    $game->genre_id = $data['genre_id'];
    $game->description = $data['description'];
    $game->image_filename = $imageFilename;

    $game->save();
    if (!empty($data['platform_ids']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            if (Platform::findById($platformId)) {
                GamePlatform::create($game->id, $platformId);
            }
        }
    }

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Game stored successfully.');

    redirect('game_view.php?id=' . $game->id);
}
catch (Exception $e) {
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('game_create.php');
}
