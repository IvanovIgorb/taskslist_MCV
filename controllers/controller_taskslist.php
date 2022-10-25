<?php
    session_start();
    class Controller_Taskslist extends Controller{
        
        function __construct()
        {
            $this->model = new Model_Taskslist();
            $this->view = new View();
        }

        function handle(){
            if(isset ($_POST['remove'])){ //Очищает весь список заданий
                $this->model->clearDB($_SESSION['id']);
            }
            if(isset ($_POST['add'])){ //Добавление задания
                if(!empty($_POST['task'])){ //Проверка на пустое задание
                    $this->model->addInDB($_POST['task'],$_SESSION['id']);
                }
            }

            if(isset ($_POST['ready'])){ //Меняет статус задания с "Не готово" на "Выполнено"
                $this->model->changeStatusReadyInDB($_POST['id']);
            }

            if(isset ($_POST['unready'])){  //Меняет статус задания с "Выполнено" на "Не готово"
                $this->model->changeStatusUnreadyInDB($_POST['id']);
            }

            if(isset ($_POST['readyall'])){ //Все задания в списке отмечаются выполненными
                $this->model->changeStatusAllReadyInDB($_SESSION['id']);
            }

            if(isset ($_POST['delete'])){ //Удаляет блок с текущим заданием из списка
                $this->model->deleteFromDB($_POST['id']);
            }

        }
        
        function action_index()
        {
            $this->handle();
            $items = $this->model->getItemsFromDB($_SESSION['id']);
            $this->view->generate('taskslist_view.php', 'template_view.php', $items);
        }

    }
