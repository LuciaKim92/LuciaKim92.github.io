<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class LayoutModel extends Model{
    var $admin_db;
	var $admin_db_cfg;
	function __construct()
    {
        parent::__construct();
    }

    public function GetObjective($dept_CD)
    {
        //$this->db = \Config\Database::connect();
        $okr_db = \Config\Database::connect('okrdb');
        //$cts_db = \Config\Database::connect('ctsdb');
        $query = 
                "
                    SELECT 
                        ID,
                        OBJECTIVE,
                        OKR_YEAR,
                        OKR_QTR
                    FROM
                        OKR_OBJT_MST
                    WHERE 
                        DEPT_CD = ?
                    
                ;";
        $result = $okr_db->query($query, array($dept_CD));
        return $result->getRowArray();



        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }

    public function GetNavBarData()
    {
        //$this->db = \Config\Database::connect();
        //$okr_db = \Config\Database::connect('okrdb');
        $cts_db = \Config\Database::connect('ctsdb');
        $query = 
                "
                    SELECT 
                        EMP_NM,
                        EMP_NO,
                        EMP_EMAIL,
                        DEPT_CD
                    FROM 
                        EMP_MST
                    WHERE 
                        EMP_EMAIL = ?
                    
                ;";
        //$result = $okr_db->query($query, array('jihun.ko@computer.co.kr'));
        $result = $cts_db->query($query, array('youjin.lee@computer.co.kr'));
        return $result->getRowArray();
    }
    
    public function GetKeyResult($dept_CD, $dept_ST){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT 
                        ID,
                        CONTENT,
                        OKR
                    FROM 
                        OKR_KEYS_MST
                    WHERE 
                        DEPT_CD = ?
                    AND
                        PROC_ST = ?
                ;";
        $result = $okr_db->query($query, array($dept_CD,$dept_ST));
        //print_r($query->getResult());
        return $result->getResultArray();

    }

    public function GetDeptCode($dept_CD){
        //DB 연결
        $cts_db = \Config\Database::connect('ctsdb');
        $query = 
                "
                    SELECT
                        *
                    FROM
                        DEPT_MAP
                    WHERE
                        DEPT_CD = ?
                    AND   
                        BEND_DT = ?
                    AND
                        USE_YN = 'Y'
   
                ;";
        $result = $cts_db->query($query, array($dept_CD,'29991231'));
        return $result->getRowArray();
        
    }

    public function GetInitiative($empy_no,$proc_st){
        //DB연결
        $okr_db = \Config\Database::connect('okrdb');
        $query =
                "
                    SELECT DISTINCT
                        ID,
                        OKR_KEYS_ID,
                        EMPY_NO,
                        CONTENT,
                        CONF_TP,
                        PROC_ST
                    FROM 
                        OKR_INIT_MST 
                    WHERE 
                        PROC_ST = ? 
                    AND
                        EMPY_NO = ?
                ;";
        $result = $okr_db->query($query,array($proc_st,$empy_no));
        return $query->getResultArray();

    }

    

}

?>
