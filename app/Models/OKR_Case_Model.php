<?php
namespace App\Models;

use CodeIgniter\Model;

class OKR_Case_Model extends Model
{

    public function __construct()
    {
        $this->serverName = "211.233.21.82";
        $this->connectionOptions = array(
            "database" => "DWOKR", // 데이터베이스명
            "uid" => "dwokr",   // 유저 아이디
            "pwd" => "dwokr@)@!21",    // 유저 비번
            "CharacterSet" => "UTF-8"
        );

        $this->dbconn = sqlsrv_connect($this->serverName, $this->connectionOptions); 
    }

    public function get_exm_cases($params)
    {
        $stmt = sqlsrv_query($this->dbconn, '{CALL DWOKR.dbo.USP_OKR_EXM_CASE_LIST(?,?)}', $params);
        $list_arr = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($list_arr, [
                'ID' => $row['ID'], 
                'TITLE' => $row['TITLE'], 
                'EMP_NM' => $row['EMP_NM'],
                'EMPY_NO' => $row['EMPY_NO'],
                'DEPT_NM' => $row['DEPT_NM'], 
                'DEPT_UP_NM' => $row['DEPT_UP_NM'],
                'DATE' => $row['DATE'],
                'CASE_TP' => $row['CASE_TP']
            ]);
        }
        
        $result = $list_arr;
        
        return $result;
    }

    public function get_exm_details($params)
    {
        $stmt = sqlsrv_query($this->dbconn, '{CALL DWOKR.dbo.USP_OKR_EXM_CASE_DETAIL(?)}', $params);
        $detail_arr = array();
        $kr_arr = array();
        $clip_arr = array();

        do {
            //Key Result 가져오기
            if (sqlsrv_num_fields($stmt) == 1) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($kr_arr, [
                        'CONTENT' => $row['KR']
                    ]);
                }
            //스크랩 리스트 가져오기
            } else if (sqlsrv_num_fields($stmt) == 2) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($clip_arr, [
                        'EMPY_NO' => $row['EMPY_NO'],
                        'EMP_NM' => $row['EMP_NM']
                    ]);
                }
            //OKR 사례 내용 가져오기
            } else {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($detail_arr, [
                        'OBJECTIVE' => $row['OBJECTIVE'], 
                        'CASE_TP' => $row['CASE_TP'],
                        'TITLE' => $row['TITLE'], 
                        'TARGET' => $row['TARGET'], 
                        'COTCOME' => $row['COTCOME'],
                        'CONTEXT' => $row['CONTEXT'],
                        'STRATEGY' => $row['STRATEGY'], 
                        'KNOWHOW' => $row['KNOWHOW'],
                        'PROC_ST' => $row['PROC_ST'],
                        'CONFIRM_DTM' => $row['CONFIRM_DTM'],
                        'CONFIRM_EMP_NO' => $row['CONFIRM_EMP_NO'],
                        'CONFIRM_NOTES' => $row['CONFIRM_NOTES']
                    ]);
                }
            }
        } while (sqlsrv_next_result($stmt));

        $result['DETAIL'] = $detail_arr;
        $result['KR'] = $kr_arr;
        $result['CLIP'] = $clip_arr;

        return $result;
    }

    public function get_okr_year($dept_cd)
    {
        //DB 연결
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT
                        OKR_YEAR
                    FROM
                        OKR_OBJT_MST
                    WHERE
                        DEPT_CD = ?
                ;";
        $result = $okr_db->query($query, array($dept_cd));
        return $result->getRowArray();
    }

    public function get_okr_quarter($dept_cd, $year)
    {
        //DB 연결
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT
                        OKR_QTR
                    FROM
                        OKR_OBJT_MST
                    WHERE
                        DEPT_CD = ?
                    AND
                        OKR_YEAR = ?
                ;";
        $result = $okr_db->query($query, array($dept_cd, $year));
        return $result->getRowArray();
    }

}