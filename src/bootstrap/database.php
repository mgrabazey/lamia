<?php

use Shop\Config\Database;

$config = Database::instance();
$conn = new PDO(
    "mysql:host={$config->host};port={$config->post};dbname={$config->name}",
    $config->user,
    $config->pass
);
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

return $conn;
