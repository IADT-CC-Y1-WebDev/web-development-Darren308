<?php

    class ImageUpload {
        private $targetDir;

        public function __construct($targetDir = null) {
            if ($targetDir === null) {
                $this->targetDir = dirname(__DIR__) . '../images/';
            } else {
                $this->targetDir = $targetDir;
            }

            if (!is_dir($this->targetDir)) {
                mkdir($this->targetDir, 0755, true);
            }
        }

        public function process($file, $existingFilename = null) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);

            $extension = $this->getExtensionFromMimeType($mimeType);
            $filename = $this->generateUniqueFilename($extension);
            $targetPath = $this->targetDir . $filename;

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                return false;
            }

            if ($existingFilename && $existingFilename !== $filename) {
                $this->deleteImage($existingFilename);
            }

            return $filename;
        }

        public function hasFile($key) {
            return isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK;
        }

        public function deleteImage($filename) {
            if (empty($filename)) {
                return true;
            }

            $filePath = $this->targetDir . $filename;
            if (file_exists($filePath)) {
                return unlink($filePath);
            }

            return true;
        }

        private function generateUniqueFilename($extension) {
            do {
                $filename = uniqid('game_', true) . '.' . $extension;
                $filePath = $this->targetDir . $filename;
            } while (file_exists($filePath));

            return $filename;
        }

        private function getExtensionFromMimeType($mimeType) {
            switch ($mimeType) {
                case 'image/jpeg':
                case 'image/jpg':
                    return 'jpg';
                case 'image/png':
                    return 'png';
                default:
                    return 'jpg';
            }
        }
    }
?>