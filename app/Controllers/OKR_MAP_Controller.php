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
            "admin_ids" => 123123,
            "admin_names" => '이유진',
            "emp_no" => 'P221002',
            "logged_in" => TRUE
        );
        $this->session->set($user_data);
    }

    public function index(){
        $this->session_setting();
        $this->Model = new OKR_MAP_Model;

        $team_arr = array();

        $team_arr = $this->Model->return_first_team();

        $mydata['team_arr'] = $team_arr;

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

        $team_arr = $this->Model->return_second_team($_POST['DEPT_UP_CD']);

        echo json_encode($team_arr);
    }

}
?>