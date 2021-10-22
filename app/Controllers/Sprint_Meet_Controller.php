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
			"emp_no" => 'P221002',
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
        $result_arr = json_encode($data, JSON_UNESCAPED_UNICODE);

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

        $this->session_setting();

        date_default_timezone_set('Asia/Seoul');
        
        if($date == NULL)
            $date = date("Y-m-d");

        //DB로 보낼꺼 이런형식 => 20211022
        $date2 = str_replace("-", "", $date);
        

        $this->Model = new Sprint_Meet_Model;


        $spr_id = $this->Model->search_spr_by_date($date2);

        //회의록이 없는경우 (새로생성)
        if($spr_id == null){
            $myarr = $this->Model->create_spr($date2);

            $myarr['EMP_LIST'] = $this->Model->get_emp_list($_SESSION['emp_no']);
    
    
            $data = $_SESSION;
            
            $mydata['myarr'] = $myarr;
            $mydata['MEET_DT'] = $date;
    
            return view('/sprint/sprint.php', $mydata);
        }

        // 회의록 있는경우...수정화면으로 넘기기
        else{

            echo '<script type="text/javascript">'; 
            echo 'alert("이미 회의록이 있습니다. 수정화면으로 넘어갑니다.");'; 
            echo 'window.location.href = "/Sprint_Meet_Controller/spr_edit/'.$spr_id.'"';
            echo '</script>';

        }
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

        // $this->spr_main_id($arr['SPR_MEET_ID']);
        $this->response->redirect("/Sprint_Meet_Controller/spr_main_id/".$arr['SPR_MEET_ID']);
        // VAR_DUMP($_POST);
    }

    
    //회의록 수정
    public function spr_edit($id){

        $this->session_setting();
		$this->Model = new Sprint_Meet_Model;

        //예외처리필요 현재는 그냥 최근꺼 수정하기로 보냄 
        if($id == null){
            $id = $this->Model->search_last_spr();
        }

		$myarr = $this->Model->search_spr_by_id($id);

        //날짜 파싱
		$myarr['MEET_DT'] = date("Y-m-d", strtotime($myarr['MEET_DT']));

        foreach($myarr['BOOKMARK']  as $key => $bean){
            $myarr['BOOKMARK'][$key]['MEET_DT'] = date("Y-m-d", strtotime($bean['MEET_DT']));
        }

        $myarr['EMP_LIST'] = $this->Model->get_emp_list($_SESSION['emp_no']);

		$mydata['myarr'] = $myarr;
        $data = $_SESSION;

		return view('/sprint/sprint_edit.php', $mydata);
    }

    
    //회의록 수정 저장
    public function spr_edit_save(){

        $this->session_setting();
        $this->Model = new Sprint_Meet_Model;

        $arr = array();
        $feed_arr = array();
        $idea_arr = array();
        $plan_arr = array();
        $new_idea_arr = array();
        $new_plan_arr = array();

        if(isset($_POST['feed-id'])){
            for($i=0; $i < sizeof($_POST['feed-id']); $i++){
                array_push($feed_arr, [   'feed-id' => $_POST['feed-id'][$i]
                                        , 'feed-high' => $_POST['feed-high'][$i]
                                        , 'feed-low'  => $_POST['feed-low'][$i] 
                                    ]);
            }
        }

        if(isset($_POST['idea-id'])){
            for($i=0; $i < sizeof($_POST['idea-id']); $i++){
                array_push($idea_arr, [   'idea-id'      => $_POST['idea-id'][$i]
                                        , 'idea-delete'  => $_POST['idea-delete'][$i]
                                        , 'idea-name'    => $_POST['idea-name'][$i]
                                        , 'idea-todo'    => $_POST['idea-todo'][$i] 
                                        , 'idea-content' => $_POST['idea-content'][$i]
                                    ]);
            }
        }

        if(isset($_POST['plan-id'])){
            for($i=0; $i < sizeof($_POST['plan-id']); $i++){
                array_push($plan_arr, [   'plan-id'       => $_POST['plan-id'][$i]
                                        , 'plan-delete'   => $_POST['plan-delete'][$i]
                                        , 'plan-name'     => $_POST['plan-name'][$i]
                                        , 'plan-content'  => $_POST['plan-content'][$i] 
                                    ]);
            }
        }

        if(isset($_POST['idea-new-kr'])){
            for($i=0; $i < sizeof($_POST['idea-new-kr']); $i++){
                array_push($new_idea_arr, [   'idea-new-kr'       => $_POST['idea-new-kr'][$i]
                                            , 'idea-new-name'     => $_POST['idea-new-name'][$i]
                                            , 'idea-new-todo'     => $_POST['idea-new-todo'][$i]   
                                            , 'idea-new-content'  => $_POST['idea-new-content'][$i] 
                                    ]);
            }
        }
 

        if(isset($_POST['plan-new-kr'])){
            for($i=0; $i < sizeof($_POST['plan-new-kr']); $i++){
                array_push($new_plan_arr, [   'plan-new-kr'       => $_POST['plan-new-kr'][$i]
                                            , 'plan-new-name'     => $_POST['plan-new-name'][$i]  
                                            , 'plan-new-content'  => $_POST['plan-new-content'][$i] 
                                    ]);
            }
        }


        $arr['CREATE_BY']   = $_SESSION['admin_names'];
        $arr['CREATE_ID']   = $_SESSION['admin_ids'];
        $arr['UPDATE_BY']   = $_SESSION['admin_names'];
        $arr['UPDATE_ID']   = $_SESSION['admin_ids'];
        $arr['SPR_MEET_ID'] = $_POST['SPR_MEET_ID'];

        $arr['feed'] = $feed_arr;
        $arr['idea'] = $idea_arr;
        $arr['plan'] = $plan_arr;
        $arr['new-idea'] = $new_idea_arr;
        $arr['new-plan'] = $new_plan_arr;

        $this->Model->update_spr_content($arr);
        $this->response->redirect("/Sprint_Meet_Controller/spr_main_id/".$_POST['SPR_MEET_ID']);
        // VAR_DUMP($_POST);
    }

    //To do 리스트 반환 AJAX 통신
    public function get_to_do_list(){

        $this->Model = new Sprint_Meet_Model;
        $myarr = $this->Model->search_todo($_POST['KR_ID'], $_POST['EMP_NO']);

        echo json_encode($myarr);
    }


    //회의록 삭제
    public function spr_delete($id=null){

        if($id==null){
            return;
        }

        $this->Model = new Sprint_Meet_Model;
        $this->Model->delete_spr_mst($id);
    }


}
?>