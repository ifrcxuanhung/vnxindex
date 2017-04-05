<?php
include_once "model/first_model.php";
include_once "block_controller.php";
Class Home_Controller
{
    protected $first_model;
	protected $block;
    Public function __construct()
	{
		$this->first_model = new First_Model();
        $this->block = new Block_Controller();
	}

	public function index()
	{
		include("view/home/index.php");
	}
	
	public function detail()
	{
		
		echo 'Controller : Home<br/>';
		echo 'Action : detail<br/>';
		include("view/home/detail.php");
	}
}  