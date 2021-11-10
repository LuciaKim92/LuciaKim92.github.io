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

        <!--begin::Global Theme Styles -->
        <link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

        <!--RTL version:<link href="../../assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
        <link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        
        <!--begin::Page Vendors Styles -->
		<link href="/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

        <!-- DATATABLES API -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <?php echo view("/layout/header"); ?>
    </head>

    <style>
        table.dataTable thead .sorting {
            background-image: none !important;
        }

        select {
            border: 1px solid #ebedf2 !important;
            color: #575962;
            font-family: sans-serif, Arial;
            border-radius: .25rem;
            padding: .4rem 1.75rem .4rem .75rem !important;
            line-height: 1.25 ;
            appearance: none;
            outline: none;
            background: #fff url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 4 5'%3E%3Cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3E%3C/svg%3E") no-repeat right .75rem center;
            background-size: 8px 10px;
            cursor: pointer;
        }

        input[type=search] {
            border-color: #ebedf2 !important;
            color: #575962;
            padding: .45rem .8rem;
            height: calc(2.2125rem + 2px);
            line-height: 1.5 !important;
            border-radius: .25rem;
            outline: none;
        }

        select:focus, input[type=search]:focus {
            border-color: #6f42c1 !important;
            transition-duration: .3s;
        }

        #m_header_nav {
            background-color: rgb(32, 31, 43) !important;
        }
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
                        <div class="col-12">
                            <!--begin::Portlet-->
                            <div class="m-portlet m-portlet--tabs m-portlet--success m-portlet--head-solid-bg m-portlet--bordered">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-tools">
                                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary" role="tablist">
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" id="all_case" data-toggle="tab" href="#m_tabs_12_1" role="tab">
                                                    <i class="la la-briefcase"></i> 모든 사례
                                                </a>
                                            </li>
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link" id="scrap_case" data-toggle="tab" href="#m_tabs_12_2" role="tab">
                                                    <i class="la la-bookmark"></i> 내가 스크랩한 사례
                                                </a>
                                            </li>
                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link" id="award_case" data-toggle="tab" href="#m_tabs_12_3" role="tab">
                                                    <i class="la la-trophy"></i> 수상 사례 모음
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="m_tabs_12_1" role="tabpanel">
                                            <table class="table table-striped- table-bordered table-hover table-checkable dataTable dtr-inline" id="m_table_1">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>분류</th>
                                                        <th>제목</th>
                                                        <th>이름</th>
                                                        <th>팀명</th>
                                                        <th>부서명</th>
                                                        <th>날짜</th>
                                                        <th>사번</th>
                                                        <th>스크랩/댓글</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="m_tabs_12_2" role="tabpanel">
                                            <table class="table table-striped- table-bordered table-hover table-checkable dataTable dtr-inline" id="m_table_2">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>분류</th>
                                                        <th>제목</th>
                                                        <th>이름</th>
                                                        <th>팀명</th>
                                                        <th>부서명</th>
                                                        <th>날짜</th>
                                                        <th>사번</th>
                                                        <th>스크랩/댓글</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="m_tabs_12_3" role="tabpanel">
                                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                            specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end::Portlet-->
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
        <script src="/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
		<!--end::Page Vendors -->

        <!-- DATATABLES API -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

		<!--begin::Page Scripts -->
		<script src="/assets/app/js/dashboard.js" type="text/javascript"></script>
        <script src="/assets/demo/default/custom/crud/datatables/advanced/column-rendering.js" type="text/javascript"></script>
		<!--end::Page Scripts -->

        <script>
            $(document).ready(function () {
                getCaseList("0");
                getCaseList("1");
            });
        </script>
        
    </body>
</html>