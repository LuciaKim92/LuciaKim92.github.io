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

		<?php echo view("/layout/nav-bar"); ?>

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
									<!--회사 OKR-->
									<div class="col-xl-4">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
													<?php echo($_SESSION['comp_nm'])?>
												</h4><br>
												<br>
												<div style="width:100%;">
													<div class = "text-light objective-div" style="background-color:#7957ad; margin-right : 5px; margin-left : 5px">
		  												<span class="font-weight-bold" style="margin-left : 5px">
															ObJective
														</span>
														<br><hr class ="okr-hr">
														<span id = "comp-obj-span" style="margin-left : 20px">
															<?php echo($dashBoardData['comp']['obj']); ?>
														</span>
													</div>
													<div class = "keyresult-bar" style="margin-right : 5px; margin-left : 5px" onclick = "openCompKR();">
														<p class = "text-center text-dark">
															Key Results
														</p>
													</div>
													<div id = "company-kr-div" class ="keyresult-content-div" style = "border-color : #7957ad; margin-left : 5px;  overflow : auto;">
														<ol class="dash-kr-ol">
															<?php                   
																$i = 1;                  
																foreach($dashBoardData['comp']['krList'] as $key => $bean){
																?>
																<li class ="dash-kr-li" id = "dash-kr-li-comp-<?=$i?>"><?=$bean['CONTENT']?></li>
																<?php
																$i = $i + 1;
																}
															?>
														</ol> 
													</div>
													<div class = "text-center okr-badge-div">
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--brand"><?=$i-1?></span>진행
														</span>
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--success"><?=$dashBoardData['comp']['compKrListCnt']?></span>완료
														</span>
														<span class="m-widget24__change">
															<span class = "funnel" onclick = "goFunnel();"><span class="okr-badge m-badge m-badge--warning"> 2</span>펀넬</span>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--부문 OKR-->
									<div class="col-xl-4">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
												<?php echo($_SESSION['dept_nm'])?>
												</h4><br>
												<br>
												<div style="width:100%">
													<div class = "text-light objective-div" style = "background-color:#31859c; margin-right : 5px; margin-left : 5px">
		  												<span class="font-weight-bold" style="margin-left : 5px">
															ObJective
														</span>
														<br><hr class = "okr-hr">
														<span style="margin-left : 20px">
															<?php echo($dashBoardData['dept']['obj']); ?>
														</span>
													</div>
													<div class = "keyresult-bar" style = "margin-right : 5px; margin-left : 5px" onclick = "openDeptKR();">
														<p class = "text-center text-dark">
															Key Results
														</p>
													</div>
													<div id = "dept-kr-div" class ="keyresult-content-div" style = "border-color : #31859c; overflow : auto;">
														<ol class="dash-kr-ol">
															<?php                   
																$i = 1;                  
																foreach($dashBoardData['dept']['krList'] as $key => $bean){
																?>
																<li class ="dash-kr-li" id = "dash-kr-li-dept-<?=$i?>"><?=$bean['CONTENT']?></li>
																<?php
																$i = $i + 1;
																}
															?>
														</ol> 
													</div>
													<div class = "text-center okr-badge-div">
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--brand"><?=$i-1?></span>진행
														</span>
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--success"><?=$dashBoardData['dept']['compKrListCnt']?></span>완료
														</span>
														<span class="m-widget24__change">
															<span class = "funnel" onclick = "goFunnel();"><span class="okr-badge m-badge m-badge--warning"> 2</span>펀넬</span>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!--팀 OKR-->
									<div class="col-xl-4">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<h4 class="m-widget24__title">
												<?php echo($_SESSION['team_nm'])?>
												</h4><br>
												<br>
												<div style="width:100%">
													<div class = "text-light objective-div" style="background-color:#558ed5; margin-left : 5px; margin-right : 5px">
		  												<span class="font-weight-bold" style="margin-left : 5px">
															ObJective
														</span>
														<br><hr class = "okr-hr">
														<span style="margin-left : 20px">
															<?php echo($dashBoardData['team']['obj']); ?>
														</span>
													</div>
													<div class ="keyresult-bar" style = "margin-right : 5px; margin-left : 5px" onclick = "openTeamKR();">
														<p class = "text-center text-dark">
															Key Results
														</p>
													</div>
													<form id="form" action="/InitiativeController/view" method="get">
													<input type="hidden" id="id" name="id" value="">
													<div id = "team-kr-div" class ="keyresult-content-div" style = "border-color : #558ed5; overflow : auto;">
														<ol class="dash-kr-ol">
															<?php
																$i = 1;
																$id = array();                  
																foreach($dashBoardData['team']['krList'] as $key => $bean){
																	$id[$i-1]=$bean['ID'];
																?>								
																<li class ="dash-kr-li" id = "dash-kr-li-team-<?=$i?>" onclick ="setViewInitiativeToolKR(<?=$bean['ID']?>)"><?=$bean['CONTENT']?></li>
																<?php
																	$i = $i + 1;
																}
															?>
														</ol> 
													</div>
													</form>
													<div class = "text-center okr-badge-div">
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--brand"><?=$i-1?></span>진행
														</span>
														<span class="m-widget24__change">
															<span class="okr-badge m-badge m-badge--success"><?=$dashBoardData['team']['compKrListCnt']?></span>완료
														</span>
														<span class="m-widget24__change" data-toggle="modal" data-target="#initiative-view-modal">
															<span class = "funnel"><span class="okr-badge m-badge m-badge--warning"> 2</span>펀넬</span>
														</span>
													</div>
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