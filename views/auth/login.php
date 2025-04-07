<?php
     $config = include  '../../config/app.php';
     $pdo = include  '../../config/database.php';
     $appName = $config['app_name'];
     $pageTitle = 'Login';
     $title = "testing";
 
     $slot = '../components/_card-login.php';
 
     include '../../layouts/guest.php';
?>
