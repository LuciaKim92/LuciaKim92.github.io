<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>DWOKR | Dashboard</title>
		<?php echo view("/layout/header"); ?>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">

		

			<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

		  		<?php echo view("layout/side_menu"); ?>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">Dashboard</h3>
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

					<!-- END: Subheader -->
					<div class="m-content">
                        

						

		  				<!-- 테스트부분 [제목 + 상세 넣은거 : Title, contents 구분하는 바가 없음, 각 okr별 구분위해 존재하는 바 없앨 수 있음] 
						<div class="m-portlet  m-portlet--unair">
							<div class="m-widget24">
								<div class="m-widget24__item">
									<h4 class="m-widget24__title">
										OKR
									</h4><br>
									<span class="m-widget24__desc">
										OKR 현황을 나타냅니다
									</span>
								</div>
							</div>
						-->
							<div class="m-portlet  m-portlet--unair">
							<div class="m-portlet__head">
								
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											OKR<br>
										</h3>
										<!--
										<p>
		  									OKR 현황을 나타냅니다.
										</p>
										-->
									</div>
								</div>
							</div>
							<div class="m-portlet__body  m-portlet__body--no-padding">
								<div class="row m-row--no-padding m-row--col-separator-xl">
									<div class="col-xl-4">
										<div class="m-widget24">
											<div class="m-widget24__item" style = "width : 70%;">
                                                <div class = "keyresult-bar" style="font-weight: bold; font-size : 15px; color : black; background-color: #B9D49E; margin-right : 5px; margin-left : 5px" onclick = "openCompKR1();">
														<p class = "text-center text-dark">
															Initiative
														</p>
													</div>
												<div style="width:100%;">
													<div id = "company-kr-div-1" class ="keyresult-content-div" style = "border-color : #B9D49E; margin-left : 5px; overflow : auto; height : 200px;">
                                                        <div class = "text-center okr-badge-div">
                                                            <span class="m-widget24__change">
                                                                <span class="okr-badge m-badge m-badge--brand">2</span>진행
                                                            </span>
                                                            <span class="m-widget24__change">
                                                                <span class="okr-badge m-badge m-badge--success">1</span>완료
                                                            </span>
                                                            <span class="m-widget24__change">
                                                                <span class = "funnel" onclick = "goFunnel();"><span class="okr-badge m-badge m-badge--warning"> 2</span>펀넬</span>
                                                            </span>
                                                        </div>
                                                        <ul><li>냠냠</li></ul>
														<ol class="dash-kr-ol" style="margin-left : 5px; list-style:none;">
                                                            <li style="margin-bottom : 10px; width : 90%; border-bottom: solid 0.25px #919191;"> <div style = "border-radius : 3px; padding : 3px; background-color : #3CABFF; color : white; display: inline; height : 10px; width : 80px;">KR1</div>&nbsp;1. 123</li>
                                                            <li style="margin-bottom : 10px; width : 90%; border-bottom: solid 0.25px #919191;"> <div style = "border-radius : 3px; padding : 3px; background-color : #3CABFF; color : white; display: inline; height : 10px; width : 80px;"> KR1</div>2. 123</li>
                                                            <li style="margin-bottom : 10px; width : 90%; border-bottom: solid 0.25px #919191;"> <div style = "border-radius : 3px; padding : 3px; background-color : #3CABFF; color : white; display: inline; height : 10px; width : 80px;"> KR2</div> 3. 123</li>
														</ol> 
													</div>

                                                    <input id = "initInputPressEnterTest"type="text" onkeydown="initInputPressEnter1(this);">
													
												</div>
											</div>
										</div>
                                        
									</div>
								</div>
							</div>
							
						</div>
															

						<!--제목 + 상세 넣은거 끝-->
					</div>
				</div>
			</div>

			<!-- end:: Body -->

		</div>

        <div class ="fixed-top" id = "init-custom-alert1" style="padding-top : 10px; font-size : 15px; z-index:9999; display : none; border-radius : 5px; width : 330px; height : 5%; background-color : #c9c9c9; top : 5%; right : 0; left : 0; margin: 0 auto; text-align : center; border : 1px solid #c9c9c9;"> <!-- alert -->
        <span id = "init-custom-alert1-content">
            욤욤욤욤욤욤요묘욤욤ㅇㅁ요
        </span>
    </div> 

		<!-- end:: Page -->

		<!-- end::Quick Sidebar -->

		

		
		<!-- begin::Scroll Top [맨위로 버튼]
		<div id="m_scroll_top" class="m-scroll-top">
			<i class="la la-arrow-up"></i>
		</div>

		end::Scroll Top -->

		<!-- begin::Quick Nav 연필
		<ul class="m-nav-sticky" style="margin-top: 30px;">
		  	<img src="//assets/icon/new_cfr_meeting.png" width="50px" height="50px">
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Initiatives 등록" data-placement="left">
				<a href="https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank"><i class="la la-cart-arrow-down"></i></a>
			</li>
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="CFR Meeting 요청" data-placement="left">
				<a href="https://keenthemes.com/metronic/documentation.html" target="_blank"><i class="la la-code-fork"></i></a>
			</li>
			<li class="m-nav-sticky__item" data-toggle="m-tooltip" title="Support" data-placement="left">
				<a href="https://keenthemes.com/forums/forum/support/metronic5/" target="_blank"><i class="la la-life-ring"></i></a>
			</li>
		</ul>

		begin::Quick Nav -->

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


		<script>

			//각 KR 여닫기
			function openCompKR1(){
				$("#company-kr-div-1").toggle();
			};
            function initInputPressEnter1(){
                var code = event.keyCode;
                if(code == '13'){
                    console.log(($("#initInputPressEnterTest").val() == ""));
                    if($("#initInputPressEnterTest").val() == ""){
                        showNotification("내용이 없군요", "init-custom-alert1");
                        return;
                    }
                    if(confirm("저장하시겠습니까?")){
                        showNotification($("#initInputPressEnterTest").val(), "init-custom-alert1");
                        $("#initInputPressEnterTest").val("");
                    }
                }


            }



			

			
			

			
		</script>


	</body>

	<!-- end::Body -->
</html>