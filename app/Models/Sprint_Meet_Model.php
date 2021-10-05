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

    public function search_spr_by_date($date){
        $result = array();

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
        $query = "  SELECT A.OKR_OBJT_ID, A.MEET_DT, A.DEPT_NM, B.DEPT_NM as 'DEPT_UP_NM'
                    FROM	(	SELECT A.OKR_OBJT_ID, A.MEET_DT, B.DEPT_NM, B.DEPT_UP_CD 
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

            if(sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) == null){
                continue;
            }
            
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

            if(sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) == null){
                continue;
            }

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

            if(sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) == null){
                continue;
            }
            
            while ($row3 = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
            {
                array_push($temp, $row3);
            }

            array_push($plan_arr, $temp);
        }

        $result['PLAN'] = $plan_arr;



        // result의 KEY: (MEET_DT, DEPT_NM, DEPT_UP_NM, KR, FEED, IDEA, PLAN)
        // KR의     KEY: (ID, CONTENT)
        // FEED의   KEY: (HIGHLIGHT, LOWLIGHT, EMP_NM, CONTENT(저번주 plan) )
        // IDEA의   KEY: (IDEA_CONTENT, EMP_NM, TO_DO_CONTENT, INIT_CONTENT)
        // PLAN의   KEY: (EMP_NM, CONTENT )
        return $result;

    }



}