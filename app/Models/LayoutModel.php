<?php

namespace App\Models;

class LayoutModel extends BaseModel{
    var $admin_db;
	var $admin_db_cfg;
	function __construct()`
    {
        parent::__construct();
    }

    public function Check_admin($id,$passwd)
    {
        $this->db = \Config\Database::connect();
        $mssql_db = \Config\Database::connect('msdb');


        //ci4 db by lcs 210405 시작
        //기존 소스 시작
		// $query = $mssql_db -> select('*');
		// $query = $mssql_db -> from('tbl_dwcom_member');
		// $query = $mssql_db -> where('alias',$id);
		// $query = $mssql_db -> where('pw',$passwd);
		// $query = $mssql_db -> where('used_yn','1');
		// $query = $mssql_db -> where('alias !=',"jungil.yang");
		// $query = $mssql_db -> where('alias !=',"nayoung.lee"); //부서이동으로 신관리자 로그인 못하게 처리 by sylee 21-01-20
		// $query = $mssql_db -> get();

	    // return $query -> row_array();
        //기존 소스 끝
        //새로운 소스 시작
        $builder = $mssql_db->table('tbl_dwcom_member');
        $builder->select('*');
        $builder->where('alias', $id);
        $builder->where('pw', $passwd);
        $builder->where('used_yn', '1');
        $builder->where('alias !=', 'jungil.yang');
        $builder->where('alias !=', 'nayoung.lee'); //부서이동으로 신관리자 로그인 못하게 처리 by sylee 21-01-20
        $query   = $builder->get();
        
        return $query->getRowArray();
        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }
    
    public function Select_admin
}

?>
