<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>CFR FORM</title>
		<?php echo view("/layout/header"); ?>

        <style>
            form label {
                color: white;
                font-weight: bold;
                text-align:center;
            }

            @media (max-width: 575.98px) {
                form label{
                    margin:15px;
                }
            }

            #file{
                display:inline-bloack;
            }

        </style>
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a id="modal-871549" href="#modal-container-871549" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
                    
                    <div class="modal fade" id="modal-container-871549" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content" style="border: 3px solid purple">
                                <div class="modal-header" style="border-bottom: 2px solid black; display:inline-block; background-color: #d7d0e3; !important;">
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">×</span>
                                    </button>

                                    <h1 id="myModalLabel" style="text-align:center; !important;">
                                        CFR Meeting 요청 
                                    </h1> 
                                </div>

                                <div class="modal-body" style="border-top:0px; border-bottom:0px">
                                    <form name="dataForm" id="dataForm" onsubmit="return registerAction()">
                                        <div class="form-group row">
                                            <label for="subject" class="col-sm-2 col-form-label" style="background-color:plum">주제 선택</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="subject">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="opponent" class="col-sm-2 col-form-label" style="background-color:skyblue">상대 선택</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="opponent">
                                                    <option>Default select</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="date" class="col-sm-2 col-form-label" style="background-color:darkseagreen">날짜 선택</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" id="date">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="12"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button id="btn-upload" type="button" style="border: 1px solid #ddd; outline: none;">파일 추가</button>
                                            <input id="input_file" multiple="multiple" type="file" style="display:none;">
                                            <span style="font-size:10px; color: gray;">※첨부파일은 최대 10개까지 등록이 가능합니다.</span>
                                            <div class="data_file_txt" id="data_file_txt" style="margin:40px;">
                                                <span>첨부 파일</span>
                                                <br />
                                                <div id="articlefileChange">
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                </div>

                                <div class="modal-footer" style="display:inline-block; text-align:center">
                                    
                                    <button type="submit" form="dataForm" class="btn btn-primary" style="width:25%">
                                        요청
                                    </button> 
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button> -->
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>

	</body>
	<!-- end::Body -->

    <script>
        $(document).ready(function()
                // input file 파일 첨부시 fileCheck 함수 실행
                {
                    $("#input_file").on("change", fileCheck);
                });

        /**
        * 첨부파일로직
        */
        $(function () {
            $('#btn-upload').click(function (e) {
                e.preventDefault();
                $('#input_file').click();
            });
        });

        // 파일 현재 필드 숫자 totalCount랑 비교값
        var fileCount = 0;
        // 해당 숫자를 수정하여 전체 업로드 갯수를 정한다.
        var totalCount = 10;
        // 파일 고유넘버
        var fileNum = 0;
        // 첨부파일 배열
        var content_files = new Array();

        function fileCheck(e) {
            var files = e.target.files;
            
            // 파일 배열 담기
            var filesArr = Array.prototype.slice.call(files);
            
            // 파일 개수 확인 및 제한
            if (fileCount + filesArr.length > totalCount) {
            $.alert('파일은 최대 '+totalCount+'개까지 업로드 할 수 있습니다.');
            return;
            } else {
                fileCount = fileCount + filesArr.length;
            }
            
            // 각각의 파일 배열담기 및 기타
            filesArr.forEach(function (f) {
            var reader = new FileReader();
            reader.onload = function (e) {
                content_files.push(f);
                $('#articlefileChange').append(
                    '<div id="file' + fileNum + '" onclick="fileDelete(\'file' + fileNum + '\')">'
                    + '<font style="font-size:12px">' + f.name + '</font>'  
                    + '<img src="/img/icon_minus.png" style="width:20px; height:auto; vertical-align: middle; cursor: pointer;"/>' 
                    + '<div/>'
                );
                fileNum ++;
            };
            reader.readAsDataURL(f);
            });
            console.log(content_files);
            //초기화 한다.
            $("#input_file").val("");
        }

        // 파일 부분 삭제 함수
        function fileDelete(fileNum){
            var no = fileNum.replace(/[^0-9]/g, "");
            content_files[no].is_delete = true;
            $('#' + fileNum).remove();
            fileCount --;
            console.log(content_files);
        }

        // 폼 submit 로직
        function registerAction(){
		
        var form = $("form")[0];        
        var formData = new FormData(form);
        for (var x = 0; x < content_files.length; x++) {
            // 삭제 안한것만 담아 준다. 
            if(!content_files[x].is_delete){
                    formData.append("article_file", content_files[x]);
            }
        }
      
        // 파일업로드 multiple ajax처리
        $.ajax({
                 type: "POST",
                    enctype: "multipart/form-data",
                 url: "/file-upload",
                 data : formData,
                 processData: false,
                 contentType: false,
                 success: function (data) {
                   if(JSON.parse(data)['result'] == "OK"){
                       alert("파일업로드 성공");
                } else
                    alert("서버내 오류로 처리가 지연되고있습니다. 잠시 후 다시 시도해주세요");
                 },
                 error: function (xhr, status, error) {
                   alert("서버오류로 지연되고있습니다. 잠시 후 다시 시도해주시기 바랍니다.");
                return false;
                 }
               });
               return false;
        }

    </script>

</html>