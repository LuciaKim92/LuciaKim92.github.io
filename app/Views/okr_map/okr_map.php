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
                            <h3 class="m-subheader__title ">OKR MAP</h3>
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


                <!-- o 편집창 모달 -->
                <div class="modal fade" id="modal-container-357980" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog modal-dialog-centered" role="document" id="mymodal">
                    </div>
                </div>

                <!-- kr 편집창 모달 -->
                <div class="modal fade" id="modal-container-357981" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <form name="kr_form" id="kr_form">
                        <div class="modal-dialog modal-dialog-centered" role="document" id="mymodal2">
                        </div>
                    </form>
                </div>

                <!-- 시작하는부분 -->
                <div class="m-content">
                
                    <div class="row" style="padding-left:15px;">
                        <select name="year" id="year-select">
                            <script>
                                for(var i=1988; i<=2099; i++){
                                    $("#year-select").append("<option value="+i+">"+i+"년</option>");
                                }

                            </script>
                        </select>

                        &nbsp;&nbsp;

                        <select name="quarter" id="qtr-select">
                            <option value="1">1분기</option>
                            <option value="2">2분기</option>
                            <option value="3">3분기</option>
                            <option value="4">4분기</option>
                        </select>

                        &nbsp;&nbsp;

                        <button type="button" onclick="refresh()">조회</button>
                    </div>

                    <br>

                    <div class="row">

                        <div class="col-md-4" id="parent">
                            <div><a class="card-link" data-toggle="collapse" data-parent="#card-parent" onclick="reset()" href=".card-child"><h4>대원씨티에스</h4></a></div>
                            <div id="card-parent">
                                <div class="card">
                                    <div class="card-header">
                                        <div>Objective</div>
                                        <hr>
                                        <span>
                                            <?php 
                                                if($DWCTS['OBJECTIVE'] != null){
                                                ?>
                                                    <span><?=$DWCTS['OBJECTIVE']?></span>
                                                
                                            <?php
                                                }
                                                else
                                                ?>
                                                    <span>Objective가 등록되지 않았습니다.</span>   

                                        </span>
                                    
                                    </div>

                                    <div class="card-header" style="text-align:center;">
                                        <a class="card-link" data-toggle="collapse" data-parent="#card-parent" href="#card-element-534736">Key Results</a>
                                    </div>
                                    <div id="card-element-534736" class="collapse">
                                        <div class="card-body">
                                            <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
                                                <?php
                                                    if($DWCTS['KR'] == null){
                                                        ?>
                                                        <div style="text-align:center; margin-top:10px;">KR이 등록되지 않았습니다.</div>

                                                        <?php
                                                    }

                                                    else {
                                                        ?>
                                                        <ol style="padding: 10px 0px 0px 20px">
                                                        <?php
                                                        foreach($DWCTS['KR'] as $key => $bean){
                                                            ?>
                                                            <li style='margin:10px 0px 10px 0px'><?=$bean['KR_CONTENT']?></li>

                                                            <?php
                                                        }
                                                        ?>
                                                        </ol>
                                                        <?php
                                                    }
                                                ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" id="child-1">
                            <div class="collapse show card-child">
                                <div id="card-child-1" class="card-body" style="padding:0px;">

                                    <script>
                                        window.onload = function(){
                                            <?php
                                                foreach($team_arr as $key => $bean){
                                                    ?>
                                                    add_column('#card-child-1' , '<?=$bean["DEPT_CD"]?>', '<?=$bean["DEPT_NM"]?>', '<?=$bean["OBJECTIVE_ID"]?>','<?=$bean["OBJECTIVE"]?>', '<?=$bean["IS_UP_DEPT"]?>', '<?=$bean["DWGP_CD"]?>');

                                                    <?php
                                                }
                                            ?>
                                        }
                                    </script>                      
                                    
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4" id="child-2">
                            <div class="collapse show card-child">
                                <div id="card-child-2" class="card-body" style="padding:0px;">

                                    
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3" id="child-3" style="display:none;">
                            <div class="collapse show card-child" style="width:100%">
                                <div id="card-child-3" class="card-body" style="padding:0px;">

                                    
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
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


<!-- okr_map 스크립트 -->
<script>

    $( document ).ready(function() {
        var year = document.getElementById("year-select");
        var qtr = document.getElementById("qtr-select");

        for(var i=0; i<year.length; i++){
            if(year[i].value== '<?=$YEAR?>'){
                year[i].selected = true;
            }
        }

        for(var i=0; i<qtr.length; i++){
            if(qtr[i].value== '<?=$QTR?>'){
                qtr[i].selected = true;
            }
        }
    });

    function refresh(){
        var year = document.getElementById('year-select').value;
        var qtr = document.getElementById('qtr-select').value;
        location.href = "/OKR_MAP_Controller/index/" + year + "/" + qtr;
    }


    function reset(){
        if($(".col-md-3").attr("class") == 'col-md-3'){
            $(".col-md-3").attr("class", "col-md-4");
            $("#child-3").css("display", "none");
        }
        toggle_child3 = false;
    }
    
    var toggle_child2 = false;
    var last_dept_cd2 = '';

    function test1(dept_cd){
        // 모바일 생각해야됨..........
        window.scrollTo(0,0);
        reset();
        ajax_get_team(dept_cd, '#card-child-2');
        $("#card-child-1").hide().prepend($("#"+dept_cd)).fadeIn(500);

        if(toggle_child2 == false){
            $("#card-child-2").css("display", "inherit");
            last_dept_cd2 = dept_cd;
            toggle_child2 = true;
            // console.log("1");
        }

        else if(last_dept_cd2 != dept_cd && toggle_child2 == true){
            $("#card-child-2").css("display", "inherit");
            last_dept_cd2 = dept_cd;
            // console.log("2");
        }
        else if(last_dept_cd2 == dept_cd && toggle_child2 == true){
            $("#card-child-2").css("display", "none");
            last_dept_cd2 = '';
            toggle_child2 = false;
            // console.log("3");
        }
                
    }

    var toggle_child3 = false;
    var last_dept_cd3 = '';

    function test2(dept_cd){

        ajax_get_team(dept_cd, '#card-child-3');
        $("#card-child-2").hide().prepend($("#"+dept_cd)).fadeIn(500);

        if(toggle_child3 == false){
            $(".col-md-4").attr("class", "col-md-3");
            $("#child-3").css("display", "inherit");
            $("#card-child-3").css("display", "inherit");
            last_dept_cd3 = dept_cd;
            toggle_child3 = true;
            // console.log("1");
        }

        else if(last_dept_cd3 != dept_cd && toggle_child3 == true){
            $("#card-child-3").css("display", "inherit");
            last_dept_cd3 = dept_cd;
            // console.log("2");
        }
        else if(last_dept_cd3 == dept_cd && toggle_child3 == true){
            $(".col-md-3").attr("class", "col-md-4");
            $("#child-3").css("display", "none");
            $("#card-child-3").css("display", "none");
            last_dept_cd3 = '';
            toggle_child3 = false;
            // console.log("3");
        }
    }

    function ajax_get_team(dept_cd, card_id){

        $.ajax({
            type : 'POST',
            url : '/OKR_MAP_Controller/get_team',
            cache : false,
            data : {"DEPT_UP_CD": dept_cd, "YEAR": <?=$YEAR?>, "QTR" : <?=$QTR?>},
            async: false,
            success : function( data ){
            
                const result = jQuery.parseJSON(data);
                $(card_id).empty();
                for(var i=0; i < result.length; i++){
                    add_column(card_id , result[i]['DEPT_CD'], result[i]['DEPT_NM'], result[i]['OBJECTIVE_ID'], result[i]['OBJECTIVE'], result[i]['IS_UP_DEPT'], result[i]['DWGP_CD']);
                }
            },
            error : function( jqxhr , status , error ){
  
            }
        });

    }

    function add_column(card_id ,dept_cd, dept_nm, objective_id, objective, is_up_dept, dwgp_cd){

        var objective_temp;
        var myhref;
        var myfunction;
        var html;

        if(objective == null ||objective == 'null')
            objective_temp = '';
        else
            objective_temp = objective;

        if(card_id == '#card-child-1'){
            myhref = "#card-child-2";
            myfunction = `test1('`+dept_cd+`');`;
        }
        else if(card_id == '#card-child-2') {
            myhref = "#card-child-3";
            myfunction = `test2('`+dept_cd+`');`;
        }
        else if(card_id == '#card-child-3'){
            myhref = "#";
            myfunction = "#";
        }

        // 작업중
        if(is_up_dept == 'Y'){
            html = `
                    <div id="`+dept_cd+`">
                        <div><a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href=`+myhref+` onclick="`+myfunction+`" ><h4> `+dept_nm+` </h4></a></div>

                        <div id="card-`+dept_cd+`">
                            <div class="card">
                                <div class="card-header">

                                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="width:100%">
                                        <span>Objective</span>
                                        <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="float:right; padding:0px">
                                            <i class="la la-ellipsis-h"></i>
                                        </a>
                                        <div class="m-dropdown__wrapper" style="z-index: 101; width:auto; height:auto;">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 29.5px;"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body" style="padding:5px">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav">
                                                            <li class="m-nav__item">
                                                                <a id="modal-357980" onclick="edit_objective_modal('`+objective_id+`','`+objective+`', '` +dept_cd+ `','`+ dwgp_cd +`')" href="#modal-container-357980" role="button" class="btn" data-toggle="modal">편집</a>
                                                            </li>

                                                            <li class="m-nav__item">
                                                                <a href="javascript:confirm_delete_objective(`+ objective_id +`)" class="btn">삭제</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <span>`+objective_temp+`</span>
                                </div>

                                <div class="card-header" style="text-align:center;">
                                    <a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href="#card-`+dept_cd+`-element">Key Results</a>
                                </div>
                                <div id="card-`+ dept_cd +`-element" class="collapse">
                                    <div class="card-body">

                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="width:100%">
                                            <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
                                            <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="float:right; padding:0px">
                                                <i class="la la-ellipsis-h"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper" style="z-index: 101; width:auto; height:auto;">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 29.5px;"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body" style="padding:5px">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__item">
                                                                    <a id="modal-357981" onclick="edit_kr_modal('`+objective_id+`','`+dept_cd+`')" href="#modal-container-357981" role="button" class="btn" data-toggle="modal">편집</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                    `;

        }

        else{
            html = `
                    <div id="`+dept_cd+`">
                        <div><h4> `+dept_nm+` </h4></div>

                        <div id="card-`+dept_cd+`">
                            <div class="card">
                                <div class="card-header">

                                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="width:100%">
                                        <span>Objective</span>
                                        <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="float:right; padding:0px">
                                            <i class="la la-ellipsis-h"></i>
                                        </a>
                                        <div class="m-dropdown__wrapper" style="z-index: 101; width:auto; height:auto;">
                                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 29.5px;"></span>
                                            <div class="m-dropdown__inner">
                                                <div class="m-dropdown__body" style="padding:5px">
                                                    <div class="m-dropdown__content">
                                                        <ul class="m-nav">
                                                            <li class="m-nav__item">
                                                                <a id="modal-357980" onclick="edit_objective_modal('`+objective_id+`','`+objective+`', '` +dept_cd+ `','`+ dwgp_cd +`')" href="#modal-container-357980" role="button" class="btn" data-toggle="modal">편집</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <span>`+objective_temp+`</span>
                                </div>

                                <div class="card-header" style="text-align:center;">
                                    <a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href="#card-`+dept_cd+`-element">Key Results</a>
                                </div>
                                <div id="card-`+ dept_cd +`-element" class="collapse">
                                    <div class="card-body">
                    
                                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="width:100%">
                                            <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
                                            <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="float:right; padding:0px">
                                                <i class="la la-ellipsis-h"></i>
                                            </a>
                                            <div class="m-dropdown__wrapper" style="z-index: 101; width:auto; height:auto;">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 29.5px;"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body" style="padding:5px">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__item">
                                                                    <a id="modal-357981" onclick="edit_kr_modal('`+objective_id+`','`+dept_cd+`')" href="#modal-container-357981" role="button" class="btn" data-toggle="modal">편집</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                    `;
        }

        var html2 = `                                      
                                    </div>
                                </div>
                            </div>
                        </div>

                        </br></br>
                    </div>
                    `;

        $.ajax({
            type : 'POST',
            url : '/OKR_MAP_Controller/get_KR',
            cache : false,
            data : {"OBJECTIVE_ID": objective_id},
            async: false,
            success : function( data ){

                const result = jQuery.parseJSON(data);

                if (result){
                    html = html.concat('<ol style="padding: 10px 0px 0px 20px">')
                    for(var i=0; i < result.length; i++){
                    // console.log(result[i]['ID']);
                    // console.log(result[i]['CONTENT']);
                    // 진척율: `+ result[i]['PROC_RAT'] +`%
                    html = html.concat(`<li class="show_proc" kr_id='`+ result[i]['ID'] +`' kr_proc='`+ result[i]['PROC_RAT'] +`' style='margin:10px 0px 10px 0px' onmouseover="MouseOn(this)" onMouseout="clearTimeout(timer); MouseOut(this)">`+ result[i]['CONTENT'] + `</li>
                                        <div class="progress" style="display:none; position:relative; height:25px">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="`+ result[i]['PROC_RAT'] +`" aria-valuemin="0" aria-valuemax="100" style="width:`+ result[i]['PROC_RAT'] +`%; font-size: 12px;">
                                                진척율: `+ result[i]['PROC_RAT'] +`%
                                            </div>
                                        </div>`);
                    }
                    html = html.concat('</ol>');

                }
                

            },
            error : function( jqxhr , status , error ){

            }
        });

        html = html.concat(html2);
        $(card_id).append(html);

    }

    //Modal Creator
    function edit_objective_modal(objective_id, objective, dept_cd, dwgp_cd){
        
        //왠지모를 오류때문에..
        var temp_objective;
        var temp_objective_id;

        if(objective == 'null')
            temp_objective = '';
        
        else
            temp_objective = objective;

        if(objective_id == 'null')
            temp_objective_id = '';
        
        else
            temp_objective_id = objective_id;
 
        var html = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">
                                Objective 수정
                            </h5> 
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input id="edit_okr_hidden" type="hidden" value="`+temp_objective_id+`"></input>
                            <textarea class="form-control" id="edit_okr" col="50" rows="4" style="width:100%; overflow:hidden; resize: none;" onKeyUp="javascript:fnChkByte(this,'200')">`+temp_objective+`</textarea>
                            <br>
                            <span id="byteInfo">0</span> / 200bytes
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" onclick="objective_edit('`+dept_cd+`', '`+ dwgp_cd +`')">
                                Save changes
                            </button> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                    `;
        $("#mymodal").html(html);
    }

    //Modal Creator
    function edit_kr_modal(objective_id, dept_cd){

        $("#mymodal2").empty();

        var my123 = new Array();

        if(document.querySelector("#card-" + dept_cd + "-element > div > ol") != null)
            my123 = document.querySelectorAll("#card-" + dept_cd + "-element > div > ol > li")


        var html = `
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">
                                KR 수정
                            </h5> 
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <div id="add_here">
                                <input name="objective_id" type="hidden" value="`+ objective_id +`"></input>
                                <input name="dept_cd" type="hidden" value="`+ dept_cd +`"></input>
                    `;

        for(var i=0;i<my123.length;i++){
            html = html.concat(`<div class="input-group" style="margin-top:10px">
                                    <input name="kr-id[]" type='hidden' value='`+ $(my123[i]).attr('kr_id') +`'></input>
                                    <textarea id="kr-content-`+$(my123[i]).attr('kr_id')+`" class="form-control" name="kr-content[]" col="50" rows="4" style="overflow:auto; resize: none;" >`+ $(my123[i]).text()+`</textarea>
                                    <div class="input-group-append">
                                        <input id="kr-delete-`+$(my123[i]).attr('kr_id')+`" name="kr-delete[]" type='hidden' value='N'></input>
                                        
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black"></button>
                                        <div class="dropdown-menu">
                                            <div class="input-group" style="margin-top:10px">
                                                <div class="input-group-prepend" style="margin:5px 0px 5px 5px">
                                                    <span class="input-group-text">진척율</span>
                                                </div>

                                                <input id="kr-proc-`+$(my123[i]).attr('kr_id')+`" class="form-control" name="kr-proc[]" type='text' style="margin:5px 5px 5px 0px" value='`+ $(my123[i]).attr('kr_proc') +`'></input>
                                            </div>
                                            <hr class="dropdown-divider">
                                            <a id="kr-text-`+ $(my123[i]).attr('kr_id') +`" class="dropdown-item" href="javascript:delete_kr(`+ $(my123[i]).attr('kr_id') +`)">삭제</a>
                                        </div>
                                    </div>
                                </div>`);

        }

        var html2 = `
                            </div>
                            <button class="btn btn-primary" type="button" onclick="kr_add_column()" style="margin-top:10px" >+</button>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-primary" onclick="kr_edit()">
                                Save changes
                            </button> 
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                    `;

        html = html.concat(html2);

        $("#mymodal2").html(html);
    }

    // Byte 수 체크 제한
    function fnChkByte(obj, maxByte)
    {
        var str = obj.value;
        var str_len = str.length;


        var rbyte = 0;
        var rlen = 0;
        var one_char = "";
        var str2 = "";


        for(var i=0; i<str_len; i++)
        {
            one_char = str.charAt(i);
            if(escape(one_char).length > 4) {
                rbyte += 2;                                         //한글2Byte
            }else{
                rbyte++;                                            //영문 등 나머지 1Byte
            }
            if(rbyte <= maxByte){
                rlen = i+1;                                          //return할 문자열 갯수
            }
        }
        if(rbyte > maxByte)
        {
            // alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
            alert("최대 " + maxByte + "byte를 초과할 수 없습니다.")
            str2 = str.substr(0,rlen);                                  //문자열 자르기
            obj.value = str2;
            fnChkByte(obj, maxByte);
        }
        else
        {
            document.getElementById('byteInfo').innerText = rbyte;
        }
    }

    function objective_edit(dept_cd, dwgp_cd){
        // console.log($("#edit_okr_hidden").val());
        // console.log($("#edit_okr").val());

        var objective_id = $("#edit_okr_hidden").val();
        var objective = $("#edit_okr").val();

        $.ajax({
            type : 'POST',
            url : '/OKR_MAP_Controller/edit_OKR',
            cache : false,
            data : {"OBJECTIVE_ID": objective_id,
                     "OBJECTIVE": objective, 
                     "DEPT_CD": dept_cd,
                     "DWGP_CD": dwgp_cd,
                     "YEAR": <?=$YEAR?>,
                     "QTR": <?=$QTR?>},
            async: false,
            success : function( data ){
                window.location.reload();
                // console.log(data);

            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });
    }

    function kr_edit(){

        var queryString = $("form[name=kr_form]").serialize();
    
        $.ajax({
            type : 'POST',
            url : '/OKR_MAP_Controller/edit_KR',
            cache : false,
            dataType: 'json',
            data : queryString,
            async: false,
            success : function( data ){
                window.location.reload();
                // console.log(data);
            },
            error : function( jqxhr , status , error ){
                // console.log( jqxhr , status , error );
            }
        });
    }

    function kr_add_column(){
 
        var html = `    <div class="input-group" style="margin-top:10px">
                            <input name="kr-id[]" type='hidden' value=''></input>
                            <textarea class="form-control" name="kr-content[]" col="50" rows="4" style="overflow:auto; resize: none;" ></textarea>
                            <div class="input-group-append">
                                <input name="kr-delete[]" type='hidden' value='N'></input>
                                
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black"></button>
                                <div class="dropdown-menu">
                                    <div class="input-group" style="margin-top:10px">
                                        <div class="input-group-prepend" style="margin:5px 0px 5px 5px">
                                            <span class="input-group-text">진척율</span>
                                        </div>

                                        <input class="form-control" name="kr-proc[]" type='text' style="margin:5px 5px 5px 0px" value='0'></input>
                                    </div>
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item" onclick="delete_new_kr(this)">삭제</a>
                                </div>
                            </div>
                        </div>`

                    
        $("#add_here").append(html);
    }

    function delete_kr(id){

        if($('#kr-delete-'+id).val() == 'N'){
            // console.log("삭제");
            $('#kr-delete-'+id).val('Y')
            $('#kr-text-'+id).text("취소");
            $('#kr-content-' + id).attr("readonly", true);
            $('#kr-content-' + id).css("background-color", "#d3d3d3");
            $('#kr-proc-' + id).attr("readonly", true);
            $('#kr-proc-' + id).css("background-color", "#d3d3d3");
        }
        
        else{
            // console.log("취소");
            $('#kr-delete-'+id).val('N')
            $('#kr-text-'+id).text("삭제");
            $('#kr-content-' + id).removeAttr("readonly"); 
            $('#kr-content-' + id).css("background-color", "white");
            $('#kr-proc-' + id).removeAttr("readonly"); 
            $('#kr-proc-' + id).css("background-color", "white");
        }
    }

    //에러가 발생할수있음...
    function delete_new_kr(e){
        $(e).parent().parent().parent().remove();
    }

    //진척율 표시관련
    function MouseOn(e){

        timer=setTimeout(function(){
                $(e).next().css("display", "");
            }, 1000 * 1);
    }

    //진척율 표시관련
    function MouseOut(e){
        $(e).next().css("display", "none");
    }

    function confirm_delete_objective(objective_id){

        if(objective_id == null){
            return;
        }

        if(confirm("정말 삭제하시겠습니까?\n연동된 모든 내용이 삭제됩니다.")){
            $.ajax({
                type : 'POST',
                url : '/OKR_MAP_Controller/delete_OKR',
                cache : false,
                data : {"ID": objective_id},
                async: false,
                success : function( data ){
                    alert("성공적으로 삭제하였습니다.");
                    window.location.reload();
                },
                error : function( jqxhr , status , error ){
    
                }
            });           
        }
    }




    //OKR_MAP 메뉴 활성화

    elements = document.getElementsByClassName('m-menu__item--active');

    for (var i = 0; i < elements.length; i++) {

        elements[i].classList.remove('m-menu__item--active');

    }



    document.getElementById('okr_map_left_menu').classList.add('m-menu__item--active');


</script>



</html>