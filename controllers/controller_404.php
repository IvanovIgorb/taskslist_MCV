<?php
    namespace Task_List_MVC\Controllers;
    use Task_List_MVC\Core\Controller;
    use Task_List_MVC\Core\View;

class Controller_404 extends Controller
{
	
	function action_index()
	{
		$this->view->generate('404_view.php', 'template_view.php');
	}

}
