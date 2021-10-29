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

    // OKR 바꿔야함 나중에해 분기랑 이어 조건도...
    public function return_first_team(){
        $query = "
                    SELECT A.DEPT_CD, A.DEPT_NM, B.ID OBJECTIVE_ID, B.OBJECTIVE,
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
                        AND B.OKR_YEAR = '2021'
                        AND B.OKR_QTR IS NULL
                        AND B.PROC_ST NOT IN ('8','9')  
                

                    ORDER BY A.SORT_SEQ
                ";

        
        $stmt = sqlsrv_query($this->dbconn, $query);
        
        $team_arr = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($team_arr, ['DEPT_CD' => $row['DEPT_CD'], 'DEPT_NM' => $row['DEPT_NM'], 
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
                    WHERE OKR_OBJT_ID = ".$OBJECTIVE_ID." AND PROC_ST NOT IN ('8', '9')
                 ";
        
        $stmt = sqlsrv_query($this->dbconn, $query);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($kr_arr, ['ID' => $row['ID'], 'CONTENT' => $row['CONTENT']]);
        }

        return $kr_arr;

    }

    //분기랑 이어 설정
    public function return_second_team($DEPT_UP_CD){

        $team_arr = array();

        $query = "

                    SELECT A.DEPT_CD, A.DEPT_NM, B.ID OBJECTIVE_ID, B.OBJECTIVE, B.OKR_YEAR, B.OKR_QTR, 
                           CASE WHEN EXISTS(SELECT * FROM DWCTS.DBO.DEPT_MST WHERE DEPT_UP_CD = A.DEPT_CD) THEN 'Y' ELSE 'N' END IS_UP_DEPT
                    FROM 
                            DWCTS.DBO.DEPT_MST AS A
                            LEFT OUTER JOIN 
                            DWOKR.DBO.OKR_OBJT_MST AS B
                            ON A.DEPT_CD = B.DEPT_CD
                            AND B.OKR_YEAR = '2021'
                            AND B.OKR_QTR IS NULL
                            AND B.PROC_ST NOT IN ('8','9') 
                    
                    WHERE	A.DEPT_UP_CD = '".$DEPT_UP_CD."' AND A.USE_YN = 'Y' 
                    
                    ORDER BY A.SORT_SEQ

                 ";

        $stmt = sqlsrv_query($this->dbconn, $query);

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($team_arr, ['DEPT_CD' => $row['DEPT_CD'], 'DEPT_NM' => $row['DEPT_NM'], 
                                   'OBJECTIVE_ID' => $row['OBJECTIVE_ID'], 'OBJECTIVE' => $row['OBJECTIVE'],
                                   'IS_UP_DEPT' => $row['IS_UP_DEPT']]);
        }

        return $team_arr;

    }

}