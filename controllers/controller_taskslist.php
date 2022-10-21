<?php
    class Controller_Taskslist extends Controller{
        
        function __construct()
        {
            $this->model = new Model_Taskslist();
            $this->view = new View();
        }
        
        function action_index()
        {
            $items = $this->model->getItemsFromDB();		
            $this->view->generate('taskslist_view.php', 'template_view.php', $items);
        }

        function handle(){
            if(isset ($_POST['show'])){ //Показывает весь список заданий
                draw();
            }
            if(isset ($_POST['remove'])){ //Очищает весь список заданий
                $this->model->clearDB();
            }
            if(isset ($_POST['add'])){ //Добавление задания
                if(!empty($_POST['task'])){ //Проверка на пустое задание
                    $this->model->addInDB();
                }
                draw();
            }
            
            if(isset ($_POST['ready'])){ //Меняет статус задания с "Не готово" на "Выполнено"
                $this->model->changeStatusReadyInDB();

                draw();
            }
            if(isset ($_POST['unready'])){  //Меняет статус задания с "Выполнено" на "Не готово"
                $this->model->changeStatusUnreadyInDB();

                draw();
            }
            if(isset ($_POST['readyall'])){ //Все задания в списке отмечаются выполненными
                $this->model->changeStatusAllReadyInDB();
                draw();
            }
            if(isset ($_POST['delete'])){ //Удаляет блок с текущим заданием из списка
                $this->model->deleteFromDB();
                draw();
            }
        }

    }
?>