<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name=description content="">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title>Jquery Comments Plugin</title>

        <link rel="stylesheet" type="text/css" href="/css/App.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous" />
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>

        <!-- 제이쿼리 -->
        <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!--begin::Global Theme Styles -->
        <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

        <!--end::Global Theme Styles -->
        <link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />
        <?php echo view("/layout/header"); ?>
    </head>

    <!-- begin::Body -->
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

    <?php echo view("/layout/nav-bar"); ?>

        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            <?php echo view("/layout/side_menu"); ?>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">Sprint Meeting 목록</h3>
                        </div>
                    </div>
                </div>
                <!-- END: Subheader -->

                <div class="m-content">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        회의록 조회
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_5" role="tablist">
                                <div class="m-accordion__item m-accordion__item--brand">
                                    <div class="m-accordion__item-head" role="tab" id="m_accordion_5_item_3_head" data-toggle="collapse" href="#m_accordion_5_item_3_body" aria-expanded="true">
                                        <span class="m-accordion__item-icon"><i class="fas fa-filter"></i></span>
                                        <span class="m-accordion__item-title">조건 설정</span>
                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse show" id="m_accordion_5_item_3_body" role="tabpanel" aria-labelledby="m_accordion_5_item_3_head" data-parent="#m_accordion_5">
                                        <div class="m-accordion__item-content" style="padding-top: 40px !important;">
                                            <div class="form-group m-form__group row">
                                                <label class="col-lg-2 col-sm-3 col-form-label">부서</label>
                                                <div class="col-lg-10 col-sm-9">
                                                    <div class="m-select2 m-select2--square">
                                                        <select class="form-control m-select2" id="m_select2_12_1" name="comp" data-placeholder="Square style" style="width: 40%;">
                                                            <option value="DWM" selected><?php echo($_SESSION['comp_nm'])?></option>
                                                        </select>
                                                        <select class="form-control m-select2" id="m_select2_12_2" name="dept" data-placeholder="Square style" style="width: 40%;">
                                                            <option value="<?php echo($_SESSION['team_cd'])?>" selected><?php echo($_SESSION['team_nm'])?></option>
                                                            <?php          
                                                                if(sizeof($DEPTS) != 0) {
                                                                    foreach($DEPTS as $key => $bean){
                                                                        if( $DEPTS[$key]['DEPT_TP'] == '3' ) {
                                                                    ?>
                                                                        <option value="<?=$bean['DEPT_CD']?>">--<?=$bean['DEPT_NM']?></option>
                                                                    <?php
                                                                        } else {
                                                                    ?>
                                                                        <option value="<?=$bean['DEPT_CD']?>"><?=$bean['DEPT_NM']?></option>
                                                                    <?php
                                                                            foreach($DEPTS['SUB_DEPTS'] as $key2 => $bean2) {
                                                                    ?>
                                                                            <option value="<?=$bean2['DEPT_CD']?>">--<?=$bean2['DEPT_NM']?></option>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label class="col-lg-2 col-sm-3 col-form-label">검색어</label>
                                                <div class="col-lg-10 col-sm-9">
                                                    <input type="text" id="find_txt" class="form-control m-input--fixed" placeholder="" style="width: 60%;">
                                                </div>
                                            </div>
                                            <div class="m-form__seperator m-form__seperator--dashed"></div>
                                            <div class="m-form__seperator m-form__seperator--dashed"></div>
                                            <div class="form-group m-form__group row">
                                                <label class="col-lg-2 col-sm-3 col-form-label">기간</label>
                                                <div class="col-lg-10 col-sm-9">
                                                    <select id="date_tp" class="form-control m-input--fixed" style="margin-bottom: 3px; cursor: pointer;">
                                                        <option value="MEET" selected>미팅일자</option>
                                                    </select>
                                                    <div class="date_select">
                                                        <div id="date_group" class="btn-group btn-group-toggle" data-toggle="buttons">
                                                            <label class="btn m-btn--square  btn-secondary m-btn m-btn--custom m-btn--label-metal active" onclick="setDate('d', 0)">
                                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> 오늘
                                                            </label>
                                                            <label class="btn m-btn--square  btn-secondary m-btn m-btn--custom m-btn--label-metal" onclick="setDate('d', -7)">
                                                                <input type="radio" name="options" id="option2" autocomplete="off"> 1주일
                                                            </label>
                                                            <label class="btn m-btn--square  btn-secondary m-btn m-btn--custom m-btn--label-metal" onclick="setDate('m', -1)">
                                                                <input type="radio" name="options" id="option3" autocomplete="off"> 1개월
                                                            </label>
                                                            <label class="btn m-btn--square  btn-secondary m-btn m-btn--custom m-btn--label-metal" onclick="setDate('m', -3)">
                                                                <input type="radio" name="options" id="option3" autocomplete="off"> 3개월
                                                            </label>
                                                            <label class="btn m-btn--square  btn-secondary m-btn m-btn--custom m-btn--label-metal" onclick="setDate('m', -6)">
                                                                <input type="radio" name="options" id="option3" autocomplete="off"> 6개월
                                                            </label>
                                                        </div>
                                                        <div class="date_picker">
                                                            <div class="input-group date" style="display: inline-flex; width: 160px;">
                                                                <input type="date" class="form-control m-input" id="st_dt">
                                                            </div> ~
                                                            <div class="input-group date" style="display: inline-flex; width: 160px;">
                                                                <input type="date" class="form-control m-input" id="ed_dt">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__actions m-form__actions" style="padding: 20px; text-align: center;">
                                                <div class="row">
                                                    <div class="col-lg-12 ml-lg-auto">
                                                        <button type="submit" class="btn btn-brand" style="width: 100px;" onclick="searchSprMeet();">검색</button>
                                                        <button type="reset" class="btn btn-secondary" style="width: 100px;" onclick="reset();">초기화</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    //기간 설정
                                    var ed_date = new Date();
                                    document.getElementById('st_dt').valueAsDate = new Date();
                                    document.getElementById('ed_dt').valueAsDate = ed_date;

                                    function setDate(date_tp, number) {
                                        var set_date = new Date();

                                        if (date_tp == 'd') {
                                            set_date.setDate(ed_date.getDate() + number);
                                        } else {
                                            set_date.setMonth(ed_date.getMonth() + number);
                                        }

                                        document.getElementById('st_dt').valueAsDate = set_date;
                                    }
                                </script>

                                <div class="m-accordion__item m-accordion__item--info">
                                    <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_5_item_2_head" data-toggle="collapse" href="#m_accordion_5_item_2_body" aria-expanded="false">
                                        <span class="m-accordion__item-icon"><i class="fas fa-poll-h"></i></span>
                                        <span class="m-accordion__item-title">조회 결과</span>
                                        <span class="m-accordion__item-mode"></span>
                                    </div>
                                    <div class="m-accordion__item-body collapse" id="m_accordion_5_item_2_body" class=" " role="tabpanel" aria-labelledby="m_accordion_5_item_2_head" data-parent="#m_accordion_5">
                                        <div class="p-0 m-accordion__item-content">
                                            <div id="root"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
    

    	<!--begin::Global Theme Bundle -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="/assets/demo/demo12/base/scripts.bundle.js" type="text/javascript"></script>
        <script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<script src="/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/crud/forms/widgets/select2.js" type="text/javascript"></script>
		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="/assets/app/js/dashboard.js" type="text/javascript"></script>

		<!--end::Page Scripts -->

        <script>
            function reset() {
                //초기화
                $("select[name=comp]").val("DWM");
                $("select[name=dept]").val("<?php echo($_SESSION['team_cd'])?>");
                $("#find_txt").val("");
                setDate('d', 0);
                $("#option1").parent().addClass("active");
                $("#option1").parent().siblings().removeClass("active");

                $('#m_accordion_5_item_2_head').addClass('collapsed');
                $('#m_accordion_5_item_2_body').removeClass('show');
                ReactDOM.unmountComponentAtNode(document.getElementById('root'));
            }

            function searchSprMeet() {
                //기존 데이터 삭제
                if($('#root').children().length != 0) {
                    ReactDOM.unmountComponentAtNode(document.getElementById('root'));
                }

                //입력 값 가져오기
                var formData = new FormData();
                formData.append('DWGP_CD', $("select[name=comp]").val());
                formData.append('DEPT_CD', $("select[name=dept]").val());
                formData.append('FIND_TXT', $("#find_txt").val());
                formData.append('DATE_TP', $("#date_tp").val());
                formData.append('ST_DT', $("#st_dt").val());
                formData.append('ED_DT', $("#ed_dt").val());

                $.ajax({
                    type : 'POST',
                    url : '/Sprint_Meet_Controller/get_spr_meet_list',
                    data : formData,
                    contentType: false,
                    processData: false,
                    success : function(res){
                        //console.log(res);
                        $('#m_accordion_5_item_2_head').removeClass('collapsed');
                        $('#m_accordion_5_item_2_body').addClass('show');

                        var data = JSON.parse(res);
                        ReactDOM.render(React.createElement(App, {fields: data}, null), document.getElementById('root'));
                    },
                    error : function(jqxhr, status, error){
                        //console.log(jqxhr, status, error);
                    }
                });
            }
        </script>
        <script src="https://unpkg.com/react/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-bootstrap@next/dist/react-bootstrap.min.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
        <script>var Alert = ReactBootstrap.Alert;</script>
        <script type="text/babel" src="/src/App.js" charset="utf-8"></script>
    </body>
</html>