<?php namespace app\Controllers\Dashboard;

use app\Models\DB;
use app\Helpers\Helper;
use app\Helpers\View;
use app\Models\Custom;

class Controller
{
	protected $db;
	protected $helper;
	protected $view;
	protected $custom;
	function __construct()
	{		
		$this->db=new DB();
		$this->helper=new Helper();
		$this->view=new View();
		$this->custom=new Custom();
	}

	
}
