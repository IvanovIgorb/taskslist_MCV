<?php
    if(file_exists('connect.php')) include 'connect.php'; // Подключение к БД
    class Model_Taskslist extends Model{
        function getItemsFromDB(){
            global $pdo;
    
            $taskListStmt = $pdo->prepare("SELECT * FROM `tasks` WHERE `user_id` = ?");
            $taskListStmt->execute([$_COOKIE['id']]); 
            $taskListStmt->setFetchMode(PDO::FETCH_ASSOC); //Устанавливаем режим выборки
            $data = $taskListStmt;
    
            return $data;
        }

        function clearDB(){
            global $pdo;
    
            $query = "DELETE FROM `tasks` WHERE `user_id` = ?";
            $params = [$_COOKIE['id']];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function addInDB(){
            global $pdo;
    
            $query = "SELECT * FROM `tasks` WHERE `description` = :description AND `user_id` = :id";
            $params = [
                ':description' => $_POST['task'],
                ':id' => $_COOKIE['id']
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
    
            $data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if(count($data) == 0){
                $date = date("Y/m/d");
                $query = "INSERT INTO `tasks` (`user_id`,`description`,`created_at`,`status`) VALUES (:id,:description,:date,:status)";
                $params = [
                ':id' => $_COOKIE['id'],
                ':description' => $_POST['task'],
                ':date' => $date,
                ':status' => 0,
                ];
                $stmt = $pdo->prepare($query);
                $stmt->execute($params); 
            }
        }
    
        function changeStatusReadyInDB(){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `id` = :id";
            $params = [
                ':status' => 1,
                ':id' => $_POST['id']
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function changeStatusUnreadyInDB(){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `id` = :id";
            $params = [
                ':status' => 0,
                ':id' => $_POST['id']
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function changeStatusAllReadyInDB(){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `user_id` = :id";
            $params = [
                ':status' => 1,
                ':id' => $_COOKIE['id']
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function deleteFromDB(){
            global $pdo;
    
            $query = "DELETE FROM `tasks` WHERE `id` = ?";
            $params = [$_POST['id']];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    }
?>