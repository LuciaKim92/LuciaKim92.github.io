<?php

namespace App\Controllers;
use App\Models\Sprint_Meet_Model;

class Sprint_Meet_Controller extends BaseController
{
    //세션세팅
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

    //회의록 메인 ID로 검색   (ID 없을시 최근날짜로 리턴)
    public function spr_main_id($id=null){

		$this->Model1 = new Sprint_Meet_Model;

		$myarr = $this->Model1->search_spr_by_id($id);
		$myarr['MEET_DT'] = date("Y-m-d", strtotime($myarr['MEET_DT']));
		$mydata['myarr'] = $myarr;

		$this->session_setting();
		$data = $_SESSION;

		return view('/sprint/sprint2.php', $mydata);
    }

    //회의록 날짜로 검색
    public function spr_main_date(){

        $a = $_POST['DATE'];
  
        $this->Model1 = new Sprint_Meet_Model;
        $id = $this->Model1->search_spr_by_date(str_replace("-", "", $a));

        if($id == null)
            print_r("회의록 없음");

        else
            print_r($id);
    }

    // 회의록 작성
    public function spr_create(){

        $this->session_setting();
		$data = $_SESSION;
        
        return view('/sprint/sprint.php');
    }

    

    //회의록 수정
    public function spr_edit(){

    }


}
?>