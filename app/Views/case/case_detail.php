<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name=description content="">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title>Jquery Comments Plugin</title>

        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous" />

        <!-- 폰트어썸 -->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>

        <!-- 제이쿼리 -->
        <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

        <!--begin::Global Theme Styles -->
        <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

        <?php echo view("/layout/header"); ?>
    </head>

    <style>
		#m_header_nav { background-color: rgb(32, 31, 43) !important; }
        #contents th { width: 25%; background-color: #fafafa; }
        #contents th, #contents td { padding: 20px 10px; line-height: 1.5; }
        .m-messenger__messages { overflow: visible !important; }
        .m-messenger__message { position: relative; }
        .m-messenger__message-body { cursor: pointer; }
        .m-messenger__message-username,
        .m-messenger__message-text { text-align: left; }
        .date { font-size: .75rem; margin-left: 7px; }
        .my-date { font-size: .75rem; color: white; }
        .m-nav__section i { cursor: pointer; font-size: 1.1rem; }
        .m-messenger__message .m-dropdown__body { padding: 5px !important;}
    </style>

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
                            <h3 class="m-subheader__title ">OKR 사례 목록</h3>
                        </div>
                    </div>
                </div>
                <!-- END: Subheader -->

                <div class="m-content">
						<div class="row">
							<div class="col-lg-8">

								<!--begin::사례 내용-->
								<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													OKR 사례 내용
												</h3>
											</div>
										</div>
                                        <div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
													<a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl">
                                                        <?php 
                                                            if (sizeof($CLIP) != 0) {
                                                                foreach ($CLIP as $key => $bean) {
                                                                    if ($bean['EMPY_NO'] == $_SESSION['emp_no']) {
                                                                        $isClip = 'true';
                                                                    }
                                                                }
                                                                if ($isClip == 'true') {
                                                                ?>
                                                                    <i class="la la-heart m--font-brand"></i>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <i class="la la-heart-o m--font-brand"></i>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                    <i class="la la-heart-o m--font-brand"></i>
                                                                <?php
                                                            }
                                                        ?>
													</a>
													<div class="m-dropdown__wrapper">
														<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 17px;"></span>
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
                                                                        <?php
                                                                            if(sizeof($CLIP) == 0) {
                                                                            ?>
                                                                                <li class="m-nav__item">
                                                                                    <i class="m-nav__link-icon la la-user-times"></i>&nbsp;&nbsp;
                                                                                    <span class="m-nav__link-text">스크랩한 사원이 없습니다.</span>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                            foreach($CLIP as $key => $bean) {
                                                                            ?>
                                                                                <li class="m-nav__item">
                                                                                    <a href="" class="m-nav__link">
                                                                                        <i class="m-nav__link-icon la la-user"></i>
                                                                                        <span class="m-nav__link-text"><?=$bean['EMP_NM']?></span>
                                                                                    </a>
                                                                                </li>
                                                                            <?php
                                                                            }
                                                                        ?>
																	</ul>
																</div>
															</div>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
                                    <div class="m-portlet__body">
                                        <div class="m-section">
                                            <div class="m-section__content">
                                                <table class="table table-bordered m-table" id="contents">
                                                    <tbody>
                                                        <tr>
															<th scope="row">Objective</th>
															<td><?php echo($DETAIL[0]['OBJECTIVE']); ?></td>
														</tr>
                                                        <?php 
                                                            foreach($KR as $key => $bean) {
                                                                if ($key == 0) {
                                                            ?>
                                                                    <tr>
                                                                        <th scope="row" rowspan="<?=sizeof($KR)?>">KR</th>
                                                                        <td><?php echo($KR[$key]['CONTENT']); ?></td>
                                                                    </tr>
                                                            <?php
                                                                } else {
                                                            ?>
                                                                <tr>
                                                                    <td><?=$bean['CONTENT']?></td>
                                                                </tr>
                                                            <?php
                                                                }
                                                            }
                                                        ?>
                                                        <tr>
                                                            <th scope="row">사례유형</th>
                                                            <td><?php $case_tp = $DETAIL[0]['CASE_TP'] == '0' ? '도전 성공 사례' : '도전 축적 사례'; echo($case_tp); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">지식의 제목</th>
                                                            <td><?php echo($DETAIL[0]['TITLE']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">목표 성과</th>
                                                            <td><?php echo($DETAIL[0]['TARGET']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">얻은 성과</th>
                                                            <td><?php echo($DETAIL[0]['COTCOME']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">맥락 설명</th>
                                                            <td><?php echo($DETAIL[0]['CONTEXT']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">전략 방향</th>
                                                            <td><?php echo($DETAIL[0]['STRATEGY']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">핵심 지식</th>
                                                            <td><?php echo($DETAIL[0]['KNOWHOW']); ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<!--end::사례 내용-->
                            </div>

                            <div class="col-lg-4">

                                <!--begin::댓글-->
                                <div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
                                    <div class="m-portlet__head">
                                        <div class="m-portlet__head-caption">
                                            <div class="m-portlet__head-title">
                                                <h3 class="m-portlet__head-text">
                                                    댓글
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <!--begin::Section-->
                                        <div class="m-section">
                                            <div class="m-section__content text-center">
                                                <div class="m-messenger m-messenger--message-arrow m-messenger--skin-light">
                                                    <div class="m-messenger__messages m-scrollable">
                                                        <div class="m-messenger__wrapper">
                                                            <div class="m-messenger__message m-messenger__message--in">
                                                                <div class="m-messenger__message-pic">
                                                                    <img src="../../assets/app/media/img//users/user3.jpg" alt="" />
                                                                </div>
                                                                <div class="m-messenger__message-body m-dropdown m-dropdown--up m-dropdown--inline m-dropdown--align-right" m-dropdown-toggle="hover" aria-expanded="true">
                                                                    <div class="m-messenger__message-arrow"></div>
                                                                    <div class="m-messenger__message-content">
                                                                        <div class="m-messenger__message-username">
                                                                            김경민
                                                                            <span class="date">2021.11.09 3:37 p.m.</span>
                                                                        </div>
                                                                        <div class="m-messenger__message-text">
                                                                            좋은 사례네요!
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-dropdown__wrapper" style="width: 30% !important;">
                                                                        <div class="m-dropdown__inner">
                                                                            <div class="m-dropdown__body">
                                                                                <div class="m-dropdown__content">
                                                                                    <ul class='m-nav d-flex justify-content-center'>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-heart-o'></i>
                                                                                        </li>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-reply'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-messenger__wrapper">
                                                            <div class="m-messenger__message m-messenger__message--in">
                                                                <div class="m-messenger__message-pic">
                                                                    <img src="../../assets/app/media/img//users/user3.jpg" alt="" />
                                                                </div>
                                                                <div class="m-messenger__message-body m-dropdown m-dropdown--up m-dropdown--inline m-dropdown--align-right" m-dropdown-toggle="hover" aria-expanded="true">
                                                                    <div class="m-messenger__message-arrow"></div>
                                                                    <div class="m-messenger__message-content">
                                                                        <div class="m-messenger__message-username">
                                                                            고지훈
                                                                            <span class="date">2021.11.09 3:37 p.m.</span>
                                                                        </div>
                                                                        <div class="m-messenger__message-text">
                                                                            공유 감사합니다.
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-dropdown__wrapper" style="width: 30% !important;">
                                                                        <div class="m-dropdown__inner">
                                                                            <div class="m-dropdown__body">
                                                                                <div class="m-dropdown__content">
                                                                                    <ul class='m-nav d-flex justify-content-center'>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-heart-o'></i>
                                                                                        </li>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-reply'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="m-messenger__wrapper">
                                                            <div class="m-messenger__message m-messenger__message--out">
                                                                <div class="m-messenger__message-body m-dropdown m-dropdown--up m-dropdown--inline m-dropdown--align-right" m-dropdown-toggle="hover" aria-expanded="true">
                                                                    <div class="m-messenger__message-arrow"></div>
                                                                    <div class="m-messenger__message-content">
                                                                        <div class="m-messenger__message-username">
                                                                            <span class="my-date">2021.11.09 3:37 p.m.</span>
                                                                        </div>
                                                                        <div class="m-messenger__message-text">
                                                                            저도 열심히 하겠습니다!
                                                                        </div>
                                                                    </div>
                                                                    <div class="m-dropdown__wrapper" style="width: 50% !important;">
                                                                        <div class="m-dropdown__inner">
                                                                            <div class="m-dropdown__body">
                                                                                <div class="m-dropdown__content">
                                                                                    <ul class='m-nav d-flex justify-content-center'>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-heart-o'></i>
                                                                                        </li>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-reply'></i>
                                                                                        </li>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-edit'></i>
                                                                                        </li>
                                                                                        <li class='m-nav__section m-nav__section--first text-center'>
                                                                                            <i class='la la-trash'></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
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
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                </div>
                                <!--end::댓글-->
                            </div>
						</div>
    

    	<!--begin::Global Theme Bundle -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
        <script src="https://unpkg.com/@popperjs/core@2"></script>
		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="/assets/app/js/dashboard.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/base/treeview.js" type="text/javascript"></script>
		<script src="/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
		<script src="/assets/demo/default/custom/components/base/sweetalert2.js" type="text/javascript"></script>
		<!--end::Page Scripts -->

        <script>
        </script>
        
    </body>
</html>