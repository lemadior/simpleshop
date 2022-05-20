<?php
	namespace application\core;
	
	class Page
	{
		private $layout;
		private $title;
		private $view;
		private $data;
		private $hideButtons; // {wrapper | hide}
		private $headerTitle;

		public function __construct($view, $title = '', $hide = 'wrapper', $header = '', $layout = 'default', $data = null)
		{
			$this->layout = $layout;
			$this->title  = $title;
			$this->view   = $view;
			$this->data   = $data;
			$this->hideButtons = $hide;
			$this->headerTitle = $header;
		}
		
		public function __get($property)
		{
			return $this->$property;
		}

		public function __set($property, $value)
		{
		    $this->$property = $value;
		}

	}
