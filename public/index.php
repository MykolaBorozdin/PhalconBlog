<?php
try {
    
define('APP_PATH', __DIR__ . '/../');
require_once APP_PATH.'app/AppRunner.php';
    $appRunner = new AppRunner();
    $appRunner->run();
    
} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}
?>