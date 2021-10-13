<?php
namespace App\Models;

use CodeIgniter\Model;

class Sprint_Meet_Model extends Model
{
    public function __construct(){
        $this->serverName = "211.233.21.82";
        $this->connectionOptions = array(
            "database" => "", // 데이터베이스명
            "uid" => "dwokr",   // 유저 아이디
            "pwd" => "dwokr@)@!21"    // 유저 비번
        );


        $this->dbconn = sqlsrv_connect($this->serverName, $this->connectionOptions); 
    }

    public function search_todo($kr_id, $emp_no){
        $query = "SELECT A.CONTENT as INIT_CONTENT, B.ID, B.CONTENT, B.OKR_INIT_ID 
                    FROM OKR_INIT_MST A INNER JOIN OKR_TODO_MST B ON A.ID = B.OKR_INIT_ID
                    WHERE A.OKR_KEYS_ID =$kr_id and A.EMPY_NO = '$emp_no' AND A.PROC_ST = '0'";

        $stmt = sqlsrv_query($this->dbconn, $query);

        $todo_arr = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($todo_arr, ['INIT_CONTENT' => $row['INIT_CONTENT'], 'ID' => $row['ID'], 'CONTENT' => $row['CONTENT'], 'OKR_INIT_ID' => $row['OKR_INIT_ID']]);
        }

        $result['TODO'] = $todo_arr;

        return $result;
    }

    public function search_last_spr(){

        $query = "SELECT top 1 ID FROM spr_meet_mst order by MEET_DT desc";
        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if($row == NULL)
            return null;

        return $row['ID'];
    }

    public function search_spr_by_date($date){

        $query = "SELECT * from SPR_MEET_MST WHERE MEET_DT = $date";
        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if($row == NULL)
            return null;
            
        return $row['ID'];
    }

    public function search_spr_by_id($id){

        //최종적으로 리턴
        $result = array();

        //SPR_MEET_MST랑 부서 테이블을 조인하여 다른 테이블 조회에 사용될 데이터 가져옴(결과 1개만 나옴...)
        $query = "  SELECT A.OKR_OBJT_ID, A.MEET_DT, A.DEPT_CD, A.DEPT_NM, B.DEPT_NM as 'DEPT_UP_NM'
                    FROM	(	SELECT A.OKR_OBJT_ID, A.MEET_DT, A.DEPT_CD, B.DEPT_NM, B.DEPT_UP_CD 
                                FROM SPR_MEET_MST A INNER JOIN DWCTS.dbo.DEPT_MST B ON A.DWGP_CD = B.DWGP_CD AND A.DEPT_CD = B.DEPT_CD 
                                WHERE A.ID = $id) A INNER JOIN DWCTS.dbo.DEPT_MST B ON A.DEPT_UP_CD = B.DEPT_CD";

        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);


        //예외처리 해야함 해당 회의록이 없거나, 부서코드가 잘못됐거나...
        if($row == NULL){
            echo "오류";
        }

        //오브젝티브 아이디 및 이름
        $OBJT_ID = $row['OKR_OBJT_ID'];
        $DEPT_CD = $row['DEPT_CD'];
        $result['MEET_DT'] = $row['MEET_DT'];
        $result['DEPT_NM'] = $row['DEPT_NM'];
        $result['DEPT_UP_NM'] = $row['DEPT_UP_NM'];

        $query = " SELECT OBJECTIVE FROM OKR_OBJT_MST WHERE ID = $OBJT_ID";
        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        $result['OBJECTIVE'] = $row['OBJECTIVE'];


        //KR 조회
        $query = "SELECT ID, CONTENT from OKR_KEYS_MST WHERE OKR_OBJT_ID = '$OBJT_ID' AND PROC_ST NOT IN ('8', '9')";
        $stmt = sqlsrv_query($this->dbconn, $query);

        $kr_arr = array();

        while ($row2 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($kr_arr, ['ID' => $row2['ID'], 'CONTENT' => $row2['CONTENT']]);
        }

        $result['KR'] = $kr_arr;


        //KR 별로 피드백 조회

        $feed_arr = array();

        foreach($kr_arr as $key => $bean){
            // echo $key;
            $kr_id = $bean['ID'];

            $query = "  SELECT A.HIGHLIGHT, A.LOWLIGHT, B.EMP_NM, B.CONTENT 
                        FROM SPR_MEET_FEED A INNER JOIN (SELECT A.*, B.EMP_NM FROM SPR_MEET_PLAN A INNER JOIN DWCTS.dbo.EMP_MST B ON A.EMPY_NO = B.EMP_NO) B ON A.SPR_MEET_PLAN_ID = B.ID
                        WHERE OKR_KEYS_ID = $kr_id AND A.SPR_MEET_ID = $id";
            $stmt = sqlsrv_query($this->dbconn, $query);

            $temp = [];
            
            while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                array_push($temp, $row3);
            }

            array_push($feed_arr, $temp);
        }

        $result['FEED'] = $feed_arr;


        //KR 별로 아이디어 조회

        $idea_arr = array();

        foreach($kr_arr as $key => $bean){
            // echo $key;
            $kr_id = $bean['ID'];

            $query = "  SELECT A.CONTENT as 'IDEA_CONTENT', A.EMP_NM, B.CONTENT as 'TO_DO_CONTENT', B.INIT_CONTENT
            FROM    (SELECT A.*, B.EMP_NM FROM SPR_MEET_IDEA A INNER JOIN DWCTS.dbo.EMP_MST B ON A.EMPY_NO = B.EMP_NO) A INNER JOIN 
                    (SELECT A.*, B.CONTENT INIT_CONTENT FROM OKR_TODO_MST A INNER JOIN OKR_INIT_MST B ON A.OKR_INIT_ID = B.ID) B ON A.OKR_TODO_ID = B.ID
            WHERE A.SPR_MEET_ID = $id AND A.OKR_KEYS_ID = $kr_id";

            $stmt = sqlsrv_query($this->dbconn, $query);

            $temp = [];

            while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                array_push($temp, $row3);
            }

            array_push($idea_arr, $temp);
        }

        $result['IDEA'] = $idea_arr;


        //KR 별로 플랜 조회

        $plan_arr = array();

        
        foreach($kr_arr as $key => $bean){
            // echo $key;
            $kr_id = $bean['ID'];

            $query = "  SELECT B.EMP_NM, A.CONTENT 
                        FROM SPR_MEET_PLAN A INNER JOIN DWCTS.dbo.EMP_MST B ON A.EMPY_NO = B.EMP_NO
                         WHERE A.SPR_MEET_ID = $id AND A.OKR_KEYS_ID=$kr_id ";
            

            $stmt = sqlsrv_query($this->dbconn, $query);

            $temp = [];

            while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                array_push($temp, $row3);
            }

            array_push($plan_arr, $temp);
        }

        $result['PLAN'] = $plan_arr;


        //BOOKMARK 조회

        $book_arr = array();

        $query = "SELECT * FROM SPR_MEET_MST WHERE DEPT_CD = '$DEPT_CD' ORDER BY MEET_DT DESC";
        $stmt = sqlsrv_query($this->dbconn, $query);

        while ($row2 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($book_arr, ['ID' => $row2['ID'], 'MEET_DT' => $row2['MEET_DT']]);
        }

        $result['BOOKMARK'] = $book_arr;

        // result의 KEY: (MEET_DT, DEPT_NM, DEPT_UP_NM, KR, FEED, IDEA, PLAN)
        // KR의     KEY: (ID, CONTENT)
        // FEED의   KEY: (HIGHLIGHT, LOWLIGHT, EMP_NM, CONTENT(저번주 plan) )
        // IDEA의   KEY: (IDEA_CONTENT, EMP_NM, TO_DO_CONTENT, INIT_CONTENT)
        // PLAN의   KEY: (EMP_NM, CONTENT )
        // BOOKMARK의 KEY:
        return $result;

    }

    public function test111($DATE){

        
        //최종적으로 리턴
        $result = array();

        //SPR_MEET_MST랑 부서 테이블을 조인하여 다른 테이블 조회에 사용될 데이터 가져옴(결과 1개만 나옴...)
        $query = "  SELECT A.DWGP_CD, A.DEPT_CD, A.DEPT_NM, B.DEPT_NM as DEPT_UP_NM, C.ID, C.OBJECTIVE
                    FROM	
                        (SELECT A.DWGP_CD, A.DEPT_CD, B.DEPT_NM, B.DEPT_UP_CD 
                        FROM DWCTS.dbo.EMP_MST A INNER JOIN DWCTS.dbo.DEPT_MST B ON A.DWGP_CD = B.DWGP_CD AND A.DEPT_CD = B.DEPT_CD 
                        WHERE A.EMP_NO = 'B221002') A INNER JOIN DWCTS.dbo.DEPT_MST B ON A.DEPT_UP_CD = B.DEPT_CD INNER JOIN OKR_OBJT_MST C ON A.DEPT_CD = C.DEPT_CD
        
                    WHERE C.PROC_ST = '0' ";

        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // 예외처리필요함 (모든부분에서)!


        $result['DWGP_CD'] = $row['DWGP_CD'];
        $result['DEPT_CD'] = $row['DEPT_CD'];
        $result['DEPT_NM'] = $row['DEPT_NM'];
        $result['DEPT_UP_NM'] = $row['DEPT_UP_NM'];
        $result['ID'] = $row['ID'];
        $OBJT_ID = $row['ID'];
        $result['OBJECTIVE'] = $row['OBJECTIVE'];


        //KR 조회
        $query = "SELECT ID, CONTENT from OKR_KEYS_MST WHERE OKR_OBJT_ID = '$OBJT_ID' AND PROC_ST NOT IN ('8', '9')";
        $stmt = sqlsrv_query($this->dbconn, $query);

        $kr_arr = array();

        while ($row2 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($kr_arr, ['ID' => $row2['ID'], 'CONTENT' => $row2['CONTENT']]);
        }

        // $result['KR'] = $kr_arr;



        //저번주 플랜 조회
   
        foreach($kr_arr as $key => $bean){
            // echo $key;
            $kr_id = $bean['ID'];

            $query = "  SELECT B.ID as PLAN_ID, B.OKR_KEYS_ID as KEY_ID , B.EMPY_NO, B.CONTENT, C.EMP_NM
                        FROM (  SELECT TOP 1 ID 
                                FROM SPR_MEET_MST 
                                WHERE MEET_DT < '$DATE' AND DEPT_CD = 'MD00000707' order by MEET_DT DESC) A 

                                INNER JOIN SPR_MEET_PLAN B ON A.ID = B.SPR_MEET_ID
                                INNER JOIN DWCTS.dbo.EMP_MST C ON B.EMPY_NO = C.EMP_NO

                        WHERE B.OKR_KEYS_ID=$kr_id ";
            

            $stmt = sqlsrv_query($this->dbconn, $query);

            $temp = [];

            while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                array_push($temp, $row3);
            }

            $kr_arr[$key]['LAST_PLAN'] = $temp;
        }

        // foreach($kr_arr as $key => $bean){
        //     foreach($bean['LAST_PLAN'] as $key2=>$bean2){
        //         echo $bean2['PLAN_ID'];
        //         echo $bean2['KEY_ID'];
        //         echo $bean2['EMPY_NO'];
        //         echo $bean2['CONTENT'];
        //         echo $bean2['EMP_NM'];
        //         echo "\n";
        //     }
        // }

        $result['KR'] = $kr_arr;



        // 사원들 리스트...(데이터가 없어서 그냥 우리팀만...)
        $query = "SELECT EMP_NO, EMP_NM 
                  FROM DWCTS.dbo.EMP_MST 
                  WHERE DEPT_CD ='MD00000707' AND USE_YN = 'Y' AND NOT EMP_NO IN ('CARD01', 'DWRPA', 'SYSTEM', 'USER01')";
        $stmt = sqlsrv_query($this->dbconn, $query);

        $temp = [];

        while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($temp, $row3);
        }

        $result['EMP_LIST'] = $temp;


        //BOOKMARK 조회
        $book_arr = array();

        $DEPT_CD = $result['DEPT_CD'];

        $query = "SELECT * FROM SPR_MEET_MST WHERE DEPT_CD = '$DEPT_CD' ORDER BY MEET_DT DESC";
        $stmt = sqlsrv_query($this->dbconn, $query);

        while ($row2 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($book_arr, ['ID' => $row2['ID'], 'MEET_DT' => $row2['MEET_DT']]);
        }

        $result['BOOKMARK'] = $book_arr;
        
        

        // $result['컬럼명']  찾아보기

        return $result;
    }

    // create spr_meet_mst (insert)
    public function insert_spr_meet_mst($arr){

        $query = "
                    INSERT INTO [dbo].[SPR_MEET_MST]
                            ([CREATE_ON]
                            ,[CREATE_BY]
                            ,[CREATE_ID]
                            ,[OKR_OBJT_ID]
                            ,[DWGP_CD]
                            ,[DEPT_CD]
                            ,[MEET_DT])
                    
                    OUTPUT INSERTED.ID
                    
                    VALUES
                        (GETDATE()
                        ,'".$arr['CREATE_BY']."'
                        ,".$arr['CREATE_ID']."
                        ,".$arr['OKR_OBJT_ID']."
                        ,'".$arr['DWGP_CD']."'
                        ,'".$arr['DEPT_CD']."'
                        ,'".$arr['MEET_DT']."'
                        )
                ";

        $stmt = sqlsrv_query($this->dbconn, $query);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        return $row['ID'];
    }
    


    // create feed, idea, plan (insert)
    public function insert_spr_content($arr){

        foreach($arr['feed'] as $key => $bean){
            if($bean['feed-plan'] && $bean['feed-high'] && $bean['feed-low']){
                // echo $bean['feed-plan'];
                // echo $bean['feed-high'];
                // echo $bean['feed-low'];

                $query = "INSERT INTO [dbo].[SPR_MEET_FEED]
                                    ([CREATE_ON]
                                    ,[CREATE_BY]
                                    ,[CREATE_ID]
                                    ,[SPR_MEET_PLAN_ID]
                                    ,[HIGHLIGHT]
                                    ,[LOWLIGHT]
                                    ,[SPR_MEET_ID])
                                    
                                VALUES
                                    (GETDATE()
                                    ,'".$arr['CREATE_BY']."'
                                    ,".$arr['CREATE_ID']."
                                    ,".$bean['feed-plan']."
                                    ,'".$bean['feed-high']."'
                                    ,'".$bean['feed-low']."'
                                    ,".$arr['SPR_MEET_ID'].") 
                            ";
                
                $stmt = sqlsrv_query($this->dbconn, $query);
            }
        }

        foreach($arr['idea'] as $key => $bean){
            if($bean['idea-kr'] && $bean['idea-name'] && $bean['idea-todo'] && $bean['idea-content']){
                // echo $bean['idea-kr'];
                // echo $bean['idea-name'];
                // echo $bean['idea-todo'];
                // echo $bean['idea-content'];

                $query = "INSERT INTO [dbo].[SPR_MEET_IDEA]
                                    ([CREATE_ON]
                                    ,[CREATE_BY]
                                    ,[CREATE_ID]
                                    ,[SPR_MEET_ID]
                                    ,[OKR_KEYS_ID]
                                    ,[OKR_TODO_ID]
                                    ,[EMPY_NO]
                                    ,[CONTENT])

                                VALUES
                                    (GETDATE()
                                    ,'".$arr['CREATE_BY']."'
                                    ,".$arr['CREATE_ID']."
                                    ,".$arr['SPR_MEET_ID']."
                                    ,".$bean['idea-kr']."
                                    ,".$bean['idea-todo']."
                                    ,'".$bean['idea-name']."'
                                    ,'".$bean['idea-content']."')";

                $stmt = sqlsrv_query($this->dbconn, $query);
            }
        }

        foreach($arr['plan'] as $key => $bean){
            if($bean['plan-kr'] && $bean['plan-name'] && $bean['plan-content']){
                // echo $bean['plan-kr'];
                // echo $bean['plan-name'];
                // echo $bean['plan-content'];

                $query = "INSERT INTO [dbo].[SPR_MEET_PLAN]
                                    ([CREATE_ON]
                                    ,[CREATE_BY]
                                    ,[CREATE_ID]
                                    ,[SPR_MEET_ID]
                                    ,[OKR_KEYS_ID]
                                    ,[EMPY_NO]
                                    ,[CONTENT])

                                VALUES
                                    (GETDATE()
                                    ,'".$arr['CREATE_BY']."'
                                    ,".$arr['CREATE_ID']."
                                    ,".$arr['SPR_MEET_ID']."
                                    ,".$bean['plan-kr']."
                                    ,'".$bean['plan-name']."'
                                    ,'".$bean['plan-content']."')"; 

                $stmt = sqlsrv_query($this->dbconn, $query);
            }

        }
    }
}