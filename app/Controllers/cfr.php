<?php

namespace App\Controllers;

use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;

class cfr extends BaseController
{
	public function index()
    {   
        $this->session_setting();
        return view("/cfr/cfrMainView.php");
    }


    public function session_setting(){
		$this->response = \Config\Services::response();
		$this->session = \Config\Services::session();
		$layoutModel = new LayoutModel();
		$data = $layoutModel->GetNavBarData();

		date_default_timezone_set('Asia/Seoul');
        $YEAR = date("Y", time());
        $QTR = ceil(date("m") / 3);
        //echo $model->getLastQuery();

        $assign['admin_names'] = $data['EMP_NM'];
		$assign['team_cd'] = $data['DEPT_CD'];
		$assign['emp_email'] = $data['EMP_EMAIL'];
		$assign['emp_no'] = $data['EMP_NO'];

		//팀코드로 검색
		$temp = $layoutModel->GetDeptCode($assign['team_cd']);

		$assign['dept_cd'] = $temp['DEPT_UP_CD'];
		$assign['team_nm'] = $temp['DEPT_NM'];

		//부문코드로 검색
		$temp = $layoutModel->GetDeptCode($assign['dept_cd']);

		$assign['comp_cd'] = $temp['DEPT_UP_CD'];
		$assign['dept_nm'] =  $temp['DEPT_NM'];

		//회사코드로 검색
		$temp = $layoutModel->GetDeptCode($assign['comp_cd']);
		$assign['comp_nm'] =  $temp['DEPT_NM'];


		//++ 추가해야 할 사항 : 부문에만 속한사람, 회사에만 속한사람 분류 어떻게 할 지 생각하기

		/*
		$user_data = array(
			"admin_ids" => 'id',
			"admin_names" => '이유진',
			"emp_no" => '1234',
			"logged_in" => TRUE
		);
		*/
		$this->session->set($assign);
	}

}

?>
