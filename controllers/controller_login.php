<?php
    class Controller_Login extends Controller{

        function __construct()
        {
            $this->model = new Model_Login();
            $this->view = new View();
        }

        function action_index()
        {	
            $this->view->generate('login_view.php', 'template_view.php', $data);
        }

        function enter()
        {
            if(isset ($_POST['enter'])){ //Показывает весь список заданий
                $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
                $pass = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
                $data = $this->model->insertData($login,$pass);
                
                setcookie('user',$login, time() + 3600, "/");
                setcookie('id',$data[0]['id'], time() + 3600, "/");
                header('Location: /taskslist');
            }
        }
    }
?>