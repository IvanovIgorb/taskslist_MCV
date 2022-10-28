<?php

    class Model_Taskslist extends Model{
        function getItemsFromDB($userId){
            global $pdo;
    
            $taskListStmt = $pdo->prepare("SELECT * FROM `tasks` WHERE `user_id` = ?");
            $taskListStmt->execute([$userId]);
            $taskListStmt->setFetchMode(PDO::FETCH_ASSOC); //Устанавливаем режим выборки
            $data = $taskListStmt->fetchAll();
            return $data;
        }

        function clearDB($userId){
            global $pdo;
    
            $query = "DELETE FROM `tasks` WHERE `user_id` = ?";
            $params = [$userId];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function addInDB($taskValue,$userId){
            global $pdo;
    
            $query = "SELECT * FROM `tasks` WHERE `description` = :description AND `user_id` = :id";
            $params = [
                ':description' => $taskValue,
                ':id' => $userId
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
    
            $data =  $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            if(count($data) == 0){
                $date = date("Y/m/d");
                $query = "INSERT INTO `tasks` (`user_id`,`description`,`created_at`,`status`) VALUES (:id,:description,:date,:status)";
                $params = [
                ':id' => $userId,
                ':description' => $taskValue,
                ':date' => $date,
                ':status' => 0,
                ];
                $stmt = $pdo->prepare($query);
                $stmt->execute($params); 
            }
        }
    
        function changeStatusReadyInDB($taskId){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `id` = :id";
            $params = [
                ':status' => 1,
                ':id' => $taskId
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function changeStatusUnreadyInDB($taskId){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `id` = :id";
            $params = [
                ':status' => 0,
                ':id' => $taskId
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function changeStatusAllReadyInDB($userId){
            global $pdo;
    
            $query = "UPDATE `tasks` SET `status` = :status WHERE `user_id` = :id";
            $params = [
                ':status' => 1,
                ':id' => $userId
            ];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    
        function deleteFromDB($taskId){
            global $pdo;
    
            $query = "DELETE FROM `tasks` WHERE `id` = ?";
            $params = [$taskId];
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
        }
    }
?>