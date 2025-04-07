<?php
session_start();
session_unset();
session_destroy(); // Hapus semua sesi
header("Location: /todo-list-native/index.php"); // kembali kehalaman index
exit;