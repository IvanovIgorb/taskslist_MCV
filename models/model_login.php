<?php
    class Model_Login extends Model
    {
        public function insertData(string $login, string $pass)
        {
            global $pdo;
            $usersListStmt = $pdo->prepare("SELECT * FROM `users` WHERE `login` = ?");
            $usersListStmt->execute([$login]);

            $data =  $usersListStmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($data) == 0){
                $query = "INSERT INTO `users` (`login`,`password`,`created_at`) VALUES (:login,:password,:date)";
                $params = [
                    ':login' => $login,
                    ':password' => $pass,
                    ':date' => date("Y/m/d") //Берется текущая дата системы
                ];
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);
            }
            if($data[0]['password'] != $pass){
                $error[] = "Неверный пароль";
            }
            
            return [$data,$error];
        }
    }
