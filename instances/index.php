<?php
header("Content-Type: application/json; charset=UTF-8");
require_once __DIR__ . '/php/fileScanner.php';

$instance = $_GET['instance'] ?? null;

if ($instance === null) {
    $folders = listDirectories(__DIR__ . '/public');
    $result = [];
    foreach ($folders as $name) {
        $url = sprintf(
            "%s://%s%s?instance=%s",
            (!empty($_SERVER['HTTPS']) ? 'https' : 'http'),
            $_SERVER['HTTP_HOST'],
            strtok($_SERVER['REQUEST_URI'], '?'),
            urlencode($name)
        );
        $result[$name] = ['name' => $name, 'url' => $url];
    }
    require_once __DIR__ . '/php/public.php';

    foreach ($result as $name => &$data) {
        if (isset($instance[$name])) {
            $data = array_merge($data, $instance[$name]);
        }
    }
    unset($data);

    echo json_encode($result, JSON_UNESCAPED_SLASHES);
    exit;
}

if ($instance === '/' || strpos($instance, '.') === 0) {
    echo json_encode([]);
    exit;
}

$publicPath = __DIR__ . '/public/' . $instance;
if (!is_dir($publicPath)) {
    echo json_encode([]);
    exit;
}

echo scanFiles($publicPath, "/instances/public/$instance");
?>