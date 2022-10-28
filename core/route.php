<?php
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
if(file_exists('connect.php')) include 'connect.php'; // Подключение к БД
session_start();
spl_autoload_register('myAutoLoader');
// подцепляем классы контроллеров и моделей
function myAutoLoader($className){

	[$model_name, $controller_name] = Route::getNames();

	$model_file = strtolower($model_name).'.php';
	$model_path = "models/".$model_file;
	if(file_exists($model_path))
	{
		include "models/".$model_file;
	}

	$controller_file = strtolower($controller_name).'.php';
	$controller_path = "controllers/".$controller_file;
	if(file_exists($controller_path))
	{
		include "controllers/".$controller_file;
	}
	else
	{
		/*
		правильно было бы кинуть здесь исключение,
		но для упрощения сразу сделаем редирект на страницу 404
		*/
		Route::ErrorPage404();
	}
}
class Route
{

	static function start()
	{
		
		[$model_name, $controller_name] = Route::getNames();
		$action_name = 'index';
	
		// получаем имя экшена
		if ( !empty($routes[2]) )
		{
			$action_name = $routes[2];
		}

		// добавляем префиксы
		$action_name = 'action_'.$action_name;

		$controller = new $controller_name;
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

	// получаем имя модели и имя контроллера
	static function getNames(){
		$controller_name = 'Login';
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if ( !empty($routes[1]) )
		{	
			$controller_name = $routes[1];
		}
	
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;

		return [$model_name, $controller_name];
	}
    
}
