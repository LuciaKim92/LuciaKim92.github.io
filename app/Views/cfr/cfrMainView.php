<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>DWOKR | CFR Meeting</title>
		<?php echo view("/layout/header"); ?>
        <style>
            .cfr-main-plan{
                margin-bottom : 5px;
                margin-top : 5px;
                cursor : pointer;
            }

            .body{
                font-weight : 400;
            }

        </style>
        <!-- CFR Main css파일 불러오기-->
		<link rel="stylesheet" type="text/css" href="/assets/css/calendar.css">
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
                <?php echo view("/layout/nav-bar"); ?>
					<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">CFR Meeting</h3>
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
						<div class="m-portlet  m-portlet--unair" style = "margin : 0; background-color :#E6E0EC; border-radius : 7px;" >
							<div class="m-portlet__body  m-portlet__body--no-padding" >
								<div class="row m-row--no-padding" >
									<!--회사 OKR-->
									<div class="col-xl-3">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<div style="width:100%;">
													<div style= "margin-top : 15px">
		  												<span style="margin : 15px; font-size : 28px;">
															다가오는 CFR Meeting 일정
														</span>
                                                        <hr style ="border-style : solid; color : white; width : 92%; margin-left : 0px;">
                                                        <div style="overflow:auto;">
                                                            <ul style = "text-size : 24px; ">
                                                                <li class = "cfr-main-plan"> 2021.05.24(월) 10:00~11:00 이ㅇㅇ </li>
                                                                <li class = "cfr-main-plan"> 2021.06.04(금) 14:00~15:00 박ㅇㅇ </li>
                                                                <li class = "cfr-main-plan"> 2021.06.15(화) 11:00~12:00 최ㅇㅇ </li>
                                                            </ul>
                                                        </div>
														<span id = "comp-obj-span" style="margin-left : 20px">
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>

                                    <!--회사 OKR-->
									<div class="col-xl-7">
										<div class="m-widget24">
											<div class="m-widget24__item" style = "text-align : center">
                                                <div style="width : 35%; height : 200px; background-color : white; margin : 10px; float : left; border: solid 0.25px #919191; border-radius : 5px;">    
                                                    <div id="cfrMainCalendar"></div>
                                                </div>
                                                <div style="width : 35%; height : 200px; background-color : white; margin : 10px; float : left; border: solid 0.25px #919191; border-radius : 5px;">
                                                    <div id="cfrMainCalendarNextMonth"></div>
                                                </div>
												
											</div>
										</div>
									</div>

                                    <!--회사 OKR-->
									<div class="col-xl-2">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<div style="width:100%;">
													<div style="text-align : center; padding-top : 10px; background-color:#7957ad; width : 70%; margin : 10px; border-radius : 5px; height : 40px;">
                                                        <span style = "color : white">CFR Meeting 요청</span>
													</div>
												</div>
                                                <div style="width:100%;">
													<div style="text-align : center; padding-top : 50px; background-color:#fff; width : 70%; margin : 10px; border-radius : 5px; height : 150px; border: solid 1px #7957ad;">
                                                        <span style = "font-weight : bold;">내가 요청한 <br>CFR Meeting</span>
													</div>
                                                </div>
											</div>
										</div>
									</div>

								</div>
							</div>

                            

                            
						</div>
                        <hr style="border : solid 1px #7957ad">
                        <div class="m-portlet  m-portlet--unair" style = "margin : 0; background-color :#fff; border-radius : 7px; border: solid 2px #7957ad;" >
							<div class="m-portlet__body  m-portlet__body--no-padding" >
								<div class="row m-row--no-padding" >
									<!--회사 OKR-->
									<div class="col-xl-7">
										<div class="m-widget24">
											<div class="m-widget24__item">

                                                <div>
                                                    <div class="row">
                                                        <div style="margin-left : 15px; margin-top : 15px; width : 40%; border-bottom : 2px solid #7957ad; margin-bottom : 10px; float : left">
                                                            <span style=" margin-left : 15px;font-size : 28px; ">
                                                                CFR Meeting 히스토리
                                                            </span>
                                                        </div>

                                                        <div style="float : left; margin-top : 15px">
                                                            <img src="/assets/icon/search_icon.png" width="35px" height="35px">
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <span id = "comp-obj-span" style="margin-left : 20px">
                                                    </span>
                                                </div>

                                                <div class="row" style="overflow:auto; width : 80%; height : 200px; border: solid 2px #7957ad; margin-left : 20px; margin-top : 5px; border-radius : 5px;">
                                                    <ul style = "text-size : 22px;">
                                                        <li class = "cfr-main-plan"> 2021.05.24(월) 10:00~11:00 이ㅇㅇ </li>
                                                        <li class = "cfr-main-plan"> 2021.06.04(금) 14:00~15:00 박ㅇㅇ </li>
                                                        <li class = "cfr-main-plan">  2021.06.15(화) 11:00~12:00 최ㅇㅇ </li>
                                                    </ul>
                                                </div>
												
											</div>
										</div>
									</div>

                                    <!--회사 OKR-->
									<div class="col-xl-5">
										<div class="m-widget24">
											<div class="m-widget24__item">
                                                        
												
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

        <script>

        (function () {
            var nowDate = new Date();
            var nextDate = new Date();
            nextDate.setMonth(nextDate.getMonth()+1)
            calendarMaker($("#cfrMainCalendar"),nowDate,"n");
            calendarMaker($("#cfrMainCalendarNextMonth"),nextDate,"n");
        })();

        var nowDate = new Date();
        function calendarMaker(target, date, arrow) {
            if (date == null || date == undefined) {
                date = new Date();
            }
            nowDate = date;
            if ($(target).length > 0) {
                var year = nowDate.getFullYear();
                var month = nowDate.getMonth() + 1;
                $(target).empty().append(assembly(year, month, arrow));
            } else {
                console.error("custom_calendar Target is empty!!!");
                return;
            }

            var thisMonth = new Date(nowDate.getFullYear(), nowDate.getMonth(), 1);
            var thisLastDay = new Date(nowDate.getFullYear(), nowDate.getMonth() + 1, 0);

            var tag = "<tr>";
            var cnt = 0;
            //빈 공백 만들어주기
            for (i = 0; i < thisMonth.getDay(); i++) {
                tag += "<td></td>";
                cnt++;
            }

            //날짜 채우기
            for (i = 1; i <= thisLastDay.getDate(); i++) {
                if (cnt % 7 == 0) { tag += "<tr>"; }

                tag += "<td>" + i + "</td>";
                cnt++;
                if (cnt % 7 == 0) {
                    tag += "</tr>";
                }
            }
            $(target).find("#custom_set_date").append(tag);
            calMoveEvtFn();

            function assembly(year, month, arrow) {
                var calendar_html_code =
                    "<table class='custom_calendar_table'>" +
                    "<colgroup>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "<col style='width:81px'/>" +
                    "</colgroup>" +
                    "<thead class='cal_date'>";

                    if(arrow == "y"){
                        calendar_html_code += 
                            "<th><button type='button' class='prev'><</button></th>" +
                            "<th colspan='5'><p><span>" + year + "</span>년 <span>" + month + "</span>월</p></th>" +
                            "<th><button type='button' class='next'>></button></th>";
                    }

                    else if(arrow == "n"){
                        calendar_html_code += 
                            "<th colspan='7'><p><span>" + year + "</span>년 <span>" + month + "</span>월</p></th>";
                    }
                    calendar_html_code +=
                    "</thead>" +
                    "<thead  class='cal_week'>" +
                    "<th>일</th><th>월</th><th>화</th><th>수</th><th>목</th><th>금</th><th>토</th>" +
                    "</thead>" +
                    "<tbody id='custom_set_date'>" +
                    "</tbody>" +
                    "</table>";
                return calendar_html_code;
            }

            function calMoveEvtFn() {
                //전달 클릭
                $(".custom_calendar_table").on("click", ".prev", function () {
                    nowDate = new Date(nowDate.getFullYear(), nowDate.getMonth() - 1, nowDate.getDate());
                    calendarMaker($(target), nowDate, "y");
                });
                //다음날 클릭
                $(".custom_calendar_table").on("click", ".next", function () {
                    nowDate = new Date(nowDate.getFullYear(), nowDate.getMonth() + 1, nowDate.getDate());
                    calendarMaker($(target), nowDate, "y");
                });
                //일자 선택 클릭
                $(".custom_calendar_table").on("click", "td", function () {
                    $(".custom_calendar_table .select_day").removeClass("select_day");
                    $(this).removeClass("select_day").addClass("select_day");
                });
            }
        }


        
    //OKR_MAP 메뉴 활성화

    elements = document.getElementsByClassName('m-menu__item--active');
    for (var i = 0; i < elements.length; i++) {
        elements[i].classList.remove('m-menu__item--active');

    }
    document.getElementById('cfr_left_menu').classList.add('m-menu__item--active');
        </script>
    </body>
</html>