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

                    <!-- 옆에 따라다니는 메뉴 (책갈피, 작성/수정하기, 목록으로) -->
                    <ul class="m-nav-sticky" style="margin-top: 30px; background-color:#282733;">

                        <li id="sprint-sticky-li" class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="책갈피">
                            <a onclick="test()" style="cursor:pointer"><i class="la la-bookmark"><button id="sprint-sticky-button" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="작성하기">
                            <a href="/Sprint_Meet_Controller/spr_create"><i class="la la-plus-circle"></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="수정하기">
                            <a href="/home/sprint"><i class="la la-pencil-square"></i></a>
                        </li>

                        <li class="m-nav-sticky__item" data-toggle="m-tooltip" title="" data-placement="left" data-original-title="목록으로">
                            <a href="/home/sprint_list"><i class="la la-list"></i></a>
                        </li>
                    </ul>

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
                                                                
                                                                <tbody id="feedback-kr-<?=$key+1?>">
                                                                    <tr>
                                                                        <th class="KR" id="feedback-kr-<?=$key+1?>-head" rowspan="6">
                                                                            Key Result <?=$key+1?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
                                                                                $(document).ready(function(){
                                                                                    add_feedback_column('feedback-kr-<?=$key+1?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2["CONTENT"]?>',  '<?=$bean2["HIGHLIGHT"]?>', '<?=$bean2["LOWLIGHT"]?>');
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
                                                            foreach($myarr['IDEA'] as $key=>$bean){
                                                                if(sizeof($myarr['IDEA'][$key]) == 0)
                                                                    continue;
                                                                ?>
                                                                
                                                                <tbody id="idea-kr-<?=$key+1?>">
                                                                    <tr>
                                                                        <th class="KR" id="idea-kr-<?=$key+1?>-head" rowspan="6">
                                                                            Key Result <?=$key+1?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
																			$(document).ready(function(){
																				add_idea_column('idea-kr-<?=$key+1?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2["TO_DO_CONTENT"]?>',  '<?=$bean2["IDEA_CONTENT"]?>');
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


                                                    <!-- 다음주할일부분 -->
                                                    <tbody>
                                                        <tr style="background-color:#b0dcb0">
                                                            <th class="disable">KR</th>
                                                            <th class="disable">담당자</th>
                                                            <th colspan="2">다음주 할 일</th>
                                                        </tr>

                                                        <?php
                                                            foreach($myarr['PLAN'] as $key=>$bean){
                                                                    if(sizeof($myarr['PLAN'][$key]) == 0)
                                                                        continue;
                                                                ?>
                                                                
                                                                <tbody id="plan-kr-<?=$key+1?>">
                                                                    <tr>
                                                                        <th class="KR" id="plan-kr-<?=$key+1?>-head" rowspan="6">
                                                                            Key Result <?=$key+1?>
                                                                        </th>   
                                                                    </tr>

																	<?php
																		foreach($bean as $key2 => $bean2){
																			?>
																			<script>
																			$(document).ready(function(){
																				add_plan_column('plan-kr-<?=$key+1?>', '<?=$bean2["EMP_NM"]?>', '<?=$bean2["CONTENT"]?>');
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



    function add_feedback_column(b, manager, task, high, low){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = "<tr class='separator'><td rowspan='2' style='text-align:center'>" + manager + "</td><td rowspan='2'>" + task +
                "</td><td>" + high + "</td></tr>" +  
                "<tr><td>" + low + "</td></tr>";



		$('#' + b).append(html);
	}

	function add_idea_column(b, manager, strategy, idea){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = "<tr class='separator'>" +
						"<td style='text-align:center'>" + manager + "</td>" +

						"<td>" + strategy + "</td>" +

						"<td>" + idea + "</td>" +
					"</tr>";

		$('#' + b).append(html);
	}

	function add_plan_column(b, manager, task){
		var a = $('#' + b + '-head').attr('rowspan');
        $('#' + b + '-head').attr('rowspan', a+2);

		var html = "<tr class='separator'>" +
						"<td style='text-align:center'>" + manager + "</td>" +
                                
						"<td colspan='2'>" + task + "</td>" +
					"</tr>";

		$('#' + b).append(html);
	}

     //Sprint Meeting 메뉴 활성화
     elements = document.getElementsByClassName('m-menu__item--active');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.remove('m-menu__item--active');
        }

        document.getElementById('sprint_left_menu').classList.add('m-menu__item--active');


</script>

</html>