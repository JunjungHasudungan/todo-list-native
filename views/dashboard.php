<?php
     $config = include  '../config/app.php';
     $pdo = include  '../config/database.php';
     $appName = $config['app_name'];
     $pageTitle = 'Dashboard';
 
     // $slot = './components/_card-dashboard.php';
     include  '../layouts/app.php';
?>
