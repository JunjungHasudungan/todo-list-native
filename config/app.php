<?php
    // pengecekan session
    if (session_status() == PHP_SESSION_NONE) {
        // melakukan start untuk session
        session_start();
    }

    return [
        'db_host'       => 'localhost',
        'db_name'       => 'todo-list-native',
        'db_password'   => '',
        'db_user'       => 'root',
        'app_name'      => 'Todo-List',
        'db_options'    => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ];
?>