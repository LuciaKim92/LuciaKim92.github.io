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

        $builder = $okr_db->table('OKR_OBJT_MST');
        $builder->select('*');
        $builder->where('DEPT_CD', $dept_CD);
        $query  = $builder->get();
        return $query->getRowArray();
        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }

    public function GetNavBarData()
    {
        //$this->db = \Config\Database::connect();
        //$okr_db = \Config\Database::connect('okrdb');
        $cts_db = \Config\Database::connect('ctsdb');

        $builder = $cts_db->table('EMP_MST');
        $builder->select('*');
        $builder->where('EMP_EMAIL', 'youjin.lee@computer.co.kr');
        $query  = $builder->get();

        return $query->getRowArray();
        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }
    
    public function GetKeyResult($dept_CD, $dept_ST){
        $okr_db = \Config\Database::connect('okrdb');
        $builder = $okr_db->table('OKR_KEYS_MST');
        $builder->select('*');
        $builder->where('DEPT_CD', $dept_CD);
        $builder->where('PROC_ST', $dept_ST);
        $query  = $builder->get();
        //print_r($query->getResult());
        return $query->getResultArray();

    }

    public function GetDeptCode($dept_CD){
        //DB 연결
        $cts_db = \Config\Database::connect('ctsdb');
        
        $builder = $cts_db->table('DEPT_MAP');
        $builder->select('*');
        $builder->where('DEPT_CD',$dept_CD);
        $builder->where('BEND_DT','29991231');
        $query = $builder->get();
        return $query->getRowArray();
        
    }

    public function GetInitiative($empy_no,$proc_st){
        //DB연결
        $okr_db = \Config\Database::connect('okrdb');
        $query = $okr_db->query("SELECT DISTINCT ID,OKR_KEYS_ID,EMPY_NO,CONTENT,CONF_TP,PROC_ST FROM OKR_INIT_MST WHERE PROC_ST ='".$proc_st."' AND EMPY_NO = '".$empy_no."';");
        return $query->getResultArray();

    }
    

}

?>
