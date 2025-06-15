<?php

function listDirectories($dir) {
    $dirs = [];
    foreach (new DirectoryIterator($dir) as $fileInfo) {
        if ($fileInfo->isDot() || !$fileInfo->isDir()) continue;
        $dirs[] = $fileInfo->getFilename();
    }
    return $dirs;
}

function scanFiles($basePath, $publicPrefix) {
    $result = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($basePath, FilesystemIterator::SKIP_DOTS)
    );
    foreach ($iterator as $file) {
        if (!$file->isFile()) continue;
        $relativePath = ltrim(str_replace($basePath, '', $file->getPathname()), DIRECTORY_SEPARATOR);
        $url = sprintf(
            "%s://%s%s/%s",
            (!empty($_SERVER['HTTPS']) ? 'https' : 'http'),
            $_SERVER['HTTP_HOST'],
            $publicPrefix,
            str_replace(DIRECTORY_SEPARATOR, '/', $relativePath)
        );
        $result[] = [
            'url' => $url,
            'size' => $file->getSize(),
            'hash' => sha1_file($file->getPathname()),
            'path' => str_replace(DIRECTORY_SEPARATOR, '/', $relativePath)
        ];
    }
    return json_encode($result, JSON_UNESCAPED_SLASHES);
}
?>