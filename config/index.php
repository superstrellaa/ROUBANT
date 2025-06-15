<?php
header("Content-Type: application/json; charset=UTF-8");

$configDir = __DIR__ . '/files';
$files = [];
$allowed = ['launcher.json', 'modules.json', 'style.json', 'user-defaults.json'];

foreach ($allowed as $filename) {
    $fullPath = $configDir . DIRECTORY_SEPARATOR . $filename;
    if (is_file($fullPath)) {
        $files[] = [
            'name' => $filename,
            'url' => sprintf(
                "%s://%s/config/files/%s",
                (!empty($_SERVER['HTTPS']) ? 'https' : 'http'),
                $_SERVER['HTTP_HOST'],
                $filename
            ),
            'size' => filesize($fullPath),
            'hash' => sha1_file($fullPath)
        ];
    }
}

echo json_encode($files, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>