<!doctype html>
<html>
<head>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>Jquery Comments Plugin</title>
	<link rel="stylesheet" type="text/css" href="/App.css" />
	<link rel="stylesheet"
  		  href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
  		  integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
  		  crossorigin="anonymous" />
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
                            <a href="https://keenthemes.com/forums/forum/support/metronic5/" target="_blank"><i class="la la-list"></i></a>
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
                                            <div class="m-portlet__head" style="background-color:#cbcefb">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">Objective</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body">
                                                <h1 style="text-align:center">Objective Contents</h1>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-xl-8">
                                        <div class="m-portlet m-portlet--full-height  m-portlet--unair">
                                            <div class="m-portlet__head" style="background-color:#cbcefb">
                                                <div class="m-portlet__head-caption">
                                                    <div class="m-portlet__head-title">
                                                        <h3 class="m-portlet__head-text">Key Results</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="m-portlet__body" style="padding:0px">
                                                <table class="table table-bordered" id="sprint-table" style="height:100%">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width:10%">1</th>
                                                            <td>Mark</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">2</th>
                                                            <td>Jacob</td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">3</th>
                                                            <td>kim</td>
                                                        </tr>
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
                                                        <tr style="background-color:#fffc9e">
                                                            <td colspan="4" style="text-align:center"><input type="date" class="form-control" style="display:inline-block; width:150px; text-align:center;" placeholder="date input" value="2019-09-09"></td>
                                                        </tr>
                                                        <tr style="background-color:#dae8fc">
                                                            <th scope="col" class="disable" id="table-head">KR</th>
                                                            <th scope="col" class="disable" id="table-head">담당자</th>
                                                            <th scope="col" class="disable" style="width:40%">지난주 한 일</th>
                                                            <th scope="col" style="width:40%">피드백</th>
                                                        </tr>
                                                        
                                                        <tbody id="feedback-kr-1">
                                                            <tr>
                                                                <th class="KR" id="feedback-kr-1-head" rowspan="6">
                                                                    Key Result 1
                                                                </th>   
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>

                                                            <tr class="separator">
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>

                                                            <tr class="separator">
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>

                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center;">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('feedback-kr-1')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum2('feedback-kr-1')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="feedback-kr-2">
                                                            <tr>
                                                                <th class="KR" id="feedback-kr-2-head" rowspan="6">
                                                                    Key Result 2
                                                                </th>
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                            <tr class='separator'> 
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('feedback-kr-2')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum2('feedback-kr-2')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="feedback-kr-3">
                                                            <tr>
                                                                <th class="KR" id="feedback-kr-3-head" rowspan="6">
                                                                    Key Result 3
                                                                </th>
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td rowspan="2">고지훈</td>
                                                                <td rowspan="2">[다음주 할 일 연동]</td>
                                                                <td>High)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Low)</td>
                                                            </tr>
                                                        </tbody>
                                                    </tbody>

                                                    <tr>
                                                        <td colspan="4" style="text-align:center; ">
                                                            <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('feedback-kr-3')">+</button>
                                                            <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum2('feedback-kr-3')">-</button>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tbody>
                                                        <tr style="background-color:#ffccc9">
                                                            <th class="disable">KR</th>
                                                            <th class="disable"> 담당자</th>
                                                            <th class="disable">Initiatives(전략)</th>
                                                            <th>아이디어</th>
                                                        </tr>

                                                        <tbody id="idea-kr-1">
                                                            <tr>
                                                                <th class="KR" rowspan="2" id="idea-kr-1-head">
                                                                    Key Result 1 
                                                                </th>
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                            <tr class='separator'> 
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('idea-kr-1')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('idea-kr-1')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="idea-kr-2">
                                                            <tr>
                                                                <th class="KR" rowspan="2" id="idea-kr-2-head">
                                                                    Key Result 2
                                                                </th>
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                            <tr class='separator'> 
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('idea-kr-2')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('idea-kr-2')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="idea-kr-3">
                                                            <tr>
                                                                <th class="KR" rowspan="2" id="idea-kr-3-head">
                                                                    Key Result 3
                                                                </th>
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>고지훈</td>
                                                                <td>initiative 및 to do list</td>
                                                                <td>[아이디어]</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('idea-kr-3')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('idea-kr-3')">-</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                    <tbody>
                                                        <tr style="background-color:#b0dcb0">
                                                            <th class="disable">KR</th>
                                                            <th class="disable">담당자</th>
                                                            <th colspan="2">다음주 할 일</th>
                                                        </tr>

                                                        <tbody id="plan-kr-1">
                                                            <tr>
                                                                <th class="KR" rowspan="3" id="plan-kr-1-head">
                                                                    Key Result 1
                                                                </th>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('plan-kr-1')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('plan-kr-1')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="plan-kr-2">
                                                            <tr>
                                                                <th class="KR" rowspan="3" id="plan-kr-2-head">
                                                                    Key Result 2
                                                                </th>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('plan-kr-2')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('plan-kr-2')">-</button>
                                                            </td>
                                                        </tr>

                                                        <tbody id="plan-kr-3">
                                                            <tr>
                                                                <th class="KR" rowspan="3" id="plan-kr-3-head">
                                                                    Key Result 3
                                                                </th>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                            <tr class='separator'>
                                                                <td>담당자 이름</td>
                                                                <td colspan="2">할 일</td>
                                                            </tr>
                                                        </tbody>

                                                        <tr>
                                                            <td colspan="4" style="text-align:center; ">
                                                                <button type="button" class="btn btn-success" id="btn1" onclick="add_colum('plan-kr-3')">+</button>
                                                                <button type="button" class="btn btn-danger" id="btn1" onclick="remove_colum('plan-kr-3')">-</button>
                                                            </td>
                                                        </tr>
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



	<script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
	<script src="https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
	<script src="/App.js" charset="utf-8"></script>

    
</body>

    <!-- 스프린트.js-->
    <script>
        function test(){
            document.getElementById('sprint-sticky-button').click();
        }

        function add_colum(b){
            var a = $('#' + b + '-head').attr('rowspan');
            $('#' + b + '-head').attr('rowspan', a+2);

            switch(b.split('-')[0])
            {
                case 'feedback':
                    var html = "<tr class='separator'><td rowspan='2'>고지훈</td><td rowspan='2'>[다음주 할 일 연동]</td><td>High)</td></tr><tr><td>Low)</td></tr>";
                    break;

                case 'idea':
                    var html = "<tr class='separator'><td>고지훈</td><td>initiative 및 to do list</td><td>[아이디어]</td></tr>";
                    break;

                case 'plan':
                    var html =  "<tr class='separator'><td>담당자 이름</td><td colspan='2'>할 일</td></tr>"
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

        function remove_colum2(b){
            var table = document.getElementById(b);

            if(table.rows.length <= 2){
                return;
            }
            
            else{
                table.deleteRow(-1);
                table.deleteRow(-1);
            }
        }

    </script>
</html>