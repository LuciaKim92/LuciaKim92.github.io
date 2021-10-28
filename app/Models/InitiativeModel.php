<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class InitiativeModel extends Model{
    var $admin_db;
	var $admin_db_cfg;
	function __construct()
    {
        parent::__construct();
    }

    public function SetProgress($st,$id)
    {
        //$this->db = \Config\Database::connect();
        $okr_db = \Config\Database::connect('okrdb');
        //$cts_db = \Config\Database::connect('ctsdb');
        $query = 
                "
                    UPDATE 
                    OKR_INIT_MST
                    SET PROC_ST = ?
                    WHERE ID = ?;
                ";
        $okr_db->query($query, array($st,$id));
        //return $query->getRowArray();
        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }

    public function getInitiativeList(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT 
                            ID
                        ,   OKR_KEYS_ID
                        ,   EMPY_NO
                        ,   CONTENT
                        ,   CONF_TP
                        ,   PROC_ST 
                    FROM OKR_INIT_MST 
                    WHERE OKR_KEYS_ID = ?
                    AND EMPY_NO = ?
                    AND PROC_ST = ?;
                ";
        $result = $okr_db->query($query, array($_GET['okrKey'],$_GET['emp_no'], '0'));
        return $result->getResultArray();
    }

    public function getTodoList(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT 
                            ID
                        ,   CONTENT
                    FROM OKR_TODO_MST 
                    WHERE OKR_INIT_ID = ?
                ;";
        $result = $okr_db->query($query, array($_GET['initKey']));
        return $result->getResultArray();
    }
    
    public function saveInitiative(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    INSERT INTO OKR_INIT_MST
                            (CREATE_ON
                            ,CREATE_BY
                            ,CREATE_ID
                            ,OKR_KEYS_ID
                            ,EMPY_NO
                            ,CONTENT
                            ,CONF_TP)
                    
                    
                    VALUES
                        (GETDATE()
                        , ?
                        ,'123123'
                        , ?
                        , ?
                        , ?
                        , ?
                        );
                ";
        $okr_db->query($query, array($_POST['create_by'], $_POST['okr_keys_id'], $_POST['empy_no'], $_POST['content'], $_POST['conf_tp']));
        $id = $this->getInitID($_POST['content']);
        print_r($id);
        return $id; 
        //$okr_db->query($query, array($_GET['initKey']));
        //return $result->getResultArray();
    }

    public function getInitID($content){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT 
                            ID
                    FROM OKR_INIT_MST 
                    WHERE content = ?
                ;";
        $result = $okr_db->query($query, array($content));
        print_r($result->getRowArray());
    }
    

}

?>
