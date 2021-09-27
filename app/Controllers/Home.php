<?php

namespace App\Controllers;
use App\Models\DashBoardModel;
use App\Models\LayoutModel;

class Home extends BaseController
{
	public function index()
	{
		return view('comment.php');
	}
	public function session_setting(){
		$this->response = \Config\Services::response();
		$this->session = \Config\Services::session();
		$user_data = array(
			"admin_ids" => 'id',
			"admin_names" => '이유진',
			"emp_no" => '1234',
			"logged_in" => TRUE
		);
		$this->session->set($user_data);
	}

	public function dashboard()
	{
		$this->session_setting();
		$data = $_SESSION;
		return view("index.php",$data);
	}

	public function sprint_list()
	{
		$this->session_setting();
		$data = $_SESSION;
		return view("/sprint/sprint_list.php",$data);
	}

	// sprint meeting 회의록 작성
	public function sprint()
	{
		//1. 저번주에 회의록에 작성한 다음주 할 일 부분 (피드백 부분에서 불러올거임)
		$last_week_plan1 = array("kr" => "1", "담당자" => "고지훈", "할일" => "개발하기1");
		$last_week_plan2 = array("kr" => "1", "담당자" => "이유진", "할일" => "개발하기2");
		$last_week_plan3 = array("kr" => "2", "담당자" => "김경민", "할일" => "개발하기3");
		$last_week_plan4 = array("kr" => "2", "담당자" => "고지훈", "할일" => "개발하기4");
		$last_week_plan5 = array("kr" => "3", "담당자" => "이유진", "할일" => "개발하기5");
		$last_week_plan6 = array("kr" => "3", "담당자" => "김경민", "할일" => "개발하기6");
		$last_week_plan7 = array("kr" => "4", "담당자" => "고지훈", "할일" => "개발하기7");
		$last_week_plan8 = array("kr" => "4", "담당자" => "이유진", "할일" => "개발하기8");
		$last_week_plan9 = array("kr" => "5", "담당자" => "김경민", "할일" => "개발하기9");
		$last_week_plan10 = array("kr" => "5", "담당자" => "고지훈", "할일" => "개발하기10");
		
		//2. KR에 따른 데이터 모음집 (피드백 부분)
		$kr1_last_week_plan = array("1"=>$last_week_plan1, "2"=>$last_week_plan2);
		$kr2_last_week_plan = array("1"=>$last_week_plan3, "2"=>$last_week_plan4);
		$kr3_last_week_plan = array("1"=>$last_week_plan5, "2"=>$last_week_plan6);
		$kr4_last_week_plan = array("1"=>$last_week_plan7, "2"=>$last_week_plan8);
		$kr5_last_week_plan = array("1"=>$last_week_plan9, "2"=>$last_week_plan10);

		//3. 피드백 부분 데이터
		$feedback = array(
			"1"=> $kr1_last_week_plan,
			"2"=> $kr2_last_week_plan,
			"3"=> $kr3_last_week_plan,
			// "4"=> $kr4_last_week_plan,
			// "5"=> $kr5_last_week_plan,
		);

		
		// KEY RESULT 배열
		$kr = array(
			"1" => "나는 kr 1 입니다",
			"2" => "나는 kr 2 입니다",
			"3" => "나는 kr 3 입니다",
			// "4" => "나는 kr 4 입니다",
			// "5" => "나는 kr 5 입니다",
		);



		//담당자 배열
		$manager = array(
			["이름" => "고지훈", "사원번호" => "111"],
			["이름" => "이유진", "사원번호" => "222"],
			["이름" => "김경민", "사원번호" => "333"],
		);


		$mydata['myarray'] = $kr;
		$mydata['feedback'] = $feedback;
		$mydata['manager'] = $manager;

		$this->session_setting();
		$data = $_SESSION;
		return view('sprint.php', $mydata);

	}

	// sprint meeting 회의록 보여주는거
	public function sprint2(){

		//feedback 데이터
		$feedback_list_1 = array(
			["담당자" => "고지훈", "한일" => "스프린트 회의록 양식 개발", "high" => "조금 손보면 될것 같네!", "low" => "잘했네"],
			["담당자" => "이유진", "한일" => "데쉬보드 UI 개발", "high" => "이 부분 조금만 수정하게!", "low" => "잘했어"],
			["담당자" => "김경민", "한일" => "스프린트 회의록 목록 개발", "high" => "좀더 해보게!", "low" => "잘했어 잘했어"],
		);

		$feedback_list_2 = array(
			["담당자" => "고지훈2", "한일" => "스프린트 회의록 양식 개발2", "high" => "조금 손보면 될것 같네!", "low" => "잘했네"],
			["담당자" => "이유진2", "한일" => "데쉬보드 UI 개발2", "high" => "이 부분 조금만 수정하게!", "low" => "잘했어"],
		);

		$feedback_list_3 = array(
			["담당자" => "김경민3", "한일" => "스프린트 회의록 목록 개발3", "high" => "좀더 해보게!", "low" => "잘했어 잘했어"],
		);

		//idea 데이터
		$idea_list_1 = array(
			["담당자" => "고지훈", "전략" => "밤 세워서 개발하기!", "아이디어" => "카페인을 섭취하기"],
		);

		$idea_list_2 = array(
			["담당자" => "고지훈", "전략" => "오류없는 개발하기!", "아이디어" => "인터넷 찾아보기"],
			["담당자" => "이유진", "전략" => "즐겁게 개발하기!", "아이디어" => "충분한 휴식시간 갖기"],
		);

		$idea_list_3 = array(
			["담당자" => "고지훈", "전략" => "밤 세워서 개발하기!", "아이디어" => "카페인을 섭취하기"],
			["담당자" => "이유진", "전략" => "밤 세워서 개발하기!", "아이디어" => "카페인을 섭취하기"],
			["담당자" => "김경민", "전략" => "밤 세워서 개발하기!", "아이디어" => "카페인을 섭취하기"],
		);

		//plan 데이터
		$plan_list_1 = array(
			["담당자" => "고지훈", "할일" => "스프린트 미팅 회의록 화면 구현하기"],
			["담당자" => "이유진", "할일" => "데쉬보드 화면 구현하기"],
			["담당자" => "김경민", "할일" => "스프린트 미팅 목록 구현하기"],
		);

		$plan_list_2 = array(
			["담당자" => "고지훈2", "할일" => "스프린트 미팅 회의록 화면 구현하기2"],
			["담당자" => "이유진2", "할일" => "데쉬보드 화면 구현하기2"],
			["담당자" => "김경민2", "할일" => "스프린트 미팅 목록 구현하기2"],
		);

		$plan_list_3 = array(
			["담당자" => "고지훈3", "할일" => "스프린트 미팅 회의록 화면 구현하기3"],
			["담당자" => "이유진3", "할일" => "데쉬보드 화면 구현하기3"],
			["담당자" => "김경민3", "할일" => "스프린트 미팅 목록 구현하기3"],
		);

		//KEY RESULT 배열 3개만 있다고 가정
		$kr_list = array(
			["index" => "1", "content" => "kr1 입니다.", "feedback" => $feedback_list_1, "idea" => $idea_list_1, "plan" => $plan_list_1],
			["index" => "2", "content" => "kr2 입니다.", "feedback" => $feedback_list_2, "idea" => $idea_list_2, "plan" => $plan_list_2],
			["index" => "3", "content" => "kr3 입니다.", "feedback" => $feedback_list_3, "idea" => $idea_list_3, "plan" => $plan_list_3]
		);

		$mydata['myarray'] = $kr_list;

		$this->session_setting();
		$data = $_SESSION;

		return view('sprint2.php', $mydata);
	}

	public function getDashBoardData(){
		$this->dashBoardModel=new DashBoardModel();
		//dashBoardModel->GetDashBoardData($_SESSION['admin_id']);
		$kr = array();     // 배열 생성
		$kr[0] = "apple";  // 배열 요소 추가
		$kr[1] = "banana";
		$kr[2] = "orange";
		$data = array(
			
		);
	}


}

?>
