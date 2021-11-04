<?php
namespace App\Controllers;
use App\Models\OKR_MAP_Model;

class OKR_MAP_Controller extends BaseController
{

    //세션세팅 (임시)
    public function session_setting(){
        $this->response = \Config\Services::response();
        $this->session = \Config\Services::session();
        $user_data = array(
            "admin_ids" => '123123',
            "admin_names" => '이유진',
            "emp_no" => 'P221002',
            "logged_in" => TRUE
        );
        $this->session->set($user_data);
    }

    public function index($YEAR = null, $QTR = null){
        $this->session_setting();
        $this->Model = new OKR_MAP_Model;
        date_default_timezone_set('Asia/Seoul');

        if($YEAR == null || $QTR == null){
            $YEAR = date("Y", time());
            $QTR = ceil(date("m") / 3);
        }

        $mydata['DWCTS'] = $this->Model->return_dwcts($YEAR, $QTR);
        $mydata['team_arr'] = $this->Model->return_first_team($YEAR, $QTR);
        $mydata['YEAR'] = $YEAR;
        $mydata['QTR'] = $QTR;

        return view('/okr_map/okr_map.php', $mydata);
    }

    // ajax
    public function get_KR(){
        $this->Model = new OKR_MAP_Model;

        $kr_arr = $this->Model->return_KR($_POST['OBJECTIVE_ID']);

        echo json_encode($kr_arr);
    }

    // ajax
    public function get_team(){
        $this->Model = new OKR_MAP_Model;

        $team_arr = $this->Model->return_second_team($_POST['DEPT_UP_CD'], $_POST['YEAR'], $_POST['QTR']);

        echo json_encode($team_arr);
    }


    // ajax UPDATE_BY, UPDATE_ID 추가해야됨 (SESSION에서 받아와야ㅏㅁ)
    public function edit_OKR(){
        $this->session_setting();
        $this->Model = new OKR_MAP_Model;

        if($_POST['OBJECTIVE_ID'] == null){
            $temp = $this->Model->create_objective($_POST['DEPT_CD'], $_POST['DWGP_CD'], $_POST['OBJECTIVE'], 
                                            $_SESSION['admin_ids'], $_SESSION['admin_names'], $_SESSION['emp_no'],
                                            $_POST['YEAR'], $_POST['QTR']);
            return $temp;
        }

        else{
            $result = $this->Model->update_objective($_POST['OBJECTIVE_ID'], $_POST['OBJECTIVE'],
                                           $_SESSION['admin_ids'], $_SESSION['admin_names']);
        }
    }

    //ajax
    public function delete_OKR(){
        $this->Model = new OKR_MAP_Model;
        $this->Model->delete_objective($_POST['ID']);
    }

    public function edit_KR(){
        $this->session_setting();
        $this->Model = new OKR_MAP_Model;

        $arr = array();

        for($i=0; $i<sizeof($_POST['kr-id']); $i++){
            $arr[$i]['ID'] = $_POST['kr-id'][$i];
            $arr[$i]['CONTENT'] = $_POST['kr-content'][$i];
            $arr[$i]['IS_DELETE'] = $_POST['kr-delete'][$i];
            $arr[$i]['PROC_RAT'] = $_POST['kr-proc'][$i];
        };

        $temp = $this->Model->edit_kr($arr, $_SESSION['admin_names'], $_SESSION['admin_ids'], $_POST['objective_id'], $_POST['dept_cd']);
        
        return $temp;

    }

}
?>