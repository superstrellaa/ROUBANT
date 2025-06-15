<?php
if (!isset($instance)) $instance = [];

$instance['BITECRAFT'] = array_merge(
    $instance['BITECRAFT'] ?? [],
    [
        "info" => [
            "name" => "Bitecraft",
            "version" => "1.0.0",
            "description" => "A custom Minecraft modpack for Bitecraft server",
            "icon" => "URL for Icon",
            "background" => "URL for Background"
        ],
        "loadder" => [
            "minecraft_version" => "1.20.1",
            "loadder_type" => "forge",
            "loadder_version" => "latest"
        ],
        "ignored" => [],
        "whitelist" => [],
        "whitelistStatus" => false,
    ]
);

$instance['DOLPHIN'] = array_merge(
    $instance['DOLPHIN'] ?? [],
    [
        "info" => [
            "name" => "Dolphin",
            "version" => "1.0.0",
            "description" => "A event of Dolphin Network",
            "icon" => "URL for Icon",
            "background" => "URL for Background"
        ],
        "loadder" => [
            "minecraft_version" => "1.20.4",
            "loadder_type" => "fabric",
            "loadder_version" => "0.15.11"
        ],
        "ignored" => [],
        "whitelist" => [],
        "whitelistStatus" => false,
    ]
);
?>