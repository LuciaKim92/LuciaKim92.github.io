<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name=description content="">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title>Jquery Comments Plugin</title>

		<!-- Bootstrap -->
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous" />

        <!-- fontawesome -->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" data-auto-replace-svg="nest"></script>

        <!-- jQuery -->
        <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!--begin::Global Theme Styles -->
        <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

        <?php echo view("/layout/header"); ?>
    </head>

    <style>
		.m-portlet__head-title small { margin-left: 10px; color: gray; font-size: 0.9rem; }
		.link-title { width:135%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        input[type=text], textarea, button { border-radius: 3.25px !important; }
		.m-form .m-portlet__body { padding: 60px 0 !important;}
		.m-portlet__foot .row { padding: 20px 0 !important; }
		#m_header_nav { background-color: rgb(32, 31, 43) !important; }
		#confirm th { width: 30%; background-color: #fafafa; }
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
                            <h3 class="m-subheader__title ">OKR 사례 등록</h3>
                        </div>
                    </div>
                </div>
                <!-- END: Subheader -->

                <div class="m-content">
						<div class="row">
							<div class="col-lg-4">

								<!--begin::OKR Tree View-->
								<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title align-items-end">
												<h3 class="m-portlet__head-text">
													OKR 선택
												</h3>
												<small>initiative를 선택해주세요.</small>
											</div>
										</div>
									</div>
									<div class="m-portlet__body">
                                        <div id="m_tree_2" class="tree-demo overflow-auto"></div>
									</div>
								</div>
								<!--end::OKR Tree View-->

								<!--begin::검수 요청/결과-->
								<div class="m-portlet m-portlet--mobile m-portlet--body-progress-">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													OKR 사례 검수 요청 및 결과
												</h3>
											</div>
										</div>
									</div>
									<div class="m-portlet__body" style="padding-bottom:5px;">
                                        <!--begin::Section-->
										<div class="m-section">
											<div class="m-section__content text-center">
												<table class="table table-bordered table-hover text-start" id="confirm">
													<tbody>
														<tr>
															<th scope="row">검수요청일시</th>
															<td>
																<?php
																	$cfm = ($DETAIL == null || $DETAIL[0]['CONFIRM_DTM'] == null) ? "" : $DETAIL[0]['CONFIRM_DTM'];
																	echo($cfm);
																?>
															</td>
														</tr>
														<tr>
															<th scope="row">검수자</th>
															<td>
																<?php
																	$cfm = ($DETAIL == null || $DETAIL[0]['CONFIRM_EMP_NM'] == null) ? "" : $DETAIL[0]['CONFIRM_EMP_NM'];
																	echo($cfm);
																?>
															</td>
														</tr>
														<tr>
															<th scope="row">검수자 의견</th>
															<td>
																<?php
																	$cfm = ($DETAIL == null || $DETAIL[0]['CONFIRM_NOTES'] == null) ? "" : $DETAIL[0]['CONFIRM_NOTES'];
																	echo($cfm);
																?>
															</td>
														</tr>
													</tbody>
												</table><br>
												<?php
													if($DETAIL == null || $DETAIL[0]['CONFIRM_DTM'] == null) {
													?>
														<button type="submit" class="btn btn-secondary m-btn" onclick="jsSubmit('CONFIRM', '<? echo($DETAIL == null ? '' : $DETAIL[0]['ID']) ?>')">검수 요청</button>
													<?
													} else {
														if($DETAIL[0]['CONFIRM_NOTES'] == null) {
													?>
														<button class="btn btn-secondary m-btn" disabled="disabled">검수 대기중</button>
													<?
														} else {
													?>
															<button type="submit" class="btn btn-secondary m-btn" onclick="jsSubmit('RECONFIRM', '<? echo($DETAIL[0]['ID']) ?>')">검수 재요청</button>
													<?
														}
													}
												?>
												
											</div>
										</div>
										<!--end::Section-->
									</div>
								</div>
								<!--end::검수 요청/결과-->
							</div>
							<div class="col-lg-8">

								<!--begin::사례 작성 폼-->
								<div class="m-portlet m-portlet--full-height">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													OKR 사례 작성 및 등록
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											<ul class="m-portlet__nav">
												<li class="m-portlet__nav-item m-dropdown m-dropdown--huge m-dropdown--inline m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover">
													<a href="#" class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn-md btn-metal m-btn m-btn--pill">
														저장한 사례
													</a>
													<div class="m-dropdown__wrapper">
														<div class="m-dropdown__inner">
															<div class="m-dropdown__body">
																<div class="m-dropdown__content">
																	<ul class="m-nav">
																		<?php
																			if(sizeof($SAVED) == 0) {
																			?>
																				<li class="m-nav__item">
																					<i class="m-nav__link-icon la la-times-circle"></i>&nbsp;&nbsp;
																					<span class="m-nav__link-text">저장한 사례가 없습니다.</span>
																				</li>
																			<?
																			} else {
																				foreach($SAVED as $key => $bean) {
																					$link = "/CaseController/case_write/".$bean['ID'];
																			?>
																					<li class="m-nav__item">
																						<a href='<?=$link?>' class="m-nav__link">
																							<i class="m-nav__link-icon la la-file-text"></i>
																							<span class="m-nav__link-text link-title">
																								<?=$bean['TITLE']?>
																			<?					if($bean['CONFIRM_DTM'] != null && $bean['CONFIRM_NOTES'] == null) {
																			?>						<span class="badge bg-secondary text-dark ml-1 p-1">검수 대기중</span>
																			<?					} else if($bean['CONFIRM_DTM'] != null && $bean['CONFIRM_NOTES'] != null) {
																			?>						<span class="badge bg-info ml-1 p-1">검수 완료</span>
																			<?					} else {
																			?>						<span class="badge bg-secondary text-dark ml-1 p-1">임시 저장</span>
																			<?					}
																			?>				</span>
																							<span class="m-nav__link-text" style="width:65%; padding-left: 15px;"><?=$bean['DATE']?></span>
																						</a>
																					</li>
																			<?
																				}
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
									<form class="m-form m-form--fit">
										<div class="m-portlet__body">
											<div class="form-group m-form__group row">
												<label class="col-form-label col-lg-3 col-sm-12">사례 유형</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<select class="form-control m-bootstrap-select m_selectpicker" id="case_tp">
														<option value="0" <? echo($DETAIL != null && $DETAIL[0]['CASE_TP'] == '0' ? 'selected' : '') ?>>도전 성공 사례</option>
														<option value="1" <? echo($DETAIL != null && $DETAIL[0]['CASE_TP'] == '1' ? 'selected' : '') ?>>도전 축적 사례</option>
													</select>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="title" class="col-lg-3 col-sm-12 col-form-label">지식의 제목</label>
												<div class="col-lg-7 col-sm-12">
													<input class="form-control m-input" type="text" id="title" value="<? echo($DETAIL == null ? '' : $DETAIL[0]['TITLE']) ?>">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="goal" class="col-lg-3 col-sm-12 col-form-label">목표 성과</label>
												<div class="col-lg-9 col-sm-12">
													<input class="form-control m-input" type="text" id="target" value="<? echo($DETAIL == null ? '' : $DETAIL[0]['TARGET']) ?>">
													<span class="m-form__help">* 숫자를 포함하여 작성해주세요.</span>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="result" class="col-lg-3 col-sm-12 col-form-label">얻은 성과</label>
												<div class="col-lg-9 col-sm-12">
													<input class="form-control m-input" type="text" id="result" value="<? echo($DETAIL == null ? '' : $DETAIL[0]['COTCOME']) ?>">
													<span class="m-form__help">* 숫자를 포함하여 작성해주세요.</span>
												</div>
											</div>
											<div class="m-form__seperator m-form__seperator--dashed" style="margin: 30px 0"></div>
											<div class="form-group m-form__group row">
												<label for="context" class="col-lg-3 col-sm-12 col-form-label">맥락 설명</label>
												<div class="col-lg-9 col-sm-12">
													<textarea class="form-control m-input" id="context" rows="5" placeholder="당시 상황에 대해 자세하게 기술해 주세요."><? echo($DETAIL == null ? '' : $DETAIL[0]['CONTEXT']) ?></textarea>
													<span class="m-form__help">* 당시 어떤 상황이었습니까? (문제인식)</span>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="strategy" class="col-lg-3 col-sm-12 col-form-label">전략 방향</label>
												<div class="col-lg-9 col-sm-12">
													<textarea class="form-control m-input" id="strategy" rows="5"><? echo($DETAIL == null ? '' : $DETAIL[0]['CONTEXT']) ?></textarea>
													<span class="m-form__help">* 성과를 만들 수 있었던 주요 활동은 무엇입니까? (이전과 달리 무엇을 새롭게 시도했던 것입니까?)</span>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label for="knowhow" class="col-lg-3 col-sm-12 col-form-label">핵심 지식</label>
												<div class="col-lg-9 col-sm-12">
													<textarea class="form-control m-input" id="knowhow" rows="5"><? echo($DETAIL == null ? '' : $DETAIL[0]['CONTEXT']) ?></textarea>
													<span class="m-form__help">
													* 이번 일과 연관하여 함께 나누고 싶은 노하우는 무엇입니까? (이번에 발견한 지식은 무엇입니까?)
													</span>
													<span class="m-form__help">
													* 다음 지식의 조건 두 가지를 고려하여 나만의 노하우를 서술해 보십시오.<br>
														1) 성과의 재생산: 다음번에도 이 지식을 통해 또 다른 성과를 만들 수 있습니까?<br>
														2) 지식의 확산: 내가 정리한 이 지식을 다른 사람이 보고 쉽게 따라할 수 있습니까?
													</span>
												</div>
											</div>
										</div>
										<div class="m-portlet__foot m-portlet__foot--fit">
											<div class="m-form__actions m-form__actions--solid m-form__actions--right">
												<div class="row">
													<div class="col m--align-left">
														<?
															if($DETAIL == null || $DETAIL[0]['CONFIRM_NOTES'] == null) {
															?>
																<button type="submit" class="btn btn-success m-btn" disabled="disabled">사례 공유</button>
															<?
															} else {
															?>
																<button type="submit" class="btn btn-success m-btn" onclick="jsSubmit('COMPLETE', '<? echo($DETAIL[0]['ID']) ?>')">사례 공유</button>
															<?
															}
														?>
													</div>
													<div class="col m--align-right">
														<?
															if($DETAIL == null) {
															?>
																<button type="submit" class="btn btn-secondary" onclick="jsSubmit('CREATE', '')">임시 저장</button>
																<button type="reset" class="btn btn-secondary" onclick="jsReset()">초기화</button>
															<?
															} else {
															?>
																<button type="submit" class="btn btn-secondary" onclick="jsSubmit('UPDATE', '<? echo($DETAIL[0]['ID']) ?>')">수정</button>
																<button type="submit" class="btn btn-danger" onclick="jsSubmit('DELETE', '<? echo($DETAIL[0]['ID']) ?>')">삭제</button>
															<?
															}
														?>
														
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<!--end::사례 작성 폼-->
							</div>
						</div>
    

    	<!--begin::Global Theme Bundle -->
		<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Global Theme Bundle -->

		<!--begin::Page Vendors -->
		<!--end::Page Vendors -->

		<!--begin::Page Scripts -->
		<script src="/assets/app/js/dashboard.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/components/base/treeview.js" type="text/javascript"></script>
		<script src="/assets/demo/default/custom/crud/forms/widgets/bootstrap-select.js" type="text/javascript"></script>
		<script src="/assets/demo/default/custom/components/base/sweetalert2.js" type="text/javascript"></script>
		<!--end::Page Scripts -->

        <script>
			jQuery(document).ready(function () {
				
				//jsTree 실행
				Treeview.init(<? echo($DETAIL == null ? '' : $DETAIL[0]['OKR_INIT_ID']) ?>);
				
				$("button").on('click', (e) => {
					e.preventDefault();
				});
				
			});
        </script>
        
    </body>
</html>