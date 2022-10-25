<?php
namespace Task_List_MVC\Core;
use Task_List_MVC\Models\Model_Login;
use Task_List_MVC\Controllers\Controller_Login;
use Task_List_MVC\Models\Model_TasksList;
use Task_List_MVC\Controllers\Controller_TasksList;
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{
	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'Login';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
		
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;

		/*
		echo "Model: $model_name <br>";
		echo "Controller: $controller_name <br>";
		echo "Action: $action_name <br>";
		*/
		print($controller_name);
		// подцепляем файл с классом модели (файла модели может и не быть)

		//Пытался так подключить классы, но выдает include_once(Task_List_MVC/Controllers/Controller_Taskslist.php): failed to open stream: No such file or directory

		 spl_autoload_register(function($className) {
		 	include_once str_replace('\\','/',$className).'.php';
		 });

		// $model_file = strtolower($model_name).'.php';
		// $model_path = "models/".$model_file;
		// if(file_exists($model_path))
		// {
		// 	include "models/".$model_file;
		// }

		// // подцепляем файл с классом контроллера
		// $controller_file = strtolower($controller_name).'.php';
		// $controller_path = "controllers/".$controller_file;
		// if(file_exists($controller_path))
		// {
		// 	include "controllers/".$controller_file;
		// }
		// else
		// {
		// 	/*
		// 	правильно было бы кинуть здесь исключение,
		// 	но для упрощения сразу сделаем редирект на страницу 404
		// 	*/
		// 	Route::ErrorPage404();
		// }
		
		//Ну и тут беды с генерированием контроллера, так удается отрывать хоть что-то, но не знаю, как сделать универсально
		$controller = new \Task_List_MVC\Controllers\Controller_Taskslist;

		$action = $action_name;
		
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
