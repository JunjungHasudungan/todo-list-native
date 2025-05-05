<?php 
    require_once '../config/database.php';
global $userId;
header('Content-Type: application/json');

 function storeProject($name, $status, $category, $description) {
     global $pdo;
     global $userId;
     $userId = $_SESSION['user_id'];
     try {
         $pdo->beginTransaction();
         $insertData = $pdo->prepare("INSERT INTO projects (name, status, category, description, user_id) VALUES (:name, :status, :category, :description, :user_id)");
         
         $insertData->execute([
             ':name' => $name,
             ':status'   => $status,
             ':category' => $category,
             ':description'  => $description,
             ':user_id'     => $userId,
         ]);

        //  $project = $pdo->lastInsertId();

         // 
         $pdo->commit();
         return ['success'   => true];
     } catch (\Exception $e) {
         $pdo->rollBack();
         return ['errors' => ['general' => $e->getMessage()]];
     }
     
 }

 function getListProject() {
    global $pdo;
    global $userId;
    $userId = $_SESSION['user_id'];
    try {
        $pdo->beginTransaction();

        $querySelectALL = $pdo->prepare("SELECT * FROM projects WHERE user_id = :userId");
        // $querySelectALL->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $querySelectALL->bindParam(':userId', $userId, PDO::PARAM_INT);
        $querySelectALL->execute();
        $projects = $querySelectALL->fetchAll();
        $pdo->commit();

        return ['success'   => true, 'data'=> $projects];
    } catch (\Exception $e) {
        $pdo->rollBack();
        return ['errors' => ['general' => $e->getMessage()]];
    }
 }
 // menangani request
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? '';
    if (in_array($action, ['store', 'update', 'edit', 'delete'])) {
    switch ($action) {
     case 'store':
         $name = $_POST['name'] ?? '';
         $status = $_POST['status'] ?? '';
         $category = $_POST['category'] ?? '';
         $description = $_POST['description'] ?? '';
         
         $result = storeProject($name, $status, $category, $description);
         echo json_encode($result);
         break;
    }
    }else {
     echo json_encode(['errors' => ['general' => 'Aksi tidak valid.']]);
    }
 }


 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $listProject = getListProject();
    echo json_encode($listProject);
 }