<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;

class Home extends BaseController
{
	public function index()
	{
		//return view('comment.php');
		$this->session_setting();
		$layoutModel = new LayoutModel();

        //echo $model->getLastQuery();
        //print_r($data['OBJECTIVE']);
		//$data = getDashBoardData();
		$krList = array();     // 배열 생성

		$max = 0;

		$comp = array(
			//"name" => $layoutModel->
			"obj" => $layoutModel->GetObjective($_SESSION['comp_cd'])['OBJECTIVE'],
			"krList" => $layoutModel->GetKeyResult($_SESSION['comp_cd'], '0'),
			"compKrListCnt"=>count($layoutModel->GetKeyResult($_SESSION['comp_cd'], '7'))
		);

		$dept = array(
			"obj" => $layoutModel->GetObjective($_SESSION['dept_cd'])['OBJECTIVE'],
			"krList" => $layoutModel->GetKeyResult($_SESSION['dept_cd'], '0'),
			"compKrListCnt"=>count($layoutModel->GetKeyResult($_SESSION['dept_cd'], '7'))
		);

		$team = array(
			"obj" => $layoutModel->GetObjective($_SESSION['team_cd'])['OBJECTIVE'],
			"krList" => $layoutModel->GetKeyResult($_SESSION['team_cd'], '0'),
			"compKrListCnt"=>count($layoutModel->GetKeyResult($_SESSION['team_cd'], '7'))
		);

		//krList에서 상태 : 진행중, 상태 : 완료 인것 분류하기



		//이거 있는 이유 :  원래 MAX에 맞춰서 규격 맞추려고함
		$cnt = array(
			count($comp['krList']), count($dept['krList'], count($team['krList']))
		);


		foreach ($cnt as $value){
			if($max < $value)
				$max = $value;
		}


		$dashBoardData = array(
			"comp" => $comp,
			"dept" => $dept,
			"team" => $team,
			"max" => $max

		);

		$mydata['dashBoardData'] = $dashBoardData;

		return view("index.php", $mydata);
	}
	public function session_setting(){
		$this->response = \Config\Services::response();
		$this->session = \Config\Services::session();
		$layoutModel = new LayoutModel();
		$data = $layoutModel->GetNavBarData();
        //echo $model->getLastQuery();

        $assign['admin_names'] = $data['EMP_NM'];
		$assign['team_cd'] = $data['DEPT_CD'];
		$assign['emp_email'] = $data['EMP_EMAIL'];

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


	public function sprint_list()
	{
		$this->session_setting();
		return view("/sprint/sprint_list.php");
	}

	// sprint meeting 회의록 작성
	public function sprint()
	{
		$this->Model1 = new Sprint_Meet_Model;

		$myarr = $this->Model1->search_spr_by_id(1000000);

		echo $myarr['OBJECTIVE'];
		$myarr['MEET_DT'] = date("Y-m-d", strtotime($myarr['MEET_DT']));
        echo $myarr['DEPT_NM'];
        echo $myarr['DEPT_UP_NM'];
        foreach($myarr['KR'] as $key => $bean){
            echo $bean['ID'];
			echo $bean['CONTENT'];
        }

		$mydata['myarr'] = $myarr;

		$this->session_setting();
		return view('sprint/sprint.php', $mydata);

	}

	// sprint meeting 회의록 보여주는거
	public function sprint2($id)
	{
		$this->Model1 = new Sprint_Meet_Model;

		$myarr = $this->Model1->search_spr_by_id($id);
		$myarr['MEET_DT'] = date("Y-m-d", strtotime($myarr['MEET_DT']));
		$mydata['myarr'] = $myarr;

		$this->session_setting();
		$data = $_SESSION;

		return view('/sprint/sprint2.php', $mydata);
	}



}

?>
