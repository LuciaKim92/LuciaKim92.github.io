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

                <!-- 시작하는부분 -->
                <div class="m-content">

                <div class="row">

                    <div class="col-md-4" id="parent">
                        <div><a class="card-link" data-toggle="collapse" data-parent="#card-parent" onclick="reset()" href=".card-child"><h4>대원씨티에스</h4></a></div>
                        <div id="card-parent">
                            <div class="card">
                                <div class="card-header">
                                    <div>Objective</div>
                                    <hr>
                                    <span>지속 가능한 1조 기업 기반 완성 "축적을 통한 Scale-Up"</span>
                                
                                </div>

                                <div class="card-header" style="text-align:center;">
                                    <a class="card-link" data-toggle="collapse" data-parent="#card-parent" href="#card-element-534736">Key Results</a>
                                </div>
                                <div id="card-element-534736" class="collapse">
                                    <div class="card-body">
                                        <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
                                        <ol style="padding: 0px 0px 0px 10px">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ol>
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
                                                add_column('#card-child-1' , '<?=$bean["DEPT_CD"]?>', '<?=$bean["DEPT_NM"]?>', '<?=$bean["OBJECTIVE_ID"]?>','<?=$bean["OBJECTIVE"]?>', '<?=$bean["IS_UP_DEPT"]?>');

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


                    <div class="col-md-4" id="child-3" style="display:none;">
                        <div class="collapse show card-child">
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

    function reset(){
        if($(".col-md-3").attr("class") == 'col-md-3'){
            $(".col-md-3").attr("class", "col-md-4");
            $("#child-3").css("display", "none");
        }
        
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
            data : {"DEPT_UP_CD": dept_cd},
            async: false,
            success : function( data ){
            
                const result = jQuery.parseJSON(data);
                $(card_id).empty();
                for(var i=0; i < result.length; i++){
                    add_column(card_id , result[i]['DEPT_CD'], result[i]['DEPT_NM'], result[i]['OBJECTIVE_ID'], result[i]['OBJECTIVE'], result[i]['IS_UP_DEPT']);
                }
            },
            error : function( jqxhr , status , error ){
  
            }
        });

    }

    function add_column(card_id ,dept_cd, dept_nm, objective_id, objective, is_up_dept){

        var objective_temp;
        var myhref;
        var myfunction;

        if(objective == '' || objective == null)
            objective_temp = 'Objective가 등록되지 않았습니다.';
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


        if(is_up_dept == 'Y'){
            var html = `
                    <div id="`+dept_cd+`">
                        <div><a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href=`+myhref+` onclick="`+myfunction+`" ><h4> `+dept_nm+` </h4></a></div>

                        <div id="card-`+dept_cd+`">
                            <div class="card">
                                <div class="card-header">
                                    <div>Objective</div>
                                    <hr>
                                    <span>`+objective_temp+`</span>
                                </div>

                                <div class="card-header" style="text-align:center;">
                                    <a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href="#card-`+dept_cd+`-element">Key Results</a>
                                </div>
                                <div id="card-`+ dept_cd +`-element" class="collapse">
                                    <div class="card-body">
                                        <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
                    `;

        }

        else{
            var html = `
                    <div id="`+dept_cd+`">
                        <div><h4> `+dept_nm+` </h4></div>

                        <div id="card-`+dept_cd+`">
                            <div class="card">
                                <div class="card-header">
                                    <div>Objective</div>
                                    <hr>
                                    <span>`+objective_temp+`</span>
                                </div>

                                <div class="card-header" style="text-align:center;">
                                    <a class="card-link" data-toggle="collapse" data-parent="#card-`+dept_cd+`" href="#card-`+dept_cd+`-element">Key Results</a>
                                </div>
                                <div id="card-`+ dept_cd +`-element" class="collapse">
                                    <div class="card-body">
                                        <div style="text-align:center; text-decoration: underline;"><h4>Key Results</h4></div>
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
                    html = html.concat("<li style='margin:10px 0px 10px 0px'>"+ result[i]['CONTENT'] + "</li>");
                    }
                    html = html.concat('</ol>');

                }

                else
                    html = html.concat('<div style="text-align:center; margin-top:10px;">KR가 등록되지 않았습니다.</div>');

            },
            error : function( jqxhr , status , error ){
                html = html.concat('<div style="text-align:center; margin-top:10px;">KR가 등록되지 않았습니다.</div>');
            }
        });

        html = html.concat(html2);
        $(card_id).append(html);

    }


</script>



</html>