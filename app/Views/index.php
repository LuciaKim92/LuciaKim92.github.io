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
																<li class ="dash-kr-li" id = "dash-kr-li-team-<?=$i?>" onclick ="setViewInitiativeToolKR(<?=$bean['ID']?>,'0')"><?=$bean['CONTENT']?></li>
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
		<!-- end:: Page -->

		<!-- begin::Quick Sidebar -->
		<div id="m_quick_sidebar" class="m-quick-sidebar m-quick-sidebar--tabbed m-quick-sidebar--skin-light">
			<div class="m-quick-sidebar__content m--hide">
				<span id="m_quick_sidebar_close" class="m-quick-sidebar__close"><i class="la la-close"></i></span>
				<ul id="m_quick_sidebar_tabs" class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_quick_sidebar_tabs_messenger" role="tab">Messages</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_settings" role="tab">Settings</a>
					</li>
					<li class="nav-item m-tabs__item">
						<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_quick_sidebar_tabs_logs" role="tab">Logs</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="m_quick_sidebar_tabs_messenger" role="tabpanel">
						<div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
							<div class="m-messenger__messages m-scrollable">
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="/assets/app/media/img//users/user3.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Hi Bob. What time will be the meeting ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Hi Megan. It's at 2.30PM
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="/assets/app/media/img//users/user3.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Will the development team be joining ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes sure. I invited them as well
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">2:30PM</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="/assets/app/media/img//users/user3.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. For the Coca-Cola Mobile App project as well ?
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Yes, sure.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Please also prepare the quotation for the Loop CRM project as well.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__datetime">3:15PM</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-no-pic m--bg-fill-danger">
											<span>M</span>
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Noted. I will prepare it.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--out">
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-text">
													Thanks Megan. I will see you later.
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="m-messenger__wrapper">
									<div class="m-messenger__message m-messenger__message--in">
										<div class="m-messenger__message-pic">
											<img src="/assets/app/media/img//users/user3.jpg" alt="" />
										</div>
										<div class="m-messenger__message-body">
											<div class="m-messenger__message-arrow"></div>
											<div class="m-messenger__message-content">
												<div class="m-messenger__message-username">
													Megan wrote
												</div>
												<div class="m-messenger__message-text">
													Sure. See you in the meeting soon.
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="m-messenger__seperator"></div>
							<div class="m-messenger__form">
								<div class="m-messenger__form-controls">
									<input type="text" name="" placeholder="Type here..." class="m-messenger__form-input">
								</div>
								<div class="m-messenger__form-tools">
									<a href="" class="m-messenger__form-attachment">
										<i class="la la-paperclip"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_quick_sidebar_tabs_settings" role="tabpanel">
						<div class="m-list-settings m-scrollable">
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">General Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Email Notifications</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Site Tracking</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">SMS Alerts</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Storage</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
							<div class="m-list-settings__group">
								<div class="m-list-settings__heading">System Settings</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">System Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Error Reporting</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Applications Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Backup Servers</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" checked="checked" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
								<div class="m-list-settings__item">
									<span class="m-list-settings__item-label">Audit Logs</span>
									<span class="m-list-settings__item-control">
										<span class="m-switch m-switch--outline m-switch--icon-check m-switch--brand">
											<label>
												<input type="checkbox" name="">
												<span></span>
											</label>
										</span>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="m_quick_sidebar_tabs_logs" role="tabpanel">
						<div class="m-list-timeline m-scrollable">
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									System Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered <span class="m-badge m-badge--warning m-badge--wide">important</span></a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoice received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89% <span class="m-badge m-badge--success m-badge--wide">resolved</span></a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error</a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down <span class="m-badge m-badge--danger m-badge--wide">pending</span></a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Applications Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received <span class="m-badge m-badge--info m-badge--wide">urgent</span></a>
										<span class="m-list-timeline__time">7 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered</a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoices received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89%</a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error <span class="m-badge m-badge--info m-badge--wide">pending</span></a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down</a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
								</div>
							</div>
							<div class="m-list-timeline__group">
								<div class="m-list-timeline__heading">
									Server Logs
								</div>
								<div class="m-list-timeline__items">
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received</a>
										<span class="m-list-timeline__time">7 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">12 new users registered</a>
										<span class="m-list-timeline__time">Just now</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">System shutdown</a>
										<span class="m-list-timeline__time">11 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-danger"></span>
										<a href="" class="m-list-timeline__text">New invoice received</a>
										<span class="m-list-timeline__time">20 mins</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-warning"></span>
										<a href="" class="m-list-timeline__text">Database overloaded 89%</a>
										<span class="m-list-timeline__time">1 hr</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">System error</a>
										<span class="m-list-timeline__time">2 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">Production server down</a>
										<span class="m-list-timeline__time">3 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-success"></span>
										<a href="" class="m-list-timeline__text">Production server up</a>
										<span class="m-list-timeline__time">5 hrs</span>
									</div>
									<div class="m-list-timeline__item">
										<span class="m-list-timeline__badge m-list-timeline__badge--state-info"></span>
										<a href="" class="m-list-timeline__text">New order received</a>
										<span class="m-list-timeline__time">1117 hrs</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- end::Quick Sidebar -->
		<!-- Float Button [CFR MEEING 작성] -->
		<div id = "newCFRBtn" class="fixed-bottom" style="position: fixed; bottom: 20px; right: 65px; left : auto">
			<img src="/assets/icon/new_cfr_meeting.png" width="35px" height="35px">
		</div>
		
		<!-- Float Button END -->
		 
		<!-- Float Button [맨위로 버튼] -->
		<a href="#">
			<div class="fixed-bottom" style="position: fixed; bottom: 20px; right: 20px; left : auto">
				<img src="/assets/icon/top_icon.png" width="35px" height="35px">
			</div>
		</a>
		<!-- Float Button END -->
		
		<!--Float Button 누를 시 활성화 되는 창-->
		<div id ="newCFRMenu" class="fixed-bottom bg-dark text-center" style="display : none; position: fixed; bottom: 80px; right: 75px; left : auto; width : 200px">
			<div class = "text-light add-menu" style="background-color : #7957ad" onclick = "openWriteModal();">
				Initiatives 등록
			</div>
			<div class = "text-light add-menu" style="background-color : #31859c" onclick = "newCFR();">
		  		CFR Meeting 요청
			</div>
		</div>
		
		<?php
			//$mydata['id'] = "100027";
			echo view('/initiative/viewModal.php');
			echo view('/initiative/writeModal.php');
		?>

		
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

			// CFR 연필버튼 눌렀을 때 창 뜨게하기
			var check = $("#newCFRBtn");
			check.click(function(){
				$("#newCFRMenu").toggle();
			});
			

			//조직도 누를 시 조직도 페이지로 이동
			function goDeptPage(){
				document.location = '/dept'
			}
			
			//로그아웃 버튼 누를 시 로그아웃
			function logout(){
				if(confirm("로그아웃 하시겠습니까?")) {document.location = 'login/logout';}
			}

			//각 KR 여닫기
			function openCompKR(){
				$("#company-kr-div").toggle();
			};
			function openDeptKR(){
				$("#dept-kr-div").toggle();
			};
			function openTeamKR(){
				$("#team-kr-div").toggle();
			};

			//Funnel로 이동
			function goFunnel(){
				if(confirm("OOO의 OOOOOO로 이동하시겠습니까?")) document.location = '/initiativeController/view';
			}
			/*
			function newInitiative(){
				if(confirm("Initiative 작성창으로 이동하시겠습니까?")) document.location = '/initiative/write';
			}
			*/
			function newCFR(){
				if(confirm("CFR Meeting 작성창으로 이동하시겠습니까?")) document.location = '/cfr/write';
			}
			

            //대시보드 메뉴 활성화
            elements = document.getElementsByClassName('m-menu__item--active');
            for (var i = 0; i < elements.length; i++) {
                elements[i].classList.remove('m-menu__item--active');
            }
            document.getElementById('dashboard_left_menu').classList.add('m-menu__item--active');
			
			//대시보드 -> Initiative 연결
			
			function openInitiative(id, content){
				<?php 	//$mydata['id'] = "<script>document.write(".id.")</script>"; ?>
				$("#id").val(id);
				//열겠냐 하지말고 걍 열리게하기

				if(confirm("["+ content + "] 해당 내용의 Initiative Tool을 열겠습니까?")){
					
					$("#form").submit();
					//document.location = '/InitiativeController?id='+id;
					<?php //return view('/initiative/write.php', $mydata); ?>
					// $.ajax({
					// 	url:'/InitiativeController',
					// 	type:'get',
					// 	data:{
					// 		id : id
					// 	},
					// 	success:function(data){
							
					// 	}
					// });

				}
			}



			

			
			

			
		</script>


	</body>

	<!-- end::Body -->
</html>