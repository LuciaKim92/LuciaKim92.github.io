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

        //var_dump($_POST);

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

    public function get_clip_list($id)
    {
        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_clip_list($id);

        $output = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $output;
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

    public function case_write($id = null)
    {
        $this->session_setting();

        $this->model = new OKR_Case_Model;
        $data = $this->model->get_saved_cases($_SESSION['emp_no']);
        $result['SAVED'] = $data;
        $result['DETAIL'] = null;

        if ($id != null) {
            $detail = $this->model->get_saved_cases_detail($id);
            $result['DETAIL'] = $detail;
        }

        return view("/case/case_write.php", $result);
    }

    public function get_okr_depts($is_saved)
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
            'type' => 'root',
            'state' => array()
        );

        $arr2 = array(
            'id' => $myData['DEPT_UP_CD'],
            'text' => $myData['DEPT_UP_NM'],
            'parent' => '#',
            'children' => true,
            'type' => 'root',
            'state' => array()
        );

        $arr3 = array(
            'id' => $myData['COMP_CD'],
            'text' => $myData['COMP_NM'],
            'parent' => '#',
            'children' => true,
            'type' => 'root',
            'state' => array()
        );

        if($is_saved != 0) {
            $okrModel = new OKR_Case_Model;
            $data = $okrModel->get_saved_okr_view($is_saved);

            if($data['DEPT_CD'] == $myData['DEPT_CD']) {
                $arr['state'] = array( 'opened' => true );
            } else if($data['DEPT_CD'] == $myData['DEPT_UP_CD']) {
                $arr2['state'] = array( 'opened' => true );
            } else {
                $arr3['state'] = array( 'opened' => true );
            }
        }

        $result = array($arr, $arr2, $arr3);
        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function get_okr_year($dept_cd, $is_saved) {
        
        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_okr_year($dept_cd);
        if($is_saved != 0) {
            $okr_data = $this->Model->get_saved_okr_view($is_saved);
        }

        $result = array();
        foreach($data as $key => $value) {

            array_push($result, [
                'id' => strval($value['OKR_YEAR']),
                'text' => strval($value['OKR_YEAR']),
                'parent' => $dept_cd,
                'type' => 'year',
                'children' => true,
                'state' => array()
            ]);

            if($is_saved != 0 && $okr_data['OKR_YEAR'] == $value['OKR_YEAR']) {
                $result[$key]['state'] = array( 'opened' => true );
            }
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function get_okr_quarter($dept_cd, $year, $is_saved) {
        
        $this->Model = new OKR_Case_Model;
        $data = $this->Model->get_okr_quarter($dept_cd, $year);
        if($is_saved != 0) {
            $okr_data = $this->Model->get_saved_okr_view($is_saved);
        }

        $result = array();
        foreach($data as $key => $value) {

            array_push($result, [
                'id' => $value['OKR_QTR'],
                'text' => $value['OKR_QTR'],
                'parent' => $year,
                'type' => 'quarter',
                'children' => true,
                'state' => array()
            ]);

            if($is_saved != 0 && $okr_data['OKR_QTR'] == $value['OKR_QTR']) {
                $result[$key]['state'] = array( 'opened' => true );
            }
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function get_okr_list($dept_cd, $year, $quarter, $is_saved)
    {
        $this->Model = new OKR_Case_Model;
        $quarter = $quarter == 'Objective' ? '0' : $quarter;
        $okr_arr = $this->Model->get_okr_list($dept_cd, $year, $quarter);
        if($is_saved != 0) {
            $okr_data = $this->Model->get_saved_okr_view($is_saved);
        }

        $result = array();
        if(sizeof($okr_arr) > 0)
        {
            array_push($result, [
                'id' => strval($okr_arr[0]['OKR_OBJT_ID']),
                'text' => $okr_arr[0]['OBJECTIVE'],
                'parent' => $quarter == 0 ? 'Objective' : $quarter,
                'state' => array(),
                'type' => 'okr',
                'children' => array()
            ]);
            $result[0]['state'] = array( 'opened' => true );
    
            foreach ($okr_arr as $key => $value) {

                if ($value['OKR_KEYS_ID'] != null) {
                    array_push($result, [
                        'id' => strval($value['OKR_KEYS_ID']),
                        'text' => $value['CONTENT'],
                        'parent' => strval($value['OKR_OBJT_ID']),
                        'type' => 'okr',
                        'children' => true,
                        'state' => array()
                    ]);

                    if($is_saved != 0 && $okr_data['OKR_KEYS_ID'] == $value['OKR_KEYS_ID']) {
                        $result[$key+1]['state'] = array( 'opened' => true );
                    }
                }
            }
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function get_okr_initiatives($kr_id, $okr_init_id)
    {
        $this->session_setting();
        $this->Model = new OKR_Case_Model;
        $ini_arr = $this->Model->get_okr_initiatives($kr_id, $_SESSION['emp_no']);

        $result = array();
        foreach($ini_arr as $key => $value) {

            array_push($result, [
                'id' => strval($value['ID']),
                'text' => $value['CONTENT'],
                'parent' => $kr_id,
                'type' => 'initiatives',
                'state' => array()
            ]);

            if ($okr_init_id != 0 && $value['ID'] == $okr_init_id) {
                $result[$key]['state'] = array( 'selected' => true );
            }
        }

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }

    public function save_exm_case()
    {
        $this->session_setting();

        $CODE = $_POST['CODE'];
        $SAVE_TP = $_POST['SAVE_TP'];
        $CREATE_BY = $_SESSION['admin_names'];
        $CREATE_ID = $_SESSION['admin_ids'];
        $OKR_INIT_ID = $_POST['OKR_INIT_ID'];
        $EMPY_NO = $_SESSION['emp_no'];
        $CASE_TP = $_POST['CASE_TP'];
        $TITLE = $_POST['TITLE'];
        $TARGET = $_POST['TARGET'];
        $COTCOME = $_POST['COTCOME'];
        $CONTEXT = $_POST['CONTEXT'];
        $STRATEGY = $_POST['STRATEGY'];
        $KNOWHOW = $_POST['KNOWHOW'];
        $CONFIRM_DTM = null;
        $CONFIRM_EMP_NO = null;
        $CONFIRM_NOTES = null;

        $params = array(
            array($CODE,SQLSRV_PARAM_IN),
            array($SAVE_TP,SQLSRV_PARAM_IN),
            array($CREATE_BY,SQLSRV_PARAM_IN),
            array($CREATE_ID,SQLSRV_PARAM_IN),
            array($OKR_INIT_ID,SQLSRV_PARAM_IN),
            array($EMPY_NO,SQLSRV_PARAM_IN),
            array($CASE_TP,SQLSRV_PARAM_IN),
            array($TITLE,SQLSRV_PARAM_IN),
            array($TARGET,SQLSRV_PARAM_IN),
            array($COTCOME,SQLSRV_PARAM_IN),
            array($CONTEXT,SQLSRV_PARAM_IN),
            array($STRATEGY,SQLSRV_PARAM_IN),
            array($KNOWHOW,SQLSRV_PARAM_IN),
            array($CONFIRM_DTM,SQLSRV_PARAM_IN),
            array($CONFIRM_EMP_NO,SQLSRV_PARAM_IN),
            array($CONFIRM_NOTES,SQLSRV_PARAM_IN),
        );
        
        $this->Model = new OKR_Case_Model;
        $result = $this->Model->save_exm_case($params);

        $output = json_encode($result, JSON_UNESCAPED_UNICODE);
        return $output;
    }
}

?>
