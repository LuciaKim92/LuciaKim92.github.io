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

    public function get_clip_list($id)
    {
        $query = 
                "   
                    SELECT	BB.EMPY_NO							AS CLIP_EMP_NO
                        ,	CC.EMP_NM							AS CLIP_EMP_NM
                    FROM	DBO.EXM_CASE_MST					AS AA WITH(NOLOCK)
                            INNER JOIN
                            DBO.EXM_CASE_CLIP					AS BB WITH(NOLOCK)
                            ON AA.ID = BB.EXM_CASE_ID
                            LEFT JOIN
                            DWCTS.DBO.EMP_MST					AS CC WITH(NOLOCK)
                            ON BB.EMPY_NO = CC.EMP_NO
                    WHERE	AA.PROC_ST = '7' AND AA.ID = ?
                    ORDER BY BB.EXM_CASE_ID
                ;";

        $stmt = sqlsrv_query($this->dbconn, $query, array($id));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'CLIP_EMP_NO' => $row['CLIP_EMP_NO'],
                'CLIP_EMP_NM' => $row['CLIP_EMP_NM'],
            ]);
        }

        return $result;
    }

    public function get_exm_details($params)
    {
        $stmt = sqlsrv_query($this->dbconn, '{CALL DWOKR.dbo.USP_OKR_EXM_CASE_DETAIL(?)}', $params);
        $detail_arr = array();
        $kr_arr = array();
        $clip_arr = array();

        do {
            //Key Result 가져오기
            if (sqlsrv_num_fields($stmt) == 1) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($kr_arr, [
                        'CONTENT' => $row['KR']
                    ]);
                }
            //스크랩 리스트 가져오기
            } else if (sqlsrv_num_fields($stmt) == 2) {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($clip_arr, [
                        'EMPY_NO' => $row['EMPY_NO'],
                        'EMP_NM' => $row['EMP_NM']
                    ]);
                }
            //OKR 사례 내용 가져오기
            } else {
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
                {
                    array_push($detail_arr, [
                        'OBJECTIVE' => $row['OBJECTIVE'], 
                        'CASE_TP' => $row['CASE_TP'],
                        'TITLE' => $row['TITLE'], 
                        'TARGET' => $row['TARGET'], 
                        'COTCOME' => $row['COTCOME'],
                        'CONTEXT' => $row['CONTEXT'],
                        'STRATEGY' => $row['STRATEGY'], 
                        'KNOWHOW' => $row['KNOWHOW'],
                        'PROC_ST' => $row['PROC_ST'],
                        'CONFIRM_DTM' => $row['CONFIRM_DTM'],
                        'CONFIRM_EMP_NO' => $row['CONFIRM_EMP_NO'],
                        'CONFIRM_NOTES' => $row['CONFIRM_NOTES']
                    ]);
                }
            }
        } while (sqlsrv_next_result($stmt));

        $result['DETAIL'] = $detail_arr;
        $result['KR'] = $kr_arr;
        $result['CLIP'] = $clip_arr;

        return $result;
    }

    public function get_okr_year($dept_cd)
    {
        $query = 
                "   
                    SELECT OKR_YEAR
                    FROM ( 
                        SELECT ROW_NUMBER() OVER (PARTITION BY OKR_YEAR ORDER BY OKR_YEAR) AS IDX,
                            OKR_YEAR
                        FROM OKR_OBJT_MST
                        WHERE DEPT_CD = ?
                    ) A
                    WHERE IDX < 2
                    ORDER BY OKR_YEAR DESC
                ;";

        $stmt = sqlsrv_query($this->dbconn, $query, array($dept_cd));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'OKR_YEAR' => $row['OKR_YEAR'],
            ]);
        }

        return $result;
    }

    public function get_okr_quarter($dept_cd, $year)
    {
        $query = 
                "   
                    SELECT OKR_QTR
                    FROM (
                        SELECT ROW_NUMBER() OVER (PARTITION BY OKR_QTR ORDER BY OKR_QTR) AS IDX,
                            OKR_QTR
                        FROM OKR_OBJT_MST
                        WHERE DEPT_CD = ?
                            AND OKR_YEAR = ?
                    ) A
                    WHERE IDX < 2
                    ORDER BY OKR_QTR
                ;";
       
        $stmt = sqlsrv_query($this->dbconn, $query, array($dept_cd, $year));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            if ($row['OKR_QTR'] == 0) {
                $st_qtr = 'Objective';
            } else {
                $st_qtr = strval($row['OKR_QTR']);
            }

            array_push($result, [
                'OKR_QTR' => $st_qtr,
            ]);
        }

        return $result;
    }

    public function get_okr_list($dept_cd, $year, $quarter)
    {
        $query = 
                "
                    SELECT AA.OBJECTIVE, AA.ID AS OKR_OBJT_ID, BB.CONTENT, BB.ID AS OKR_KEYS_ID
                    FROM OKR_OBJT_MST AS AA WITH(NOLOCK)
                        LEFT JOIN
                        OKR_KEYS_MST AS BB WITH(NOLOCK)
                        ON AA.ID = BB.OKR_OBJT_ID
                    WHERE AA.DEPT_CD = ?
                        AND AA.OKR_YEAR = ?
                        AND AA.OKR_QTR = ?
                ;";
        $stmt = sqlsrv_query($this->dbconn, $query, array($dept_cd, $year, $quarter));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'OBJECTIVE' => $row['OBJECTIVE'],
                'OKR_OBJT_ID' => $row['OKR_OBJT_ID'],
                'CONTENT' => $row['CONTENT'],
                'OKR_KEYS_ID' => $row['OKR_KEYS_ID']
            ]);
        }

        return $result;
    }

    public function get_okr_initiatives($kr_id, $empy_no)
    {
        $query = 
                "
                    SELECT ID, CONTENT
                    FROM OKR_INIT_MST
                    WHERE OKR_KEYS_ID = ?
                        AND (PROC_ST = '0' OR PROC_ST = '7')
                        AND EMPY_NO = ?
                ;";
        $stmt = sqlsrv_query($this->dbconn, $query, array($kr_id, $empy_no));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'ID' => $row['ID'],
                'CONTENT' => $row['CONTENT'],
            ]);
        }

        return $result;
    }

    public function save_exm_case($params)
    {
        var_dump($params);
        $stmt = sqlsrv_query($this->dbconn, '{CALL DWOKR.dbo.USP_OKR_EXM_CASE_SAVE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)}', $params);

        /*if ($stmt) {  
            echo "Row successfully inserted.\n";  
        } else {  
            echo "Row insertion failed.\n";  
            die(print_r(sqlsrv_errors(), true));  
        } */ 

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $result = array (
            'ERROR_NUMBER' => $row['ERROR_NUMBER'], 
            'ERROR_MESSAGE' => $row['ERROR_MESSAGE'], 
            'RETURN_VALUE' => $row['RETURN_VALUE']
        );
        
        return $result;
    }

    public function get_saved_cases($emp_no)
    {
        $query = 
                "
                    SELECT ID, CONVERT(CHAR(20), CREATE_ON, 120) AS DATE, TITLE,
                        CONFIRM_DTM, CONFIRM_NOTES
                    FROM EXM_CASE_MST
                    WHERE EMPY_NO = ? AND PROC_ST = 0
                ;";
        $stmt = sqlsrv_query($this->dbconn, $query, array($emp_no));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'ID' => $row['ID'],
                'DATE' => $row['DATE'],
                'TITLE' => $row['TITLE'],
                'CONFIRM_DTM' => $row['CONFIRM_DTM'],
                'CONFIRM_NOTES' => $row['CONFIRM_NOTES'],
            ]);
        }

        return $result;
    }

    public function get_saved_okr_view($okr_init_id)
    {
        $query = 
                "
                    SELECT DD.DEPT_CD, DD.OKR_YEAR, DD.OKR_QTR, DD.ID AS OKR_OBJT_ID, CC.ID AS OKR_KEYS_ID
                    FROM EXM_CASE_MST AS AA WITH(NOLOCK)
                        LEFT JOIN
                        OKR_INIT_MST AS BB WITH(NOLOCK)
                        ON BB.ID = AA.OKR_INIT_ID
                        LEFT JOIN
                        OKR_KEYS_MST AS CC WITH(NOLOCK)
                        ON CC.ID = BB.OKR_KEYS_ID
                        LEFT JOIN
                        OKR_OBJT_MST AS DD WITH(NOLOCK)
                        ON DD.ID = CC.OKR_OBJT_ID
                    WHERE OKR_INIT_ID = ?
                ;";
        $stmt = sqlsrv_query($this->dbconn, $query, array($okr_init_id));
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $result = array(
            'DEPT_CD' => $row['DEPT_CD'],
            'OKR_YEAR' => $row['OKR_YEAR'],
            'OKR_QTR' => $row['OKR_QTR'],
            'OKR_OBJT_ID' => $row['OKR_OBJT_ID'],
            'OKR_KEYS_ID' => $row['OKR_KEYS_ID'],
        );

        return $result;
    }

    public function get_saved_cases_detail($id)
    {
        $query = 
                "
                    SELECT ID, OKR_INIT_ID, CASE_TP, TITLE, TARGET, COTCOME,
                        CONTEXT, STRATEGY, KNOWHOW,
                        CONVERT(CHAR(20), CONFIRM_DTM, 120) AS CONFIRM_DTM, BB.EMP_NM AS CONFIRM_EMP_NM, CONFIRM_NOTES
                    FROM EXM_CASE_MST AS AA WITH(NOLOCK)
                        LEFT JOIN
                        DWCTS.DBO.EMP_MST AS BB WITH(NOLOCK)
                        ON AA.CONFIRM_EMP_NO = BB.EMP_NO
                    WHERE ID = ?
                ;";
        $stmt = sqlsrv_query($this->dbconn, $query, array($id));
        $result = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
        {
            array_push($result, [
                'ID' => $row['ID'],
                'OKR_INIT_ID' => $row['OKR_INIT_ID'],
                'CASE_TP' => $row['CASE_TP'],
                'TITLE' => $row['TITLE'],
                'TARGET' => $row['TARGET'],
                'COTCOME' => $row['COTCOME'],
                'CONTEXT' => $row['CONTEXT'],
                'STRATEGY' => $row['STRATEGY'],
                'KNOWHOW' => $row['KNOWHOW'],
                'CONFIRM_DTM' => $row['CONFIRM_DTM'],
                'CONFIRM_EMP_NM' => $row['CONFIRM_EMP_NM'],
                'CONFIRM_NOTES' => $row['CONFIRM_NOTES']
            ]);
        }

        return $result;
    }

}