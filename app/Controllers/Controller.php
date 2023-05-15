<?php namespace app\Controllers;

use app\Models\DB;
use app\Helpers\Helper;
use app\Helpers\View;

class Controller
{
	protected $db;
	protected $helper;
	protected $view;
	function __construct()
	{		
		$this->db=new DB();
		$this->helper=new Helper();
		$this->view=new View();
	}

	
}
