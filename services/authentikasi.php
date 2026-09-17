<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


function login(PDO $pdo, array $data) {
    try {
         // validasi inputan email sudah dipakai atau belum
        $stmt = $pdo->prepare("SELECT id, name, email, password  FROM users WHERE email = :email LIMIT 1");

        $stmt->execute([
            ":email" => $data['email']
        ]);
        
        $user = $stmt->fetch();

        if ($user) {
            http_response_code(422);

            echo json_encode([
                "success" => false,
                "message" => "Email sudah digunakan",
            ]);

            exit;
        }
        //mengirim data 
        $query = "INSERT INTO users (name, email, password) VALUES 
            (:name, :email, :password)";

            $stmt = $pdo->prepare($query);

            $stmt->execute([
                ":name" => $data["name"],
                ":email" => $data["email"],
                ":password" => password_hash(
                    $data["password"],
                    PASSWORD_DEFAULT
            )
        ]);

        echo json_encode([
            'message'   => 'berhasil register',
            'user'  => $user
        ],200);
    } catch (\Throwable $th) {
        echo json_encode([
            "success" => false,
            "message" => $th->getMessage()
        ], 500);
    }
}

login($pdo, $data);
