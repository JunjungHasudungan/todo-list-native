<?php
     $config = include  '../../config/app.php';
     $pdo = include  '../../config/database.php';
     $appName = $config['app_name'];
     $pageTitle = 'Register';
     $title = "testing";
 
     $slot = '../components/_card-register.php';
 
     include '../../layouts/guest.php';
?>
