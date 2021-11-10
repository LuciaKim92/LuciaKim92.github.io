<?php

namespace App\Controllers;

use App\Models\OKR_Case_Model;

class CaseController extends BaseController
{

    //세션세팅 (임시)
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
        return view("/case/case_list.php", array());
    }

	public function get_exm_cases()
	{
		$this->session_setting();

		$draw = $_POST['draw'];
		$EMPY_NO = $_SESSION['emp_no'];
		$IS_CLIP = $_POST['IS_CLIP'];

        $params = array(
            array($EMPY_NO,SQLSRV_PARAM_IN),
            array($IS_CLIP,SQLSRV_PARAM_IN)
        );

		$this->Model = new OKR_Case_Model;
        $data = $this->Model->get_exm_cases($params);

		$output = array(
			"draw" => intval($draw),
			"recordsTotal" => sizeof($data),
			"recordsFiltered" => sizeof($data),
			"data" => $data
		 );

		$result = json_encode($output, JSON_UNESCAPED_UNICODE);

        return $result;
	}

    public function case_detail($ID)
    {
        $this->session_setting();

        $params = array(
            array($ID,SQLSRV_PARAM_IN)
        );

        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_exm_details($params);

        return view("/case/case_detail.php", $data);
    }

    public function case_write()
    {
        $this->session_setting();
        return view("/case/case_write.php");
    }

}

?>
