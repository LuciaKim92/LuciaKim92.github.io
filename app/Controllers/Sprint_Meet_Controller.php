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
			"admin_ids" => 123123,
			"admin_names" => '이유진',
			"emp_no" => '1234',
			"logged_in" => TRUE
		);
		$this->session->set($user_data);
	}

    public function get_spr_meet_list() {
        
        $DWGP_CD = $_POST['DWGP_CD'];
        $DEPT_CD = $_POST['DEPT_CD'];
        $FIND_TXT = $_POST['FIND_TXT'];
        $DATE_TP = $_POST['DATE_TP'];
        $ST_DT = str_replace("-", "", $_POST['ST_DT']);
        $ED_DT = str_replace("-", "", $_POST['ED_DT']);

        $params = array(
            array($DWGP_CD,SQLSRV_PARAM_IN),
            array($DEPT_CD,SQLSRV_PARAM_IN),
            array($FIND_TXT,SQLSRV_PARAM_IN),
            array($DATE_TP,SQLSRV_PARAM_IN),
            array($ST_DT,SQLSRV_PARAM_IN),
            array($ED_DT,SQLSRV_PARAM_IN)
        );

        $this->SprModel = new Sprint_Meet_Model;
        $data = $this->SprModel->get_spr_meet_list($params);

        $result_arr = json_encode($data);
        file_put_contents("result.json", $result_arr);

        return $result_arr;
    }

    //회의록 메인 ID로 검색   (ID 없을시 최근날짜로 리턴)
    public function spr_main_id($id=null){

		$this->Model1 = new Sprint_Meet_Model;

        //예외처리필요
        if($id == null){
            $id = $this->Model1->search_last_spr();
        }

		$myarr = $this->Model1->search_spr_by_id($id);

        //날짜 파싱
		$myarr['MEET_DT'] = date("Y-m-d", strtotime($myarr['MEET_DT']));

        foreach($myarr['BOOKMARK']  as $key => $bean){
            $myarr['BOOKMARK'][$key]['MEET_DT'] = date("Y-m-d", strtotime($bean['MEET_DT']));
        }

		$mydata['myarr'] = $myarr;

		$this->session_setting();
		$data = $_SESSION;

		return view('/sprint/sprint2.php', $mydata);
    }

    //회의록 날짜로 검색 (달력) ajax 통신
    public function spr_main_date(){

        $a = $_POST['DATE'];
  
        $this->Model = new Sprint_Meet_Model;
        $id = $this->Model->search_spr_by_date(str_replace("-", "", $a));

        if($id == null)
            print_r("회의록 없음");

        else
            print_r($id);
    }

    // 회의록 작성 (날짜를 파라미터로 없으면 오늘날짜)
    public function spr_create($date=NULL){

        date_default_timezone_set('Asia/Seoul');
        
        if($date == NULL)
            $date = date("Y-m-d");

        //DB로 보낼꺼
        $date2 = str_replace("-", "", $date);
        

        $this->Model = new Sprint_Meet_Model;
        $myarr = $this->Model->test111($date2);

        $this->session_setting();
		$data = $_SESSION;
        
        $mydata['myarr'] = $myarr;
        $mydata['MEET_DT'] = $date;

        return view('/sprint/sprint.php', $mydata);
    }

    public function spr_save(){

        $this->session_setting();
        $this->Model = new Sprint_Meet_Model;

        // ['OKR_OBJT_ID']
        // ['DWGP_CD']
        // ['DEPT_CD']
        // ['MEET_DT']
        // ['feed-plan'], ['feed-high'], ['feed-low']                       스프린트미팅마스터는 생성후에...
        // ['idea-kr'], ['idea-name'], ['idea-todo'], ['idea-content']      스프린트미팅마스터는 생성후에...
        // ['plan-kr'], ['plan-name'], ['plan-content']                     스프린트미팅마스터는 생성후에...
        // 만들어야할 컬럼
        // 스프린트미팅 마스터 -> 스프린트미팅 피드백 -> 스프린트미팅 아이디어 -> 스프린트미팅 계획

        $arr = array();
        $feed_arr = array();
        $idea_arr = array();
        $plan_arr = array();
        
        $_POST['MEET_DT'] = str_replace("-", "", $_POST['MEET_DT']);

        for($i=0; $i < sizeof($_POST['feed-plan']); $i++){
            array_push($feed_arr, [   'feed-plan' => $_POST['feed-plan'][$i]
                                    , 'feed-high' => $_POST['feed-high'][$i]
                                    , 'feed-low'  => $_POST['feed-low'][$i] 
                                ]);
        }

        for($i=0; $i < sizeof($_POST['idea-kr']); $i++){
            array_push($idea_arr, [   'idea-kr'      => $_POST['idea-kr'][$i]
                                    , 'idea-name'    => $_POST['idea-name'][$i]
                                    , 'idea-todo'    => $_POST['idea-todo'][$i] 
                                    , 'idea-content' => $_POST['idea-content'][$i]
                                ]);
        }

        for($i=0; $i < sizeof($_POST['plan-kr']); $i++){
            array_push($plan_arr, [   'plan-kr'       => $_POST['plan-kr'][$i]
                                    , 'plan-name'     => $_POST['plan-name'][$i]
                                    , 'plan-content'  => $_POST['plan-content'][$i] 
                                ]);
        }

        $arr['CREATE_BY']   = $_SESSION['admin_names'];
        $arr['CREATE_ID']   = $_SESSION['admin_ids'];
        $arr['OKR_OBJT_ID'] = $_POST['OKR_OBJT_ID'];
        $arr['DWGP_CD']     = $_POST['DWGP_CD'];
        $arr['DEPT_CD']     = $_POST['DEPT_CD'];
        $arr['MEET_DT']     = $_POST['MEET_DT'];
        $arr['feed'] = $feed_arr;
        $arr['idea'] = $idea_arr;
        $arr['plan'] = $plan_arr;


        $arr['SPR_MEET_ID'] = $this->Model->insert_spr_meet_mst($arr);
        $this->Model->insert_spr_content($arr);

        $this->spr_main_id($arr['SPR_MEET_ID']);
        // VAR_DUMP($_POST);

    }

    
    //회의록 수정
    public function spr_edit(){
        $this->Model = new Sprint_Meet_Model;
        $this->Model->search_spr_by_id(1000000);
    }

    //To do 리스트 반환 AJAX 통신
    public function get_to_do_list(){

        $this->Model = new Sprint_Meet_Model;
        $myarr = $this->Model->search_todo($_POST['KR_ID'], $_POST['EMP_NO']);

        echo json_encode($myarr);
    }


}
?>