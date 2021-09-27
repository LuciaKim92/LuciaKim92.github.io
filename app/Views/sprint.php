<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>Jquery Comments Plugin</title>

    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/App.css" />
	<!-- <link rel="stylesheet"
  		  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  		  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
  		  crossorigin="anonymous" /> -->
	<script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>
    
    <link href="/css/sprint.css" rel="stylesheet" type="text/css" />
    <?php echo view("/layout/header"); ?>
</head>

<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">


    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

    <?php echo view("/layout/nav-bar"); ?>

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <?php echo view("layout/side_menu"); ?>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!-- END: Left Aside -->

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">Sprint Meeting 회의록 작성</h3>
							</div>
                            
                            <div>
                                <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                                    <span class="m-subheader__daterange-label">
                                        <span class="m-subheader__daterange-title"></span>
                                        <span class="m-subheader__daterange-date m--font-brand"></span>
                                    </span>
                                    <a href="#" class="btn btn-sm btn-brand m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--square">
                                        <i class="la la-angle-down"></i>
                                    </a>
                                </span>
                            </div>
						</div>
					</div>

                    <!-- 시작하는부분 -->
					<!-- END: Subheader -->


                    <!-- 책갈피 Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">회의록 목록</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>2021-09-13 (클릭시 이동)</h5>
                                <p>세부내용</p>
                                <hr>
                                <h5>2021-09-14 (클릭시 이동)</h5>
                                <p>세부내용</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                            </div>
                        </div>
                    </div>

                    <!-- 옆에 따라다니는 메뉴 (책갈피, 작성/수정하기, 목록으로) -->
                    <ul class="m-nav-sticky" style="margin-top: 30px; background-color:#282733;">

                        <li id="sprint-sticky-li" class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="책갈피">
                            <a onclick="test()" style="cursor:pointer"><i class="la la-bookmark"><button id="sprint-sticky-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="저장하기">
                            <a href="https://keenthemes.com/metronic/documentation.html" target="_blank"><i class="la la-save"></i></a>
                        </li>
                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="목록으로">
                            <a href="/home/sprint_list" ><i class="la la-list"></i></a>
                        </li>
                    </ul>

					<div class="m-content">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                    <div class="m-portlet__body" style="padding:0px">
                                        <table class="table table-bordered" id="sprint-table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">부분(본부)/팀</th>
                                                    <th>경영기획부분/IT혁신팀</th>
                                                </tr>
                                            </tbody>
                                        </table>                                                
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Objective</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="display:table; text-align:center; width:100%">
                                                <h1 style="display:table-cell; vertical-align:middle;">Objective Contents</h1>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-8">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">

                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Key Results</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="padding:0px">
                                                <table class="table table-bordered" id="sprint-table" style="height:150px">
                                                    <tbody>
                                                        <?php
                                                            if(sizeof($myarray)){
                                                                foreach($myarray as $key=>$bean){

                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row" style="width:10%"><?=$key?></th>
                                                                        <td><?=$bean?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                            <!-- <div class="m-portlet__head">
                                            </div> -->
                                            <div class="m-portlet__body" id="sprint-content-container" >
                                                <table class="table table-bordered" id="sprint-content">

                                                    <!-- 피드백부분+달력부분 -->
                                                    <tbody>

                                                        <!--달력부분 차후 날짜변경시 그 날짜의 회의록 불러오도록 함수 추가해야함-->
                                                        <tr style="background-color:#fffc9e">
                                                            <td colspan="4" style="text-align:center"><input type="date" class="form-control" style="display:inline-block; width:150px; text-align:center;" placeholder="date input" value="2019-09-09"></td>
                                                        </tr>

                                                        <tr style="background-color:#dae8fc">
                                                            <th scope="col" class="disable" id="table-head">KR</th>
                                                            <th scope="col" class="disable" id="table-head">담당자</th>
                                                            <th scope="col" class="disable" style="width:40%">지난주 한 일</th>
                                                            <th scope="col" style="width:100%">피드백</th>
                                                        </tr>

                                                        <?php
                                                            foreach($feedback as $key=>$bean){
                                                                ?>
                                                                
                                                                <tbody id="feedback-kr-<?=$key?>">
                                                                    <tr>
                                                                        <th class="KR" id="feedback-kr-<?=$key?>-head" rowspan="6">
                                                                            Key Result <?=$key?>
                                                                        </th>   
                                                                    </tr>
                                                                <?php
                                                                foreach($bean as $key2=>$bean2){
                                                                    ?>
                                                                    <script>
                                                                        $(document).ready(function(){
                                                                            add_colum('feedback-kr-<?=$bean2['kr']?>', '<?=$bean2['담당자']?>', '<?=$bean2['할일']?>');
                                                                        });
                                                                    </script>
                                                                    <?php
                                                                }
                                                                ?>
                                                                </tbody>
                                                                <?php
                                                            }
                                                        ?>

                                                    </tbody>

                                                    <!-- 아이디어부분 -->
                                                    <tbody>
                                                        <tr style="background-color:#ffccc9">
                                                            <th class="disable">KR</th>
                                                            <th class="disable"> 담당자</th>
                                                            <th class="disable">Initiatives(전략)</th>
                                                            <th>아이디어</th>
                                                        </tr>

                                                        <?php
                                                            foreach($myarray as $key=>$bean){
                                                                ?>
                                                                <tbody id="idea-kr-<?=$key?>">
                                                                    <tr>
                                                                        <th class="KR" rowspan="2" id="idea-kr-<?=$key?>-head">
                                                                            Key Result <?=$key?>
                                                                        </th>
                                                                    </tr>

                                                                <?php
                                                                    for($i=0; $i<2; $i++){
                                                                        ?>
                                                                        <script>
                                                                            $(document).ready(function(){
                                                                                add_colum('idea-kr-<?=$key?>');
                                                                            });
                                                                        </script>    

                                                                        <?php
                                                                    }    
                                                                    ?>
                                                                    
                                                                </tbody>
                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('idea-kr-<?=$key?>')">+</button>
                                                                        <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('idea-kr-<?=$key?>')">-</button>
                                                                    </td>
                                                                 </tr>   

                                                                <?php

                                                            }
                                                        ?>
                                                    </tbody>

                                                    <!-- 다음주할일부분 -->
                                                    <tbody>
                                                        <tr style="background-color:#b0dcb0">
                                                            <th class="disable">KR</th>
                                                            <th class="disable">담당자</th>
                                                            <th colspan="2">다음주 할 일</th>
                                                        </tr>

                                                        <?php
                                                            foreach($myarray as $key=>$bean){
                                                                ?>
                                                                <tbody id="plan-kr-<?=$key?>">
                                                                    <tr>
                                                                        <th class="KR" rowspan="2" id="plan-kr-<?=$key?>-head">
                                                                            Key Result <?=$key?>
                                                                        </th>
                                                                    </tr>

                                                                <?php
                                                                    for($i=0; $i<2; $i++){
                                                                        ?>
                                                                        <script>
                                                                            $(document).ready(function(){
                                                                                add_colum('plan-kr-<?=$key?>');
                                                                            });
                                                                        </script>    

                                                                        <?php
                                                                    }    
                                                                    ?>
                                                                    
                                                                </tbody>
                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('plan-kr-<?=$key?>')">+</button>
                                                                        <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('plan-kr-<?=$key?>')">-</button>
                                                                    </td>
                                                                 </tr>   

                                                                <?php

                                                            }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			</div>

			<!-- end:: Body -->
            <!-- 끝나는 부분 -->
            </div>
        </div>

    </div>  

    	<!--begin::Global Theme Bundle -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/demo12/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<script src="/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>

		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="/assets/app/js/dashboard.js" type="text/javascript"></script>

		<!--end::Page Scripts -->
                                                        
</body>

<!-- 스프린트.js-->
<script>
    function test(){
        document.getElementById('sprint-sticky-button').click();
    }

    function add_colum(b, manager, task){
        var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

        switch(b.split('-')[0])
        {
            case 'feedback':
                var html = "<tr class='separator'><td rowspan='2' style='text-align:center'>" + manager + "</td><td rowspan='2'>" + task +
                "</td><td><textarea rows='3' col='30' style='width:100%;' placeholder='high)'></textarea></td></tr>" +  
                "<tr><td><textarea rows='3' col='30' style='width:100%' placeholder='low)'></textarea></td></tr>";
                break;

            case 'idea':
                var html = `<tr class='separator'>
                                <td>
                                    <select onchange="this.value=this.options[this.selectedIndex].value; change_child(this)">
                                    <option value="none">=== 선택 ===</option>
                                    <?php
                                        foreach($manager as $key=>$bean){
                                            ?>
                                            <option value="<?=$bean['사원번호']?>"><?=$bean['이름']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td id='div_chk' value="123">
                                    <select style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'></select>
                                </td>

                                <td><textarea rows='3' col='30' style='width:100%' placeholder='[아이디어]'></textarea></td></td>
                            </tr>`;
                break;

            case 'plan':
                var html =  `<tr class='separator'>
                                <td>
                                    <select onchange="this.value=this.options[this.selectedIndex].value;">
                                        <option value="none">=== 선택 ===</option>
                                        <?php
                                            foreach($manager as $key2=>$bean2){
                                                ?>
                                                <option value="<?=$bean2['사원번호']?>"><?=$bean2['이름']?></option>
                                                <?php
                                            }
                                            ?>
                                    </select>
                                </td>
                                
                                <td colspan='2'><textarea rows='3' col='30' style='width:100%' placeholder='[할일]'></textarea></td>
                            </tr>`
                break;

            default:
                var html = "";
                break;
        }

        $('#' + b).append(html);
    }


    function remove_colum(b){
        var table = document.getElementById(b);

        if(table.rows.length <= 1)
            return;
        
        else
            table.deleteRow(-1);
    }

    // 셀렉트박스 관련 함수 나중에 ajax 이용해서 데이터 받아올 예정
    function change_child(element) {


        var child = element.parentNode.nextSibling.nextSibling

        child.firstChild.remove();
        child.innerHTML = "<select style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'></select>"

        let jihun = ["회의록 양식 개발하기","회의록 양식 개발하기2","회의록 양식 개발하기3","회의록 양식 개발하기4","회의록 양식 개발하기5"];
        let yujin = ["메인보드 개발하기","메인보드개발하기2","메인보드개발하기3","메인보드개발하기4","메인보드 개발하기5"];
        let kyungmin = ["회의록 리스트 개발하기", "회의록 리스트 개발하기2", "회의록 리스트 개발하기3", "회의록 리스트 개발하기4", "회의록 리스트 개발하기5"]
        
        selectVal_parents = element.value;
        
        var selectItem;
        
        if(selectVal_parents == "null"){
            return;
        }else if(selectVal_parents == "111"){
            selectItem = jihun;
        }else if(selectVal_parents == "222"){
            selectItem = yujin;
        }else if(selectVal_parents == "333"){
            selectItem = kyungmin;
        }
        
        for(var i = 0; i < selectItem.length; i++){
            $(child.firstChild).append("<option value='"+selectItem[i]+"'>"+selectItem[i]+"</option>");
        }
        
        
    }



</script>

</html>