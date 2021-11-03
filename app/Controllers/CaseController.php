<?php

namespace App\Controllers;

class CaseController extends BaseController
{
    //세션세팅
    public function session_setting(){
		$this->response = \Config\Services::response();
		$this->session = \Config\Services::session();
		$user_data = array(
			"admin_ids" => 123123,
			"admin_names" => '이유진',
			"emp_no" => 'P221002',
			"logged_in" => TRUE
		);
		$this->session->set($user_data);
	}

	public function index()
    {
        $this->session_setting();
        return view("/case/case_list.php");
    }

}

?>
