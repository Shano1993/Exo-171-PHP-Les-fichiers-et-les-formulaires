<?php

function getRandomName(string $regularName): string {
    $infos = pathinfo($regularName);
    try {
        $bytes = random_bytes(15);
    }
    catch (Exception $exception) {
        $bytes = openssl_random_pseudo_bytes(15);
    }
    return bin2hex($bytes) . '.' . $infos['extension'];
}

if (isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === 0) {
        $allowedMimeTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg', 'image/tif', 'image/webp'];
        if (in_array($_FILES['file']['type'], $allowedMimeTypes)) {
            $maxSize = 3 * 1024 * 1024; // Max = 3Mo
            if ((int)$_FILES['file']['size'] <= $maxSize) {
                $tmp_name = $_FILES['file']['tmp_name'];
                $name = getRandomName($_FILES['file']['name']);
                if (!is_dir('upload')) {
                    mkdir('upload', '0755');
                }
                move_uploaded_file($tmp_name, 'upload/' . $name);
            }
            else {
                header('Location: /index.php?error=0');
            }
        }
        else {
            header('Location: /index.php?error=1');
        }
    }
}
else {
    header('Location: /index.php?error=2');
}



