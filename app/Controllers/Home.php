<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;

class Home extends BaseController
{
	public function index()
	{
		return view('comment.php');
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

	public function dashboard()
	{
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

	public function getDashBoardData(){
		$this->dashBoardModel=new DashBoardModel();
		//dashBoardModel->GetDashBoardData($_SESSION['admin_id']);
		$krList = array();     // 배열 생성
		$krList[0] = "첫 번째 KR입니다. 첫 번째 KR입니다. 첫 번째 KR입니다.";  // 배열 요소 추가
		$krList[1] = "두 번째 KR입니다. 두 번째 KR입니다. 두 번째 KR입니다.";
		$krList[2] = "세 번째 KR입니다. 세 번째 KR입니다. 세 번째 KR입니다.";
		$krList[3] = "네 번째 KR입니다. 네 번째 KR입니다. 네 번째 KR입니다.";

		$compObj = '지속 가능한 1조 기업 기반 완성 "축적을 통한 Scale-Up"';
		$deptObj = '"Infra"확충을 통한 一流 대원 만들기';
		$teamObj = 'OKR 축적문화 조성을 통한 1조기업의 인프라를 구축한다.';

		

		$comp = array(
			"code" => "1",
			"krList" => $krList,
			"obj" => $compObj
		);

		$dept = array(
			"code" => "2",
			"krList" => $krList,
			"obj" => $deptObj
		);

		$team = array(
			"code" => "3",
			"krList" => $krList,
			"obj" => $teamObj
		);

		//DB에서 받아온 팀코드? 구분코드? 구분짓기?
		/*
		for(int i = 0; i < 3; i++){
			switch($getData['dbCode']??){
				case ___ : dbCode = 1; //comp
				case ___ : dbCode = 2; //dept
				case ___ : dbCode = 3; //team
				default : dbcode = 0; //이상한거 넣어져있을 때
			}
		}
		*/

		$dashBoardData = array(
			"comp" => $comp,
			"dept" => $dept,
			"team" => $team
		);
		
		return $dashBoardData;
	}


}

?>
