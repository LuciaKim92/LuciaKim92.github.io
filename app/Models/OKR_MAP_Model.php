<?php
namespace App\Models;

use CodeIgniter\Model;

class OKR_MAP_Model extends Model
{
    public function __construct(){
        $this->serverName = "211.233.21.82";
        $this->connectionOptions = array(
            "database" => "DWOKR", // 데이터베이스명
            "uid" => "dwokr",   // 유저 아이디
            "pwd" => "dwokr@)@!21",    // 유저 비번
            "CharacterSet" => "UTF-8"
        );

        $this->dbconn = sqlsrv_connect($this->serverName, $this->connectionOptions); 
    }

    
    //대원씨티에스... 이렇게 여러번 하면 좋지 않지만 방법이 없으므로 그냥 분리
    public function return_dwcts($YEAR, $QTR){
        $query = "
                    SELECT A.DEPT_CD, A.DWGP_CD, A.DEPT_NM, B.ID OBJECTIVE_ID, B.OBJECTIVE,
                    CASE WHEN EXISTS(SELECT * FROM DWCTS.DBO.DEPT_MST WHERE DEPT_UP_CD = A.DEPT_CD) THEN 'Y' ELSE 'N' END IS_UP_DEPT

                    FROM	DWCTS.DBO.DEPT_MST AS A
                    LEFT OUTER JOIN DBO.OKR_OBJT_MST AS B
                    ON A.DEPT_CD = B.DEPT_CD
                    AND B.OKR_YEAR = ?
                    AND B.OKR_QTR = ?
                    AND B.PROC_ST NOT IN ('8','9')
                    
                    WHERE A.DEPT_CD = 'MD00000002'
                ";

        $stmt = sqlsrv_query($this->dbconn, $query, array($YEAR, $QTR));

        $arr = array();
        
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($arr, ['DEPT_CD' => $row['DEPT_CD'], 'DWGP_CD' => $row['DWGP_CD'],'DEPT_NM' => $row['DEPT_NM'], 
                                'OBJECTIVE_ID' => $row['OBJECTIVE_ID'], 'OBJECTIVE' => $row['OBJECTIVE'], 
                                'IS_UP_DEPT' => $row['IS_UP_DEPT']]);
        }

        return $arr;
    
    }


    // 대원씨티에스 밑
    public function return_first_team($YEAR, $QTR){
        $query = "
                    SELECT A.DEPT_CD, A.DWGP_CD, A.DEPT_NM, B.ID OBJECTIVE_ID, B.OBJECTIVE,
                           CASE WHEN EXISTS(SELECT * FROM DWCTS.DBO.DEPT_MST WHERE DEPT_UP_CD = A.DEPT_CD) THEN 'Y' ELSE 'N' END IS_UP_DEPT
                    FROM
                        (
                            SELECT * 
                            FROM DWCTS.DBO.DEPT_MST 
                            WHERE DEPT_CD NOT IN ('MD00000890', 'MD00000774', 'MD00000792', 'MD00000881') AND DEPT_UP_CD IN ('MD00000002', 'MD00000881')  AND USE_YN = 'Y'
                    
                            UNION
                    
                            SELECT * 
                            FROM DWCTS.DBO.DEPT_MST 
                            WHERE DEPT_CD = 'MD00000727'
                        ) AS A
                        LEFT OUTER JOIN DWOKR.DBO.OKR_OBJT_MST AS B
                        ON A.DEPT_CD = B.DEPT_CD
                        AND B.OKR_YEAR = ?
                        AND B.OKR_QTR = ?
                        AND B.PROC_ST NOT IN ('8','9')  
                

                    ORDER BY A.SORT_SEQ
                ";

        
        $stmt = sqlsrv_query($this->dbconn, $query, array($YEAR, $QTR));
        
        $team_arr = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($team_arr, ['DEPT_CD' => $row['DEPT_CD'], 'DWGP_CD' => $row['DWGP_CD'],'DEPT_NM' => $row['DEPT_NM'], 
                                   'OBJECTIVE_ID' => $row['OBJECTIVE_ID'], 'OBJECTIVE' => $row['OBJECTIVE'], 
                                   'IS_UP_DEPT' => $row['IS_UP_DEPT']]);
        }

        return $team_arr;
            
    }

    public function return_KR($OBJECTIVE_ID){

        $kr_arr = array();

        if($OBJECTIVE_ID == NULL){
            return false;
        }

        $query = "
                    SELECT * 
                    FROM OKR_KEYS_MST
                    WHERE OKR_OBJT_ID = ?
                    AND PROC_ST NOT IN ('8', '9')
                 ";
        
        $stmt = sqlsrv_query($this->dbconn, $query, array($OBJECTIVE_ID));

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($kr_arr, ['ID' => $row['ID'], 'CONTENT' => $row['CONTENT'], 'PROC_RAT' => round($row['PROC_RAT'])]);
        }

        return $kr_arr;

    }

    //분기랑 이어 설정
    public function return_second_team($DEPT_UP_CD, $YEAR=null, $QTR=null){

        $team_arr = array();

        $query = "

                    SELECT A.DEPT_CD, A.DWGP_CD, A.DEPT_NM, B.ID OBJECTIVE_ID, B.OBJECTIVE, B.OKR_YEAR, B.OKR_QTR, 
                           CASE WHEN EXISTS(SELECT * FROM DWCTS.DBO.DEPT_MST WHERE DEPT_UP_CD = A.DEPT_CD) THEN 'Y' ELSE 'N' END IS_UP_DEPT
                    FROM 
                            DWCTS.DBO.DEPT_MST AS A
                            LEFT OUTER JOIN 
                            DWOKR.DBO.OKR_OBJT_MST AS B
                            ON A.DEPT_CD = B.DEPT_CD
                            AND B.OKR_YEAR = ?
                            AND B.OKR_QTR = ?
                            AND B.PROC_ST NOT IN ('8','9') 
                    
                    WHERE	A.DEPT_UP_CD = ? AND A.USE_YN = 'Y' 
                    
                    ORDER BY A.SORT_SEQ

                 ";

        $stmt = sqlsrv_query($this->dbconn, $query, array($YEAR, $QTR, $DEPT_UP_CD));

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($team_arr, ['DEPT_CD' => $row['DEPT_CD'], 'DWGP_CD' => $row['DWGP_CD'], 'DEPT_NM' => $row['DEPT_NM'], 
                                   'OBJECTIVE_ID' => $row['OBJECTIVE_ID'], 'OBJECTIVE' => $row['OBJECTIVE'],
                                   'IS_UP_DEPT' => $row['IS_UP_DEPT']]);
        }

        return $team_arr;

    }

    public function update_objective($objective_id, $content, $update_id, $update_by){
        
        $query = "
                    UPDATE [dbo].[OKR_OBJT_MST]
                        SET 
                            [UPDATE_ON] = GETDATE()
                            ,[UPDATE_BY] = ?
                            ,[UPDATE_ID] = ?
                            ,[OBJECTIVE] = ?
                    WHERE ID = ?

                ";

        $stmt = sqlsrv_query($this->dbconn, $query, array($update_by, $update_id, $content, $objective_id));
    }

    // 여기서부터 고쳐야함
    public function create_objective($dept_cd, $dwgp_cd, $content, $create_id, $create_by, $empy_no, $year, $qtr){
        
        $query = "
                    INSERT INTO [dbo].[OKR_OBJT_MST]
                        ([CREATE_ON]
                        ,[CREATE_BY]
                        ,[CREATE_ID]
                        ,[DWGP_CD]
                        ,[DEPT_CD]
                        ,[EMPY_NO]
                        ,[OKR_YEAR]
                        ,[OKR_QTR]
                        ,[OBJECTIVE]
                        ,[PROC_ST])
                    VALUES
                        (GETDATE()
                        ,?
                        ,?
                        ,?
                        ,?
                        ,?
                        ,?
                        ,?
                        ,?
                        ,'0')

                    ";
        $stmt = sqlsrv_query($this->dbconn, $query, array($create_by, $create_id, $dwgp_cd, $dept_cd, $empy_no, $year, $qtr, $content) );
    }

    // KR 상태도 변경
    public function delete_objective($objective_id){

        $query="";

        $query = $query."
                            UPDATE [dbo].[OKR_OBJT_MST]
                                SET 
                                    [PROC_ST] = '9'
                            WHERE ID = ?

                        ";


        $query = $query."
                            UPDATE [dbo].[OKR_KEYS_MST]
                                SET
                                    [PROC_ST] = '9'
                            WHERE OKR_OBJT_ID = ?
                        ";

        $stmt = sqlsrv_query($this->dbconn, $query, array($objective_id, $objective_id) );

    }

    // KR등록수정삭제 (삭제시 어떻게할지 생각해야함)
    public function edit_kr($arr, $create_by, $create_id, $objective_id, $dept_cd){

        $query = '';

        foreach($arr as $key => $bean){
            
            // update
            // ,[PROC_RAT] = <PROC_RAT, decimal(17,5),>
            // ,[PROC_ST] = <PROC_ST, char(1),>
            if($bean['ID'] != NULL){
                if($bean['IS_DELETE'] == 'Y'){
                    $temp = "
                            UPDATE [dbo].[OKR_KEYS_MST]
                                SET 
                                 [UPDATE_ON] = GETDATE()
                                ,[UPDATE_BY] = '".$create_by."'
                                ,[UPDATE_ID] = ".$create_id."
                                ,[PROC_ST] = '9'
                            WHERE ID = ".$bean['ID']."
                            ";
                }

                else{

                    $temp = "
                            UPDATE [dbo].[OKR_KEYS_MST]
                                SET 
                                [UPDATE_ON] = GETDATE()
                                ,[UPDATE_BY] = '".$create_by."'
                                ,[UPDATE_ID] = ".$create_id."
                                ,[PROC_RAT] = ".$bean['PROC_RAT']."
                                ,[CONTENT] = '".$bean['CONTENT']."'
                            WHERE ID = ".$bean['ID']."
                            ";
                }

                $query = $query.$temp;
            }

            // create
            else if($bean['CONTENT'] != NULL){
                    $temp = "
                            INSERT INTO [dbo].[OKR_KEYS_MST]
                                ([CREATE_ON]
                                ,[CREATE_BY]
                                ,[CREATE_ID]
                                ,[OKR_OBJT_ID]
                                ,[CONTENT]
                                ,[PROC_RAT]
                                ,[PROC_ST]
                                ,[DEPT_CD])
                            VALUES
                                (GETDATE()
                                ,'".$create_by."'
                                ,".$create_id."
                                ,".$objective_id."
                                ,'".$bean['CONTENT']."'
                                ,".$bean['PROC_RAT']."
                                ,'0'
                                ,'".$dept_cd."')
                        ";
        
                    $query = $query.$temp;

            }
        }

        $stmt = sqlsrv_query($this->dbconn, $query);
    }

    // insert_KR()
    // delete_KR()
    // update_KR()

    public function return_init(){

        // 진행중, 완료
        $ongoing=0;
        $complete=0;

        //(?,?,?) >>. 이거하려고
        $temp='';
        for($i=0; $i<sizeof($_POST['kr_arr']); $i++){
            $temp = $temp.'?,';
        }
        $temp = rtrim($temp, ",");


        $query = "
                    SELECT A.ID KR_ID, A.CONTENT KR_CONTENT, D.EMP_NM, B.SORT_SEQ, B.EMPY_NO, C.ID INIT_ID, C.CONTENT INIT_CONTENT, C.PROC_ST
                    FROM
                        DBO.OKR_KEYS_MST AS A
                        INNER JOIN 
                        DWCTS.DBO.EMP_MST AS D
                        ON A.DEPT_CD = D.DEPT_CD
                        INNER JOIN
                        DBO.OKR_ORGN_MAP AS B
                        ON A.DEPT_CD = B.DEPT_CD
                        AND D.EMP_NO = B.EMPY_NO
                        INNER JOIN 
                        DBO.OKR_INIT_MST AS C
                        ON  A.ID = C.OKR_KEYS_ID
                        AND B.EMPY_NO = C.EMPY_NO
                                        
                    WHERE A.ID IN (".$temp.")
                    AND   C.PROC_ST NOT IN ('8', '9')
                    ORDER BY B.SORT_SEQ,  A.ID, C.ID
        
                    ";
    
        $stmt = sqlsrv_query($this->dbconn, $query, $_POST['kr_arr'] );
    
        $arr = array();
    
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            if(!array_key_exists($row['EMP_NM'], $arr)){
                $arr[$row['EMP_NM']] = array();
                $ongoing = 0;
                $complete = 0;
            }

            switch($row['PROC_ST']){
                case '0':
                    $ongoing++;
                    break;

                case '7':
                    $complete++;
                    break;

                default:
                    break;
            }

            array_push($arr[$row['EMP_NM']], ['KR_ID' => $row['KR_ID'], 'KR_CONTENT' => $row['KR_CONTENT'], 'SORT_SEQ' => $row['SORT_SEQ'], 
                              'EMPY_NO' => $row['EMPY_NO'], 'INIT_ID' => $row['INIT_ID'], 'INIT_CONTENT' => $row['INIT_CONTENT'], 'PROC_ST' => $row['PROC_ST']]);

            $arr[$row['EMP_NM']]['ONGOING'] = $ongoing;
            $arr[$row['EMP_NM']]['COMPLETE'] = $complete;
        }

        return $arr;
    
    }

    public function return_up_depts(){
        $query = "
                    SELECT A.DEPT_CD DEPT_CD_1, B.DEPT_CD DEPT_CD_2, C.DEPT_CD DEPT_CD_3, D.DEPT_CD DEPT_CD_4
                    FROM 
                        DWCTS.DBO.DEPT_MST A
                        LEFT OUTER JOIN
                        DWCTS.DBO.DEPT_MST B
                        ON A.DEPT_UP_CD = B.DEPT_CD
                        LEFT OUTER JOIN
                        DWCTS.DBO.DEPT_MST C
                        ON B.DEPT_UP_CD = C.DEPT_CD
                        LEFT OUTER JOIN
                        DWCTS.DBO.DEPT_MST D
                        ON C.DEPT_UP_CD = D.DEPT_CD
                    
                    WHERE A.DEPT_CD = ?
                ";

        $stmt = sqlsrv_query($this->dbconn, $query, array($_SESSION['dept_cd']));

        $arr = array();
    
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($arr, ["DEPT_CD_1" => $row['DEPT_CD_1'], "DEPT_CD_2" => $row['DEPT_CD_2'], "DEPT_CD_3" => $row['DEPT_CD_3'], "DEPT_CD_4" => $row['DEPT_CD_4']]);
        }

        return $arr;
    }

}