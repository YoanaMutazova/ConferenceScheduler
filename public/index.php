<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

require_once '../app/includes/config.php';
require_once '../app/init.php';
require_once '../app/core/Database.php';
require_once '../app/includes/DatabaseConfig.php';

Database::setInstance(
    \DatabaseConfig::DB_INSTANCE,
    \DatabaseConfig::DB_DRIVER,
    \DatabaseConfig::DB_USER,
    \DatabaseConfig::DB_PASS,
    \DatabaseConfig::DB_NAME,
    \DatabaseConfig::DB_HOST
);

$app = new App;