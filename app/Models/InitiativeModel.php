<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

//Initiative Tool에 사용되는 Model
class InitiativeModel extends Model{
    var $admin_db;
	var $admin_db_cfg;
	function __construct()
    {
        parent::__construct();
    }

    //진행률 설정
    public function setProgress()
    {
        //$this->db = \Config\Database::connect();
        $okr_db = \Config\Database::connect('okrdb');
        //$cts_db = \Config\Database::connect('ctsdb');
        $query = 
                "
                    UPDATE 
                    OKR_INIT_MST
                    SET PROC_ST = ?,
                    UPDATE_ON = GETDATE(),
                    UPDATE_ID = '123123',
                    UPDATE_BY = ?
                    WHERE ID = ?;
                ";
        $okr_db->query($query, array($_POST['proc_st'],$_POST['update_by'],$_POST['id']));
        return $_POST['id'];
        //return $query->getRowArray();
        //새로운 소스 끝
        //ci4 db by lcs 210405 끝
    }

    //작성된 Initiative 목록 불러오기
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
                    FROM DWOKR.DBO.OKR_INIT_MST 
                    WHERE OKR_KEYS_ID = ?
                    AND EMPY_NO = ?
                ";
                //                    AND PROC_ST = ?;
        $result = $okr_db->query($query, array($_GET['okrKey'],$_GET['emp_no']));
        return $result->getResultArray();
        //list 전체뽑기
    }

    //작성된 ToDoList 목록 불러오기
    public function getTodoList(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT 
                            ID
                        ,   CONTENT
                        ,   NOTES
                    FROM OKR_TODO_MST 
                    WHERE OKR_INIT_ID = ?
                    AND PROC_ST = ?
                ;";
        $result = $okr_db->query($query, array($_GET['initKey'], $_GET['proc_ST']));
        return $result->getResultArray();
    }
    
    //Initiative Tool에 작성한 Initiative 저장하기
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
        return $id; 
        //$okr_db->query($query, array($_GET['initKey']));
        //return $result->getResultArray();
    }

    //Initiative 작성 후 해당 Initiative의 ID,CONTENT 가져오기[해당 열 추가하기위함]
    public function getInitID($content){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT TOP 1
                            ID,CONTENT
                    FROM OKR_INIT_MST 
                    WHERE CONTENT = ?
                    AND EMPY_NO = ?
                    ORDER BY CREATE_ON DESC
                ;";
        $result = $okr_db->query($query, array($content, $_POST['empy_no']));
        return $result->getRowArray(); //한줄뽑기        
    }
    
    //Initiative Tool에 작성한 ToDoList 저장하기
    public function saveToDo($content){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    INSERT INTO OKR_TODO_MST
                            (CREATE_ON
                            ,CREATE_BY
                            ,CREATE_ID
                            ,OKR_INIT_ID
                            ,EMPY_NO
                            ,CONTENT
                            ,PROC_ST)
                    
                    
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
        $okr_db->query($query, array($_POST['create_by'], $_POST['okr_init_id'], $_POST['empy_no'], $content, $_POST['proc_st']));
        $id = $this->getToDoID($content);
        return $id; 
    }

    //작성한 ToDoList의 ID 가져오기
    public function getToDoID($content){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT TOP 1
                            ID
                    FROM OKR_TODO_MST 
                    WHERE CONTENT = ?
                    AND EMPY_NO = ?
                    ORDER BY CREATE_ON DESC
                ;";
        $result = $okr_db->query($query, array($content, $_POST['empy_no']));
        return $result->getRowArray();        
    }

    //Initiative Tool에 사용할 자신감정도 가져오기
    public function getInitConfTP(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT CONF_TP
                    FROM OKR_INIT_MST 
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_GET['initKey']));
        return $result->getRowArray();       
    }

    //Initiative Tool에서 자신감 버튼으로 직접 변경한 것 바로 저장되게하기
    public function updateConfTP(){
        $okr_db = \Config\Database::connect('okrdb');
        $query =
                "
                    UPDATE OKR_INIT_MST
                    SET 
                    CONF_TP = ?,
                    UPDATE_ON = GETDATE(),
                    UPDATE_ID = '123123',
                    UPDATE_BY = ?
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query,array($_POST['conf_tp'],$_POST['update_by'],$_POST['id']));
        return $_POST['id'];
        
    }

    //ToDoList의 진행상황 변경하기
    public function setTodoListProcST(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    UPDATE OKR_TODO_MST
                    SET 
                    PROC_ST = ?,
                    UPDATE_ON = GETDATE(),
                    UPDATE_ID = '123123',
                    UPDATE_BY = ?
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_POST['proc_st'], $_POST['update_by'],$_POST['id']));
        return $_POST['id'];
    }

    // KR ID 가져오기
    public function getKR(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT CONTENT,ID
                    FROM OKR_KEYS_MST 
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_GET['id']));
        return $result->getRowArray();    
    }

    //Initiative의 진행상황 가져오기
    public function getInitiativeProcST(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT PROC_ST
                    FROM OKR_INIT_MST 
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_GET['id']));
        return $result->getRowArray();

    }

    //이미 입력되어있는 ToDoList에 StickerMemo 추가하기
    public function updateStickerMemo(){
        $okr_db = \Config\Database::connect('okrdb');
        if($_POST['notes'] == "null"){
            $_POST['notes'] = null;
        }
        $query = 
                "
                    UPDATE OKR_TODO_MST
                    SET 
                    NOTES = ?,
                    UPDATE_ON = GETDATE(),
                    UPDATE_ID = '123123',
                    UPDATE_BY = ?
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_POST['notes'], $_POST['update_by'], $_POST['id']));
        return $_POST['id'];
    }

    //ToDoList의 Sticker Memo 가져오기
    public function getStickerMemo(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT NOTES
                    FROM OKR_TODO_MST 
                    WHERE ID = ?
                ;";
        $result = $okr_db->query($query, array($_POST['id']));
        return $result->getRowArray();

    }

    //Initiative Tool에서 작성한 댓글 저장하기
    public function saveInitReplyInTable($id){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
        "
            INSERT INTO OKR_INIT_RPLY
                    (CREATE_ON
                    ,CREATE_BY
                    ,CREATE_ID
                    ,OKR_INIT_ID
                    ,OKR_RPLY_ID)
            
            
            VALUES
                (GETDATE()
                , ?
                ,'123123'
                , ?
                , ?
                );
        ";
        $okr_db->query($query, array($_POST['create_by'],$_POST['id'],$id));
        return $id;
    }
    
    //Initiative Tool에서 SESSION에 접속한 사용자가 해당 댓글들 봤다는 증거로 Data저장하기
    public function saveInitViewReply(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    INSERT INTO OKR_RPLY_MST
                            (CREATE_ON
                            ,CREATE_BY
                            ,CREATE_ID
                            ,PATH_TP
                            ,EMPY_NO
                            ,CONTENT)
                    
                    
                    VALUES
                        (GETDATE()
                        , ?
                        ,'123123'
                        , ?
                        , ?
                        , ?
                        );
                ";
        $okr_db->query($query, array($_POST['create_by'],'0', $_POST['empy_no'], $_POST['content']));
        $id = $this->getInitReplyID($_POST['content']);
        $this->saveInitReplyInTable($id['ID']);
        return $id;
    }
    
    //Initiative Tool 댓글 저장 후 ID가져오기
    public function getInitReplyID($content){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT TOP 1
                            ID,CREATE_ON,CREATE_BY,CONTENT
                    FROM OKR_RPLY_MST 
                    WHERE CONTENT = ?
                    AND EMPY_NO = ?
                    ORDER BY CREATE_ON DESC
                ;";
        $result = $okr_db->query($query, array($content, $_POST['empy_no']));
        return $result->getRowArray();        
    }
    


    //Initiative Tool 댓글 가져오기
    public function getInitViewReply(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                SELECT 
                    DWOKR.DBO.OKR_RPLY_MST.ID,
                    OKR_INIT_ID,
                    CONTENT,
                    DWOKR.DBO.OKR_RPLY_MST.OKR_RPLY_ID,
                    DWOKR.DBO.OKR_RPLY_MST.CREATE_ON,
                    DWOKR.DBO.OKR_RPLY_MST.EMPY_NO,
                    DWOKR.DBO.OKR_RPLY_MST.CREATE_BY,
                    NICE_YN
                FROM 
                    DWOKR.DBO.OKR_RPLY_MST 
                LEFT JOIN 
                    DWOKR.DBO.OKR_INIT_RPLY 
                ON 
                    DWOKR.DBO.OKR_RPLY_MST.ID
                    = DWOKR.DBO.OKR_INIT_RPLY.OKR_RPLY_ID
                LEFT JOIN
                    DWOKR.DBO.OKR_RPLY_READ
                ON 
                    DWOKR.DBO.OKR_RPLY_MST.ID
                    = DWOKR.DBO.OKR_RPLY_READ.OKR_RPLY_ID  
                WHERE
                    OKR_INIT_ID = ?
                AND
                    OKR_RPLY_READ.EMPY_NO = ?
                ;";
        $result = $okr_db->query($query, array($_POST['id'],$_POST['empy_no']));
        return $result->getResultArray();
    }

    //Initiative 담당자 가져오기
    public function getInitMaker(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT EMP_NM
                    FROM DWCTS.DBO.EMP_MST 
                    WHERE EMP_NO = (SELECT EMPY_NO
                                    FROM DWOKR.DBO.OKR_INIT_MST 
                                    WHERE ID = ?)
                ;";
        $result = $okr_db->query($query, array($_POST['id']));
        return $result->getRowArray();
    }

    //Initiative Tool 댓글 저장하기
    public function saveInitReplyData(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    INSERT INTO OKR_RPLY_READ
                            (CREATE_ON
                            ,CREATE_BY
                            ,CREATE_ID
                            ,OKR_RPLY_ID
                            ,EMPY_NO
                            ,NICE_YN)
                    
                    
                    VALUES
                        (GETDATE()
                        , ?
                        ,'123123'
                        , ?
                        , ?
                        , ?
                        );
                ";
        $okr_db->query($query, array($_POST['create_by'],$_POST['id'], $_POST['empy_no'], 'n'));
        return $_POST['id'];
    }
    
    //Initiative Tool 댓글 읽음 여부 가져오기
    public function initReplyReadOK(){
        $okr_db = \Config\Database::connect('okrdb');

        $query = 
                "
                SELECT 
                    OKR_INIT_ID,
                    DWOKR.DBO.OKR_INIT_RPLY.OKR_RPLY_ID, 
                    DWOKR.DBO.OKR_RPLY_READ.ID
                FROM
                    DWOKR.DBO.OKR_RPLY_READ
                LEFT JOIN
                    DWOKR.DBO.OKR_INIT_RPLY
                ON
                    DWOKR.DBO.OKR_INIT_RPLY.OKR_RPLY_ID
                     = DWOKR.DBO.OKR_RPLY_READ.OKR_RPLY_ID
                WHERE
                    OKR_INIT_ID = ?
                ;";
        $result = $okr_db->query($query, array($_POST['id']));
        return $result->getResultArray();
    }

    //댓글 읽은 사람이 좋아요 눌렀을 때 활성화/비활성화 즉시저장
    public function saveLikeInitReply(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    UPDATE OKR_RPLY_READ
                    SET 
                    NICE_YN = ?,
                    UPDATE_ON = GETDATE(),
                    UPDATE_ID = '123123',
                    UPDATE_BY = ?
                    WHERE OKR_RPLY_ID = ?
                    AND EMPY_NO = ?
                ;";
        $result = $okr_db->query($query, array($_POST['nice_yn'], $_POST['update_by'], $_POST['id'], $_POST['empy_no']));
        return $_POST['id'];
    }

    //댓글에 달린 좋아요 수 불러오기
    public function getLikeCntInitReply(){
        $okr_db = \Config\Database::connect('okrdb');
        $query = 
                "
                    SELECT COUNT(NICE_YN) AS COUNT
                    FROM OKR_RPLY_READ
                    WHERE OKR_RPLY_ID = ?
                    AND NICE_YN = 'Y'
                    
                ;";
        $result = $okr_db->query($query, array($_POST['id']));
        return $result->getRowArray();
    }
    



    

}

?>
