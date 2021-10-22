<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>Jquery Comments Plugin</title>

 
	<!-- jquery-contextmenu -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.css" integrity="sha512-EF5k2tHv4ShZB7zESroCVlbLaZq2n8t1i8mr32tgX0cyoHc3GfxuP7IoT8w/pD+vyoq7ye//qkFEqQao7Ofrag==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.js" integrity="sha512-2ABKLSEpFs5+UK1Ol+CgAVuqwBCHBA0Im0w4oRCflK/n8PUVbSv5IY7WrKIxMynss9EKLVOn1HZ8U/H2ckimWg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.ui.position.js" integrity="sha512-vBR2rismjmjzdH54bB2Gx+xSe/17U0iHpJ1gkyucuqlTeq+Q8zwL8aJDIfhQtnWMVbEKMzF00pmFjc9IPjzR7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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
								<h3 class="m-subheader__title ">Sprint Meeting 회의록</h3>
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

                    <!-- 옆에 따라다니는 메뉴 (책갈피, 작성, 목록으로) -->
                    <ul class="m-nav-sticky" style="margin-top: 30px; background-color:#282733;">

                        <li id="sprint-sticky-li" class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="책갈피">
                            <a onclick="test()" style="cursor:pointer"><i class="la la-bookmark"><button id="sprint-sticky-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="작성하기">
                            <a href="/Sprint_Meet_Controller/spr_create"><i class="la la-plus-circle"></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="목록으로">
                            <a href="/home/sprint_list"><i class="la la-list"></i></a>
                        </li>
                    </ul>

                <!-- 폼 시작 -->
                <form name="sprint_form" action="/Sprint_Meet_Controller/spr_edit_save" method="post" onsubmit="submit_function()">

                    <input type="hidden" name="SPR_MEET_ID" value="<?=$myarr['SPR_MEET_ID']?>"></input>
                    <input id="submit" type="submit";></input>
					<div class="m-content">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                    <div class="m-portlet__body" style="padding:0px !important;">
                                        <table class="table table-bordered" id="sprint-table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">부분(본부)/팀</th>

													<!-- 팀 정보 받아와야함 -->
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
									<!-- 윗 부분 Objective -->
                                    <div class="col-xl-6">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Objective</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="display:table; text-align:center; width:100%">
                                                <h1 style="display:table-cell; vertical-align:middle;">"<?=$myarr['OBJECTIVE']?>"</h1>
                                            </div>

                                        </div>
                                    </div>

									<!-- 윗 부분 Key result  -->
                                    <div class="col-xl-6">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">

                                            <div class="m-portlet__head" style="background-color:#cbcefb; display:table; width:100%">
                                                <div class="m-portlet__head-title" style="display:table-cell; vertical-align:middle; text-align:center">
                                                    <h3 class="m-portlet__head-text">Key Results</h3>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="padding:0px !important;">
                                                <table class="table table-bordered" id="sprint-table" style="height:100% ; margin:0px">
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

                                                    <tbody>

                                                        <!--달력부분 날짜변경시 그 날짜의 회의록 불러옴 없으면 작성 여부 묻기-->
                                                        <tr style="background-color:#fffc9e">
                                                            <td colspan="4" style="text-align:center">
                                                                <input type="date" id="date" class="form-control" style="display:inline-block; width:150px; text-align:center;" placeholder="date input" value="<?=$myarr['MEET_DT']?>">
                                                            </td>
                                                        </tr>

														<!-- 피드백부분 -->
                                                        <tr style="background-color:#dae8fc">
                                                            <th scope="col" class="disable" id="table-head">KR</th>
                                                            <th scope="col" class="disable" id="table-head">담당자</th>
                                                            <th scope="col" class="disable" style="width:40%">지난주 한 일</th>
                                                            <th scope="col" style="width:100%">피드백</th>
                                                        </tr>

                                                        <?php
                                                            $i=0;
                                                            $index = 1;

                                                            foreach($myarr['FEED'] as $key=>$bean){

                                                                if(sizeof($myarr['FEED'][$key]) == 0){

                                                                     $i++;

                                                                    if($i == sizeof($myarr['FEED'])){
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
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
                                                                                $(document).ready(function(){
                                                                                    add_feedback_column('feedback-kr-<?=$index?>', '<?=$bean2["ID"]?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2["CONTENT"]?>',  '<?=$bean2["HIGHLIGHT"]?>', '<?=$bean2["LOWLIGHT"]?>');
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
														
                                                        <?php
                                                            $index = 1;
                                                            foreach($myarr['IDEA'] as $key=>$bean){
                                                                // if(sizeof($myarr['IDEA'][$key]) == 0)
                                                                //     continue;
                                                                ?>
                                                                
                                                                <tbody id="idea-kr-<?=$index?>">
                                                                    <tr>
                                                                        <th class="KR" id="idea-kr-<?=$index?>-head" rowspan="6">
                                                                            Key Result <?=$index?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
																			$(document).ready(function(){
																				add_idea_column('idea-kr-<?=$index?>', '<?=$bean2["ID"]?>', '<?=$bean2["OKR_KEYS_ID"]?>','<?=$bean2["EMPY_NO"]?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2['TODO_ID']?>','<?=$bean2["TO_DO_CONTENT"]?>',  '<?=$bean2["IDEA_CONTENT"]?>');
																			});
																			</script>

																			<?php
																		}
																		?>
                                                                																															
                                                                </tbody>

                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_new_idea_column('idea-kr-<?=$index?>', '<?=$key?>')">+</button>
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

                                                        <?php
                                                            $index = 1;                                                                
                                                            foreach($myarr['PLAN'] as $key=>$bean){
                                                                    // if(sizeof($myarr['PLAN'][$key]) == 0)
                                                                    //     continue;
                                                                ?>
                                                                
                                                                <tbody id="plan-kr-<?=$index?>">
                                                                    <tr>
                                                                        <th class="KR" id="plan-kr-<?=$index?>-head" rowspan="6">
                                                                            Key Result <?=$index?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
																			$(document).ready(function(){
																				add_plan_column('plan-kr-<?=$index?>', '<?=$bean2["ID"]?>','<?=$bean2["EMPY_NO"]?>','<?=$bean2["EMP_NM"]?>', '<?=$bean2["CONTENT"]?>');
																			});
																			</script>

																			<?php
																		}
																		?>
                                                                																															
                                                                </tbody>

                                                                <tr>
                                                                    <td colspan="4" style="text-align:center; ">
                                                                        <button type="button" class="btn btn-success" id="btn1" onclick="add_new_plan_column('plan-kr-<?=$index?>', <?=$key?>)">+</button>
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

    function test(){
        document.getElementById('sprint-sticky-button').click();
    }

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
                        document.getElementById('date').value = "<?=$myarr['MEET_DT']?>";
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
                        document.getElementById('date').value = "<?=$myarr['MEET_DT']?>";
                        $("#date").change(mytest123);
                    }
                }
            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });

    });



    function add_feedback_column(b, id, manager, task, high, low){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html =
                "<tr class='separator' value='old'><td rowspan='2' style='text-align:center'>" + manager + "</td><td rowspan='2'>" + task +
                "<input type='hidden' name='feed-id[]' value='"+ id +"'></input>"+
                "</td><td><textarea name='feed-high[]' rows='3' col='30' style='width:100%;' placeholder='high)'>" + high + "</textarea></td></tr>" +  
                "<tr><td><textarea name='feed-low[]' rows='3' col='30' style='width:100%' placeholder='low)'>" + low + "</textarea></td></tr>";



		$('#' + b).append(html);
	}


    //todolist 셀렉트박스에 append를 하기위해 있는 인덱스...
    var idea_i=0;

    //사원 리스트
    var arr = [];
    <?php
        foreach($myarr['EMP_LIST'] as $key => $bean){

            ?>
                arr[<?=$key?>] = {"EMP_NO" : '<?=$bean['EMP_NO']?>', "EMP_NM" : '<?=$bean['EMP_NM']?>'}
            <?php
        }
    ?>

	function add_idea_column(b, id, kr_id, manager_no, manager, todo_id, strategy, idea){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

        // console.log(arr);

		var html = `<tr class='separator' value="old" oncontextmenu="remove_idea_column(event, this)">
                        <td>
                            <input type='hidden' name='idea-delete[]' value='N'></input>
                            <input type='hidden' name='idea-id[]' value='`+id+`'></input>
                            <input type='hidden' name='idea-kr[]' value='`+kr_id+`'></input>
                            <select id="`+b+'-head'+`" name="idea-name[]" onchange="this.value=this.options[this.selectedIndex].value; change_child(this)">
                                <option value="">선택</option>`;

        for(let i=0; i<arr.length; i++){
            if(arr[i]['EMP_NO'] == manager_no){
                html = html.concat(`<option selected value=`+arr[i]['EMP_NO']+`>`+arr[i]['EMP_NM']+`</option>`)
            }

            else
                html = html.concat(`<option value=`+arr[i]['EMP_NO']+`>`+arr[i]['EMP_NM']+`</option>`);
        }




        var html2 =
                            `
                            </select>
                            
                        </td>

                        <td id='div_chk' value="123">
                            <select id="idea-todo-` + idea_i+ `" name="idea-todo[]" style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'>
                                <option value="">=== 선택 ===</option>
                            </select>
                        </td>

                        <td><textarea name='idea-content[]' rows='3' col='30' style='width:100%' placeholder='[아이디어]'>`+idea+`</textarea></td>
                    </tr>`;

        html = html.concat(html2);

		var child = $('#' + b).append(html);

        // console.log(child);

        $.ajax({
            type : 'POST',
            url : '/Sprint_Meet_Controller/get_to_do_list',
            cache : false,
            data : {"KR_ID": kr_id, "EMP_NO": manager_no},
            async: false,
            success : function( data ){
                
                const result = jQuery.parseJSON(data);
                var temp = '';

                for (let i = 0; i < result['TODO'].length; i++) {

                    if(temp != result['TODO'][i]['INIT_CONTENT']){
                        temp = result['TODO'][i]['INIT_CONTENT'];
                        $("#idea-todo-" + idea_i).append("<optgroup label='"+temp+"'>");
                    }

                    if(result['TODO'][i]['ID'] == todo_id)
                        $("#idea-todo-" + idea_i).append("<option selected value='"+result['TODO'][i]['ID']+"'>"+result['TODO'][i]['CONTENT']+"</option>");
                    else
                    $("#idea-todo-" + idea_i).append("<option value='"+result['TODO'][i]['ID']+"'>"+result['TODO'][i]['CONTENT']+"</option>");
                }
                idea_i++;
            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });

	}

	function add_plan_column(b, id, manager_no, manager, task){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = `<tr class='separator' value="old" oncontextmenu="remove_plan_column(event, this)">
                        <td>
                            <input type='hidden' name='plan-delete[]' value='N'></input>
                            <input type="hidden" name='plan-id[]' value='`+id+`'></input>
                            <select name='plan-name[]' onchange="this.value=this.options[this.selectedIndex].value;">
                                <option value="">=== 선택 ===</option>`;

        for(let i=0; i<arr.length; i++){
            if(arr[i]['EMP_NO'] == manager_no){
                html = html.concat(`<option selected value=`+arr[i]['EMP_NO']+`>`+arr[i]['EMP_NM']+`</option>`)
            }

            else
                html = html.concat(`<option value=`+arr[i]['EMP_NO']+`>`+arr[i]['EMP_NM']+`</option>`);
        }

        var html2 = `
                            </select>
                        </td>
                                
                        <td colspan='2'><textarea name='plan-content[]' rows='3' col='30' style='width:100%' placeholder='[할일]'>`+task+`</textarea></td>
                    </tr>`;

        html = html.concat(html2)

		$('#' + b).append(html);
	}

    function add_new_idea_column(b, c){

        var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

        console.log(c);

        var html = `<tr class='separator' value="new">
                        <td>
                            <input type='hidden' name='idea-new-kr[]' value='`+c+`'></input>
                            <select id="`+b+'-head'+`" name="idea-new-name[]"onchange="this.value=this.options[this.selectedIndex].value; change_child(this)">
                                <option value="">선택</option>
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
                            <select name="idea-new-todo[]" style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'>
                                <option value="">=== 선택 ===</option>
                            </select>
                        </td>

                        <td><textarea name='idea-new-content[]' rows='3' col='30' style='width:100%' placeholder='[아이디어]'></textarea></td></td>
                    </tr>`;

        $('#' + b).append(html);
    }

    function add_new_plan_column(b, c){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = `<tr class='separator' value="new">
                        <input type='hidden' name='plan-new-kr[]' value='`+c+`'></input>
                        <td>
                            <select name='plan-new-name[]' onchange="this.value=this.options[this.selectedIndex].value;">
                                <option value="">=== 선택 ===</option>
                                <?php
                                    foreach($myarr['EMP_LIST'] as $key => $bean){
                                        ?>
                                        <option value="<?=$bean['EMP_NO']?>"><?=$bean['EMP_NM']?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                                
                        <td colspan='2'><textarea name='plan-new-content[]' rows='3' col='30' style='width:100%' placeholder='[할일]'></textarea></td>
                    </tr>`;

		$('#' + b).append(html);
	}


    function remove_column(b){
        var table = document.getElementById(b);
        // console.log($(table.lastChild).attr("value"));

        if($(table.lastChild).attr("value")=="new")
            table.deleteRow(-1);
        
        else if($(table.lastChild).attr("value")=="old")
            alert("기존 컬럼입니다.");
    }


    // 셀렉트박스 관련 함수 
    function change_child(element) {

        var kr_id = element.previousSibling.previousSibling.value;
        // console.log(kr_id);

        var child = element.parentNode.nextSibling.nextSibling

        child.firstChild.remove();
        child.innerHTML =  "<select name='idea-new-todo[]' style='width: 100%;' onchange='this.value=this.options[this.selectedIndex].value;'>" +
                            "<option value=''>=== 선택 ===</option>"+
                            "</select>";

        $.ajax({
            type : 'POST',
            url : '/Sprint_Meet_Controller/get_to_do_list',
            cache : false,
            data : {"KR_ID": kr_id, "EMP_NO": element.value},
            async: false,
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

    //기존 아이디어 컬럼삭제
    function remove_idea_column(event, element){
        event.preventDefault();
        var temp = $(element).find('[name="idea-delete[]"]').attr('value');

        //삭제취소
        if(temp == 'Y') {
            $(element).find('[name="idea-delete[]"]').attr('value', 'N');

            $(element).find('select').attr("disabled", false);
            $(element).find('textarea').attr("disabled", false);

            $(element).css('background', 'none');
            $(element).css('opacity', '1');
        }
        
        //삭제
        else if(temp == 'N') {
            $(element).find('[name="idea-delete[]"]').attr('value', 'Y');

            $(element).find('select').attr("disabled", true);
            $(element).find('textarea').attr("disabled", true);

            $(element).css('background', 'repeating-linear-gradient(45deg, #444, #444 10px, #888 0, #888 20px)');
            $(element).css('opacity', '0.5');
        }
    }

    //기존 플랜 컬럼 삭제
    function remove_plan_column(event, element){
        event.preventDefault();
        var temp = $(element).find('[name="plan-delete[]"]').attr('value');

        //삭제취소
        if(temp == 'Y') {
            $(element).find('[name="plan-delete[]"]').attr('value', 'N');

            $(element).find('select').attr("disabled", false);
            $(element).find('textarea').attr("disabled", false);

            $(element).css('background', 'none');
            $(element).css('opacity', '1');
        }
        
        //삭제
        else if(temp == 'N') {
            $(element).find('[name="plan-delete[]"]').attr('value', 'Y');

            $(element).find('select').attr("disabled", true);
            $(element).find('textarea').attr("disabled", true);

            $(element).css('background', 'repeating-linear-gradient(45deg, #444, #444 10px, #888 0, #888 20px)');
            $(element).css('opacity', '0.5');
        }
    }

    //disable 된것들 풀어주는 함수(post 안되니깐)
    function submit_function(){
        $(document).find('select').attr("disabled", false);
        $(document).find('textarea').attr("disabled", false);
    }

     //Sprint Meeting 메뉴 활성화
    elements = document.getElementsByClassName('m-menu__item--active');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.remove('m-menu__item--active');
        }

    document.getElementById('sprint_left_menu').classList.add('m-menu__item--active');

 


</script>

</html>