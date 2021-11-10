<?php

namespace App\Controllers;

use App\Models\OKR_Case_Model;
use App\Models\LayoutModel;

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

    public function get_okr_list_depts()
    {
        $layoutModel = new LayoutModel();
        $temp = $layoutModel->GetNavBarData();
        $myData['DEPT_CD'] = $temp['DEPT_CD'];

        $temp = $layoutModel->GetDeptCode($myData['DEPT_CD']);
        $myData['DEPT_NM'] = $temp['DEPT_NM'];
        $myData['DEPT_UP_CD'] = $temp['DEPT_UP_CD'];

        $temp = $layoutModel->GetDeptCode($myData['DEPT_UP_CD']);
        $myData['DEPT_UP_NM'] = $temp['DEPT_NM'];
        $myData['COMP_CD'] = $temp['DEPT_UP_CD'];

        $temp = $layoutModel->GetDeptCode($myData['COMP_CD']);
        $myData['COMP_NM'] = $temp['DEPT_NM'];

        $arr = array(
            'id' => $myData['DEPT_CD'],
            'text' => $myData['DEPT_NM'],
            'parent' => '#',
            'children' => true,
            'type' => 'root'
        );

        $arr2 = array(
            'id' => $myData['DEPT_UP_CD'],
            'text' => $myData['DEPT_UP_NM'],
            'parent' => '#',
            'children' => true,
            'type' => 'root'
        );

        $arr3 = array(
            'id' => $myData['COMP_CD'],
            'text' => $myData['COMP_NM'],
            'parent' => '#',
            'children' => true,
            'type' => 'root'
        );

        $result = array($arr, $arr2, $arr3);
        $output = json_encode($result, JSON_UNESCAPED_UNICODE);

        return $output;
    }

    public function get_okr_list_year($dept_cd) {
        
        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_okr_year($dept_cd);

        $result = array();
        foreach($data as $key => $value) {
            array_push($result, [
                'id' => strval($value),
                'text' => strval($value),
                'parent' => $dept_cd,
                'type' => 'year',
                'children' => true
            ]);
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function get_okr_list_quarter($dept_cd, $year) {
        
        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_okr_quarter($dept_cd, $year);

        $result = array();
        foreach($data as $key => $value) {
            array_push($result, [
                'id' => strval($value),
                'text' => strval($value),
                'parent' => $year,
                'type' => 'quarter',
                'children' => true
            ]);
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

}

?>
