<?php
     $config = include  '../../config/app.php';
     $pdo = include  '../../config/database.php';
     require_once __DIR__ . '/../../config/csrf.php';
     $appName = $config['app_name'];
     $pageTitle = 'Register';
     $slot = '../components/_card-register.php';
 
     include '../../layouts/guest.php';
?>
