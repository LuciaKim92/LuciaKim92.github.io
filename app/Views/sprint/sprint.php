<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>Jquery Comments Plugin</title>

    <!-- 제이쿼리 -->
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/css/App.css" />
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
                                <?php
                                    foreach($myarr['BOOKMARK'] as $key => $bean){
                                        ?>
                                        <h5>
                                            <a href="/Sprint_Meet_Controller/spr_main_id/<?=$bean['ID']?>"> <?=$bean['MEET_DT']?> (클릭시 이동) </a>
                                        </h5>
                                        <hr>

                                        <?php
                                    }
                                ?>
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
                            <a href="javascript:confirm_save();"><i class="la la-save"></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="목록으로">
                            <a href="/home/sprint_list" ><i class="la la-list"></i></a>
                        </li>
                    </ul>


                <form id="frm" name="sprint_form" action="/Sprint_Meet_Controller/spr_save" method="post">    
					<div class="m-content">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                    <div class="m-portlet__body" style="padding:0px !important">
                                        <table class="table table-bordered" id="sprint-table">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="DWGP_CD" value="<?=$myarr['DWGP_CD']?>"></input>
                                                    <input type="hidden" name="DEPT_CD" value="<?=$myarr['DEPT_CD']?>"></input>
                                                    <th style="width:50%">부분(본부)/팀</th>
                                                    <th><?=$myarr['DEPT_UP_NM']?>/<?=$myarr['DEPT_NM']?></th>
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
                                    <div class="col-xl-6">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Objective</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="display:table; text-align:center; width:100%">
                                                <input type="hidden" name="OKR_OBJT_ID" value="<?=$myarr['ID']?>"></input>
                                                <h1 style="display:table-cell; vertical-align:middle;">"<?=$myarr['OBJECTIVE']?>"</h1>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">

                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Key Results</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="padding:0px !important">
                                                <table class="table table-bordered" id="sprint-table" style="height:100%">
                                                    <tbody>
                                                        <?php
                                                            foreach($myarr['KR'] as $key=>$bean){
                                                                ?>
                                                                <tr>
                                                                    <th scope="row" style="width:10%"><?=$key+1?></th>
                                                                    <td><?=$bean['CONTENT']?></td>
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
                                                            <td colspan="4" style="text-align:center"><input type="date" name="MEET_DT" id="date" class="form-control" style="display:inline-block; width:150px; text-align:center;" placeholder="date input" value="<?=$MEET_DT?>"></td>
                                                        </tr>

                                                        <tr style="background-color:#dae8fc">
                                                            <th scope="col" class="disable" id="table-head">KR</th>
                                                            <th scope="col" class="disable" id="table-head">담당자</th>
                                                            <th scope="col" class="disable" style="width:40%">지난주 계획</th>
                                                            <th scope="col" style="width:100%">결과 및 피드백</th>
                                                        </tr>
                                                        
                                                        <!-- 추가해야됨 -->
                                                        <?php
                                                            $i = 0;
                                                            $index = 1;
                                                            foreach($myarr['KR'] as $key=>$bean){
                                                                    if($myarr['KR'][$key]['LAST_PLAN'] == null){
                                                                        
                                                                        $i++;

                                                                        if($i == sizeof($myarr['KR'])){
                                                                            ?>
                                                                            <tr>
                                                                                <th colspan="4">데이터가 없습니다.</th>
                                                                            </tr>    
                                                                            <?php                                                                        
                                                                        }
                                                                            
                                                                        continue;
                                                                    }
                                                                ?>
                                                                <tbody id="feedback-kr-<?=$index?>">
                                                                    <tr>
                                                                        <th class="KR" id="feedback-kr-<?=$index?>-head" rowspan="6">
                                                                            Key Result <?=$index?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean['LAST_PLAN'] as $key2 => $bean2){                    
																			?>
																			<script>
                                                                                $(document).ready(function(){
                                                                                    add_feedback_column('feedback-kr-<?=$index?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2["CONTENT"]?>', <?=$bean2['PLAN_ID']?>);
                                                                                });
																			</script>

																			<?php
																		}
																	?>

                                                                </tbody>

                                                                <?php
                                                                $index++;
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

                                                        <!-- 추가해야됨 -->
                                                        <?php
                                                            $index = 1;
                                                            foreach($myarr['KR'] as $key=>$bean){
                                                                ?>
                                                                
                                                                <tbody id="idea-kr-<?=$index?>">
                                                                    <tr>
                                                                        <th class="KR" id="idea-kr-<?=$index?>-head" rowspan="6" value=<?=$bean['ID']?>>
                                                                            Key Result <?=$index?>
                                                                        </th>   
                                                                    </tr>

                                                                    <script>
                                                                    $(document).ready(function(){
                                                                        add_idea_column('idea-kr-<?=$index?>', <?=$bean['ID']?>);
                                                                    });
                                                                    </script>
                                                                																															
                                                                </tbody>

                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_idea_column('idea-kr-<?=$index?>', <?=$bean['ID']?>)">+</button>
                                                                        <button type="button" class="btn btn-danger" id="btn1" onclick="remove_column('idea-kr-<?=$index?>')">-</button>
                                                                    </td>
                                                                 </tr>

                                                                <?php
                                                                $index++;
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
                                                        
                                                        <!-- 추가해야됨 -->
                                                        <?php
                                                            $index = 1;
                                                            foreach($myarr['KR'] as $key=>$bean){
                                                                ?>
                                                                
                                                                <tbody id="plan-kr-<?=$index?>">
                                                                    <tr>
                                                                        <th class="KR" id="plan-kr-<?=$index?>-head" rowspan="6">
                                                                            Key Result <?=$index?>
                                                                        </th>   
                                                                    </tr>

                                                                    <script>
                                                                    $(document).ready(function(){
                                                                        add_plan_column('plan-kr-<?=$index?>', <?=$bean['ID']?>);
                                                                    });
                                                                    </script>
                                                                																															
                                                                </tbody>

                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_plan_column('plan-kr-<?=$index?>', <?=$bean['ID']?>)">+</button>
                                                                        <button type="button" class="btn btn-danger" id="btn1" onclick="remove_column('plan-kr-<?=$index?>')">-</button>
                                                                    </td>
                                                                 </tr>

                                                                <?php
                                                                $index++;
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
                </form> 
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

    window.onpageshow = function(event) {
        if ( event.persisted || (window.performance && window.performance.navigation.type == 2)) {
            // Back Forward Cache로 브라우저가 로딩될 경우 혹은 브라우저 뒤로가기 했을 경우
            alert("잘못된 접근입니다!");
            history.back();
        }
    }

    function test(){
        document.getElementById('sprint-sticky-button').click();
    }

    //날짜변경관련
    $('#date').change(mytest123=function(){
        
        var temp = document.getElementById('date').value

        $.ajax({
            type : 'POST',
            url : '/Sprint_Meet_Controller/spr_main_date',
            cache : false,
            data : {"DATE": temp},
            success : function( data ){
                console.log( data );

                if(data == '회의록 없음'){

                    if(confirm("회의록이 없습니다! 작성하시겠습니까?")){
                        location.href="/Sprint_Meet_Controller/spr_create/"+temp;
                    }

                    else{
                        // 일시적으로 change 이벤트 삭제 -> 달력 값 원래대로 하려고!
                        $("#date").unbind();
                        document.getElementById('date').value = "<?=$MEET_DT?>";
                        $("#date").change(mytest123);
                    }
                }

                else{
                    if(confirm(temp + "일 회의록을 불러오시겠습니까?")){
                        location.href="/Sprint_Meet_Controller/spr_main_id/"+data;
                    }

                    else{
                        // 일시적으로 change 이벤트 삭제 -> 달력 값 원래대로 하려고!
                        $("#date").unbind();
                        document.getElementById('date').value = "<?=$MEET_DT?>";
                        $("#date").change(mytest123);
                    }
                }
            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });

    });


    function add_feedback_column(b, manager, task, id){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html =  "<tr class='separator'><td rowspan='2' style='text-align:center'>" + manager + "</td><td rowspan='2'>" + task +
                    "<input type='hidden' name='feed-plan[]' value='"+id+"'></input>"+        
                    "</td><td><textarea name='feed-high[]' rows='3' col='30' style='width:100%;' placeholder='high)'></textarea></td></tr>" +  
                    "<tr><td><textarea name='feed-low[]' rows='3' col='30' style='width:100%' placeholder='low)'></textarea></td></tr>";

		$('#' + b).append(html);
	}

	function add_idea_column(b, c){

		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

        console.log(c);

		var html = `<tr class='separator'>
                        <td>
                            <input type='hidden' name='idea-kr[]' value='`+c+`'></input>
                            <select id="`+b+'-head'+`" name="idea-name[]"onchange="this.value=this.options[this.selectedIndex].value; change_child(this)">
                                <option value="none">선택</option>
                                <?php
                                    foreach($myarr['EMP_LIST'] as $key => $bean){
                                        ?>
                                        <option value="<?=$bean['EMP_NO']?>"><?=$bean['EMP_NM']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            
                        </td>

                        <td id='div_chk' value="123">
                            <select name="idea-todo[]" style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'>
                                <option value="none">=== 선택 ===</option>
                            </select>
                        </td>

                        <td><textarea name='idea-content[]' rows='3' col='30' style='width:100%' placeholder='[아이디어]'></textarea></td></td>
                    </tr>`;

		$('#' + b).append(html);
	}

	function add_plan_column(b, c){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = `<tr class='separator'>
                        <input type='hidden' name='plan-kr[]' value='`+c+`'></input>
                        <td>
                            <select name='plan-name[]' onchange="this.value=this.options[this.selectedIndex].value;">
                                <option value="none">=== 선택 ===</option>
                                <?php
                                    foreach($myarr['EMP_LIST'] as $key => $bean){
                                        ?>
                                        <option value="<?=$bean['EMP_NO']?>"><?=$bean['EMP_NM']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                                
                        <td colspan='2'><textarea name='plan-content[]' rows='3' col='30' style='width:100%' placeholder='[할일]'></textarea></td>
                    </tr>`;

		$('#' + b).append(html);
	}



    function remove_column(b){
        var table = document.getElementById(b);

        if(table.rows.length <= 1)
            return;
        
        else
            table.deleteRow(-1);
    }

    // 셀렉트박스 관련 함수 
    function change_child(element) {

        var kr_id = $("#"+element.id).attr("value");
        // console.log(kr_id);

        var child = element.parentNode.nextSibling.nextSibling

        child.firstChild.remove();
        child.innerHTML =  "<select name='idea-todo[]' style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'>" +
                            "<option value='none'>=== 선택 ===</option>"+
                            "</select>";

        $.ajax({
            type : 'POST',
            url : '/Sprint_Meet_Controller/get_to_do_list',
            cache : false,
            data : {"KR_ID": kr_id, "EMP_NO": element.value},
            success : function( data ){
                
                const result = jQuery.parseJSON(data);
                var temp = '';

                for (let i = 0; i < result['TODO'].length; i++) {

                    if(temp != result['TODO'][i]['INIT_CONTENT']){
                        temp = result['TODO'][i]['INIT_CONTENT'];
                        $(child.firstChild).append("<optgroup label='"+temp+"'>");
                    }

                    $(child.firstChild).append("<option value='"+result['TODO'][i]['ID']+"'>"+result['TODO'][i]['CONTENT']+"</option>");
                }

            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });
    }


    //수정 회의록 저장확인
    function confirm_save(){
        if(confirm("회의록 작성을 완료 하시겠습니까?")){
            document.getElementById('frm').submit();
        }

        else
            return;
    }

     //Sprint Meeting 메뉴 활성화
     elements = document.getElementsByClassName('m-menu__item--active');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.remove('m-menu__item--active');
        }

        document.getElementById('sprint_left_menu').classList.add('m-menu__item--active');



</script>



</html>