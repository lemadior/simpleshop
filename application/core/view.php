<?php

namespace application\core;

use application\core\Page;
use application\core\Error;
use application\exceptions\Exception_Route;

class View
{

	public function render(Page $page) {
		try {
			echo $this->renderLayout($page, $this->renderView($page));
		} catch (Exception_Route $err) {
			$err->Error404($err->getMessage());
		}
	}

	private function renderLayout(Page $page, $content) {

		$layoutPath = $_SERVER['DOCUMENT_ROOT'] . "/application/layouts/{$page->getLayout()}.php";
		
		// Make visible div with error message
		$errorVisible = 'hide';

		// Error message
		$error='';

		// Template for header's buttons
		$btpl = Settings::getTemplate('hdr_buttons');

		// Here variables may contanis data to put custom css and scripts
		$pagestyle ='';
		$pagescript = '';


		if (file_exists($layoutPath)) {
			ob_start();
			$title = $page->getPageTitle();
			$headerTitle = $page->getHeader()->getTitle();
			
			$headerButtonsState = $page->getHeader()->getButtonsState();
			$headerButtons = '';

			foreach ($page->getHeader()->getButtons() as $button) {
				$btn = str_replace("%ID%", $button->getId(), $btpl);
				$btn = str_replace("%NAME%", $button->getName(), $btn);
				$btn = str_replace("%ACTION%", $button->getAction(), $btn);
				$headerButtons .= $btn;
			}

			if (!empty($page->getStyle())) {
				$pagestyle = '<link rel="stylesheet" type="text/css" href="'. $page->getStyle() . '">';
			}

			if (!empty($page->getScript())) {
				$pagescript = '<script  type="text/javascript" src="' . $page->getScript() . '"></script>';
			}

			if (Error::isError()) {
				$errorVisible = 'error';
				$error = Error::getError();			
			}
			
			include $layoutPath;
			return ob_get_clean();
		} else {
			throw new Exception_Route('Cannot find layout file : ' . $layoutPath, 3);
		}
	}

	private function renderView(Page $page) {
	    if ($page->getView()) {
			
			$viewPath = $_SERVER['DOCUMENT_ROOT'] . "/application/views/{$page->getView()}.php";
			
			if (file_exists($viewPath)) {
				ob_start();
				$data = $page->getData();

				if (!empty($data)) {
					if (is_array($data)) {
						extract($data);
					}
				}
			
				include $viewPath;
				return ob_get_clean();
			} else {
				throw new Exception_Route('Cannot find view file : ' . $layoutPath, 4);
			}
	    }
	}

}

