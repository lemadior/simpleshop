<?php

namespace application\core;

use application\core\Page;
use application\core\Error;

class View
{

	public function render(Page $page) {
		echo $this->renderLayout($page, $this->renderView($page));
	}

	private function renderLayout(Page $page, $content) {
		$layoutPath = $_SERVER['DOCUMENT_ROOT'] . "/application/layouts/{$page->layout}.php";

		if (file_exists($layoutPath)) {
			ob_start();
			$title = $page->title;
			$headerTitle = $page->headerTitle;
			$headerButtons = $page->hideButtons;
			//Error::setError('The test error');
			$error = Error::showError();			

			include $layoutPath;
			return ob_get_clean();
		} else {
			 Error::ErrorPage404("Не найден файл с лейаутом по пути $layoutPath"); 
		}
	}

	private function renderView(Page $page) {
	    if ($page->view) {
		$viewPath = $_SERVER['DOCUMENT_ROOT'] . "/application/views/{$page->view}.php";
		if (file_exists($viewPath)) {
			ob_start();
			$data = $page->data;
			if (!empty($data)) {
			    if (is_array($data)) {
					extract($data);
			    }
			}
		
			include $viewPath;
			return ob_get_clean();
		} else {
			Error::ErrorPage404("Не найден файл с представлением по пути $viewPath");
		}
	    }
	}

    function generate($content_view, $template_view, $data = null)
    {
        // if (is_array($data)) {
        //     extract($data);
        // }

        include 'application/views/' . $template_view;
    }
}

