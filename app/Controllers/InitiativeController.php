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
    public function SetProgress(){
        print_r($_GET['emp_no']);
        $emp_no = $_GET['emp_no'];
        $id = $_GET['id'];
        $st = $_GET['st'];
        if($st = 'o'){
            $post_st = '7';
        }
        else if($st = 'x'){
            $post_st = '0';
        }
        $initiativeModel = new InitiativeModel();
        $initiativeModel->SetProgress($post_st,$id);
        $this->response->redirect("/main");
            
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
   
}

?>
