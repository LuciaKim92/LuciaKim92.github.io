<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;
use App\Models\Sprint_Meet_Model;
use App\Models\InitiativeModel;

class InitiativeController extends BaseController{
	public function index()
	{
        //echo 
        $mydata['id'] = $_POST['id'];
		echo view("/initiative/write.php", $mydata);
	}
}

?>
