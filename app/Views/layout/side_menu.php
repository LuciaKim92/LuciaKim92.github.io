<head>
	<style>
		.m-aside-menu .m-menu__nav .m-menu__item>.m-menu__heading, .m-aside-menu .m-menu__nav .m-menu__item>.m-menu__link{
			table-layout : auto;
		}
	</style>
</head>

				<!-- BEGIN: Left Aside -->
				<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
				<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

					<!-- BEGIN: 왼쪽 메뉴바[OKR 탭] -->
					<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
						<ul class="m-menu__nav ">
							<!-- 대시보드 메뉴 [dashboard_left_menu]-->
							<li id = "dashboard_left_menu" class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a href="/main" class="m-menu__link "><span class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">&nbsp;&nbsp;Dashboard</span></a></li>
							
							<!-- 대시보드 아래 OKR 섹션 -->
							<li class="m-menu__section ">
								<h4 class="m-menu__section-text">OKR</h4>
								<i class="m-menu__section-icon flaticon-more-v2"></i>
							</li>
							<!--OKR MAP 메뉴 [okr_map_left_menu]-->
							<li id = "okr_map_left_menu" class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="/OKR_MAP_Controller" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-text"><img src="/assets/icon/okr_map_icon.png" height="15" width="15">&nbsp;&nbsp;OKR Map</span></a></li>
							
							<!--CFR Meeting 메뉴 [cfr_left_menu]-->
							<li id = "cfr_left_menu" class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="/cfr" class="m-menu__link "><span class="m-menu__item-here"></span><span class="m-menu__link-title"> <span
										 class="m-menu__link-wrap"> <span class="m-menu__link-text"><img src="/assets/icon/cfr_meeting_icon.png" height="15" width="15">&nbsp;&nbsp;CFR Meeting</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">2</span></span> </span></span></a></li>
							
							<!--Sprint Meeting 메뉴 [sprint_left_menu] -->
							<li id = "sprint_left_menu" class="m-menu__item menu-sub-accordion" aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><span
							class="m-menu__link-text"><img src="/assets/icon/reports_icon.png" height="15" width="15">&nbsp;&nbsp;Sprint Meeting</span></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav active open">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span class="m-menu__link"><span class="m-menu__item-here"></span><span class="m-menu__link-text">Applications</span></span></li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="/home/sprint_list" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Sprint Meeting 목록</span></a></li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="/sprint_Meet_Controller/spr_create" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Sprint Meeting 등록</span></a></li>
									</ul>
								</div>
							</li>

							<!--OKR 사례 메뉴 [exam_left_menu] -->
							<li id = "exam_left_menu" class="m-menu__item  m-menu__item--submenu " aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;" class="m-menu__link m-menu__toggle"><span class="m-menu__item-here"></span><span
							class="m-menu__link-text"><img src="/assets/icon/exam_icon.png" height="15" width="15">&nbsp;&nbsp;OKR 사례</span></a>
								<div class="m-menu__submenu "><span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item " aria-haspopup="false" m-menu-link-redirect="1"><a href="/CaseController" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">OKR 사례 목록</span></a></li>
										<li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a href="/CaseController/case_write" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">OKR 사례 등록</span></a></li>
									</ul>
								</div>
							</li>

						</ul>
					</div>

					<!-- END: 왼쪽 메뉴바[OKR 탭] -->
                    
				<!-- END: Left Aside -->
				</div>