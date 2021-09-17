<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('comment.php');
	}
	public function session_setting(){
		$this->response = \Config\Services::response();
		$this->session = \Config\Services::session();
		$user_data = array(
			"admin_ids" => 'id',
			"admin_names" => '이유진',
			"emp_no" => '1234',
			"logged_in" => TRUE
		);
		$this->session->set($user_data);
	}

	public function dashboard()
	{
		$this->session_setting();
		$data = $_SESSION;
		return view("index.php",$data);
	}

	public function sprint_list()
	{
		$this->session_setting();
		$data = $_SESSION;
		return view("/sprint/sprint_list.php",$data);
	}

	public function sprint()
	{
		$this->session_setting();
		$data = $_SESSION;
		return view('/sprint/sprint123.php',$data);
	}


}

?>
