<?php

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';

if(file_exists('connect.php')) include 'connect.php'; // Подключение к БД
session_start();
spl_autoload_register('myAutoLoader');
// подцепляем классы контроллеров и моделей
function myAutoLoader($className){
	$model_file = strtolower($className).'.php';
	$model_path = "models/".$model_file;
	if(file_exists($model_path))
	{
		include "models/".$model_file;
	}

	$controller_file = strtolower($className).'.php';
	$controller_path = "controllers/".$controller_file;
	if(file_exists($controller_path))
	{
		include "controllers/".$controller_file;
	}
}

/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
?>