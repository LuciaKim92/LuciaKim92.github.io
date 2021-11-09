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

}