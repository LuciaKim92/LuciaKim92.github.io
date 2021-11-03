<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;
use App\Models\InitiativeModel;

class InitiativeController extends BaseController{
	public function index()
	{
        $initiativeModel = new InitiativeModel();
        $emp_no = $_GET['emp_no'];
        $mydata['id'] = $_GET['id'];
        $data = $initiativeModel->OpenInitiativeTool($mydata['id']);
        echo($data);
        echo("asdasdaads");
		//echo view("/initiative/writeModal.php", $mydata);
    }

     public function View(){
        /*
        $mydata['id'] = $_POST['id'];
        $initiativeModel = new InitiativeModel();
 
		echo view("/initiative/viewModal.php", $mydata);
        */
        echo view("/initiative/viewModal.php");
        //echo view("/initiative/test.php");
    }
    public function setProgressAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->setProgress();
        echo json_encode($id);
            
    }

    public function getInitiativeListAjax(){
        $initiativeModel = new InitiativeModel();
        $initiativeList = $initiativeModel->getInitiativeList();
        echo json_encode($initiativeList);
    }
    
    public function getTodoListAjax(){
        $initiativeModel = new InitiativeModel();
        $todoList = $initiativeModel->getTodoList();
        echo json_encode($todoList);
    }

    public function saveInitiativeAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->saveInitiative();
        echo json_encode($id);
    }

    public function saveToDoAjax(){
        $initiativeModel = new InitiativeModel();
        $cnt = count($_POST['content']);
        $i = 0;
        foreach($_POST['content'] as $key => $bean){
            $id[$i] = $initiativeModel->saveToDo($bean);
            $i++;
        }
        echo json_encode($id);
    }
    

    
    public function getInitConfTPAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->getInitConfTP();
        echo json_encode($id);
    }

    public function updateConfTPAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->updateConfTP();
        echo json_encode($id);
    }
    
    public function setTodoListProcSTAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->setTodoListProcST();
        echo json_encode($id);
    }

    public function getKRAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->getKR();
        echo json_encode($id);
    }

    public function getInitiativeProcSTAjax(){
        $initiativeModel = new InitiativeModel();
        $proc = $initiativeModel->getInitiativeProcST();
        echo json_encode($proc);
    }

    public function updateStickerMemoAjax(){
        $initiativeModel = new InitiativeModel();
        $id = $initiativeModel->updateStickerMemo();
        echo json_encode($id);
    }

    public function getStickerMemoAjax(){
        $initiativeModel = new InitiativeModel();
        $notes = $initiativeModel->getStickerMemo();
        echo json_encode($notes);
    }

    public function saveInitViewReplyAjax(){
        $initiativeModel = new InitiativeModel();
        $res = $initiativeModel->saveInitViewReply();
        echo json_encode($res);
    }
    
    public function getInitViewReplyAjax(){
        $initiativeModel = new InitiativeModel();
        $res = $initiativeModel->getInitViewReply();
        echo json_encode($res);
    }

   
}

?>
