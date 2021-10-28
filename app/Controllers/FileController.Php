<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;

class FileController extends BaseController
{
	public function index()
	{
		return view("/fileTest/file.php");
	}
    public function fileUpload(){
        

        $file = $this->request->getFile("test_file");
        $fileInfo = []; // (2)
        if ($file != null) { // (3)
            if (!$file->isValid()) { // (4)
                $errorString = $file->getErrorString(); // (5)
                $errorCode = $file->getError(); // (6)

                $fileInfo['hasError'] = true; // (7)
                $fileInfo['errorString'] = $errorString;
                $fileInfo['errorCode'] = $errorCode;

            } else {  // (8)
                $fileInfo['hasError'] = false;
                if ($file->hasMoved() === false) {  // (9)                
                    $fileInfo['mimeType'] = $file->getMimeType();  // (10)

                    $savedPath = $file->store(); // (11)

                    $fileInfo['savedPath'] = $savedPath;
                    $fileInfo['clientName'] = $file->getClientName(); // (12)
                    $fileInfo['name'] = $file->getName(); // (13)
                    $fileInfo['clientMimeType'] = $file->getClientMimeType(); // (14)
                    $fileInfo['clientExtention'] = $file->getClientExtension(); // (15)
                    $fileInfo['guessExtention'] = $file->guessExtension(); // (16)
                }
            }
        }
        var_dump($fileInfo);
        
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
