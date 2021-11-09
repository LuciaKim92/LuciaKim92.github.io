<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
        .deg{
            transform : rotate(180deg);
        }
        .hid{
            visibility : hidden;
        }
        
    </style>

</head>
<body>
    <!-- Modal -->
    <div class="modal fade" data-keyboard="true" id="initiative-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style = "border-bottom: 0 none; padding-bottom : 5px">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Initiative Tool</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding : 0">
                    <div class="m-portlet  m-portlet--unair">
							<div class="m-portlet__head"  style = "padding : 0; margin : 5px;">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
                                            <span class="init-badge m-badge m-badge--success m-badge--wide" style = "border-radius : 3px; padding : 10px; background-color : #9F9FFF">KR</span>
                                            <span id = "kr-view-modal-span" style="font-size : 13px; margin-left : 5px"></span><br>
                                            <input id = "kr-keyid" type="hidden">
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

									<div class="col-xl-9">
										<div class="m-widget24">
											<div class="m-widget24__item">
												<div style="width:100%; margin : 5px">
                                                    <div>
                                                        <span class="init-badge m-badge m-badge--info m-badge--wide" style = "border-radius : 3px; padding : 10px; background-color : #9BBB59;">Initiatives</span>
                                                        <select style="height : 30px; width : 70%" id = 'modal-init-select-view'>       
                                                        </select>
                                                    </div>
                                                    <div style="margin-top : 5px">
                                                        <button id = "todo-uncompleted-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 10px; opacity : 1; ">To Do List</button>
                                                        <button id = "todo-completed-button"type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 0; margin-left : 5px; opacity : 0.5;">완료된<br>To Do List</button>
                                                    </div>
                                                </div>

                                                <!-- ToDo 더보기 버튼-->
                                                <div  style="margin : 5px; cursor : pointer; margin-top : 20px;">
                                                    <img  id = "todo-view-more-btn" src="/assets/icon/top_icon.png" width="20px" height="20px">
                                                </div>
                                                <!-- ToDo 더보기 자세한 내용들[진행중] / 초기값 : block -> 처음 보여지는 것이 진행중인 ToDo목록이라서 -->
                                                <input id = "view-proc-hidden" type ="hidden" value = "block">
                                                <div class ="todo-view-more" id = "todo-view-more-proc" style = "display : none; margin : 5px" style = "display : none">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" checked disabled>
                                                        <label class="form-check-label" for="inlineCheckbox1" style ="text-decoration:line-through">OKR System 화면 구성 미팅</label>
                                                        <i class="flaticon-speech-bubble-1" style= "margin-left : 8px;"></i>
                                                    </div>
                                                    <div class="첨부파일">
                                                        <i class="flaticon-tool-1 icon-xs"></i><span style = "margin-left : 5px">filename</span>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                        <label class="form-check-label" for="inlineCheckbox2">OKR System 화면 제작 및 검수</label>
                                                        <i class="flaticon-speech-bubble-1" style= "margin-left : 8px;"></i>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                                                        <label class="form-check-label" for="inlineCheckbox3">OKR System 개발 미팅</label>
                                                        <i class="flaticon-speech-bubble-1" style= "margin-left : 8px;"></i>
                                                    </div>
                                                </div>

                                                <!-- ToDo 더보기 자세한 내용들[완료] -->
                                                <input id = "view-comp-hidden" type = "hidden" value = "none">
                                                <div class ="todo-view-more" id = "todo-view-more-comp" style = "display : none; margin : 5px" style = "display : none">
                                                </div>

                                                <!--완료된 To Do List Count-->
                                                <input id = "viewtodoCompCnt" type = "hidden" value = 0 >


                                                <div id = "todo-view-more" style = "display : none; margin : 5px">
                                                    
                                                </div>
											</div>
										</div>
									</div>
                                    <div class="col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <div style = "margin : 5px">
                                                    <button id = "st-btn" value = "0" type="button" class="btn btn-info dropdown-toggle" style = "margin-left : 10%; width : 80% ;text-align: center; height : 30px; padding : 7px; border-radius : 3px"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" value="0">진행</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" onclick="setProgress('0');">진행</a>
                                                            <a class="dropdown-item" href="#" onclick="setProgress('7');">완료</a>
                                                        </div>
                                                </div>
                                                <div>
                                                    <div style="text-align : center; margin-left : 10%; width : 80% ;">
                                                        <span style="font-size : 15px; font-weight : bold">담당</span><br>
                                                        <i class="flaticon-profile-1"></i>
                                                        <span id ="init-maker">유진</span>
                                                    </div>
                                                    <div style="margin : 5px;">

                                                    </div>
                                                </div>
                                                <div style = "margin : 5px">
                                                   <button class="btn btn-primary dropdown-toggle" type="button" style = "margin-left : 10%; width : 80% ;text-align: center; height : 50px; padding : 7px; border-radius : 3px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">자신감&nbsp;&nbsp;<span id ="view-conf-span" value = "0"></span><br></button>
                                                        <div id = "write-conf-select" class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:viewEditConf('0');">상</a>
                                                                <a class="dropdown-item" href="javascript:viewEditConf('1');">중</a>
                                                                <a class="dropdown-item" href="javascript:viewEditConf('2');">하</a>
                                                            </div>
                                                        </div>
                                                </div>

                                                <div style = "margin : 5px">
                                                    <button type="button" class="btn btn-danger" style = "margin-left : 10%; width : 80% ;text-align: center; height : 50px; padding : 7px; border-radius : 3px">CFR Meeting<br> 요청</button>
                                                </div>
                                                <div style = "margin : 5px">
                                                    <button type="button" class="btn btn-warning" style = "border-color: #BFBFBF; color : white; background-color : #BFBFBF; margin-left : 10%; width : 80% ;text-align: center; height : 30px; padding : 7px; border-radius : 3px">사례 공유</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								</div>
							</div>
                            
                            <!--modal footer start-->
                            <div id = "modal-footer">
                                <div style="margin : 5px; cursor : pointer;">
                                    <hr>
                                    <img src="/assets/icon/top_icon.png" width="20px" height="20px" style = "transform : rotate(180deg); display : none">
                                    <span style="font-size : 12px;  display : none">더 보기</span>
                                </div>
                                <!-- 댓글 입력 start -->
                                <form style="padding-bottom : 20px;">
                                    <div style = "margin-top : 10px; ">
                                        <span style = "margin-left : 10px">댓글 입력</span>
                                        <i id = "init-rply-file-btn" class="flaticon-tool-1 icon-xs float-right" onclick="writeInputFile();" style = "margin-right : 10px; cursor : pointer"></i>
                                        <textarea id = "init-view-reply-textarea" class="form-control mentions" placeholder="댓글을 입력하세요" data-val-required="true" style="resize: none; margin-left : 10%; border-radius : 5px; margin : 5px; border : solid 0.1em; height : 50px; width : 98%" onkeydown = "initReplyPressEnter(this);"></textarea>
                                        <input class ="hidden" id = "init-rply-input-file" type ="file" style=" margin-bottom : 0px; margin-left : 2%">
                                        <div class="float-right" style="text-align : center; margin-right : 5px;">
                                            <button type="button" class="btn btn-info" style = "width : 50px; text-align: center; height : 30px; padding : 7px; border-radius : 3px; margin-bottom : 20px;" onclick = "saveInitViewReply();">등록</button>
                                        </div>
                                        <hr>
                                    </div>

                                </form>
                                <!-- 댓글 입력 end -->

                                <!-- Initiative Tool 댓글들 시작   -->
                                <div id = "init-view-reply-div" style ="overflow:auto; height : 200px">


                                   
                                <!-- 댓글들 END -->


                            </div>
                            <!-- modal-footer end -->
						</div>
                        
                        <!--
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" contenteditable="true">Close</button>
-->                     <div style="height : 10px"></div>
                </div>
                    

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->

        <!-- 자신감 척도 -->
        <div id ="select-conf-tp" class="fixed-bottom bg-dark text-center" style="display : none; position: fixed; top : 27%; right: 23%; left : auto; left : auto; width : 200px; height : 100px;">
			<div class = "text-light add-menu" style="background-color : #7957ad" onclick = "">
		  		상
			</div>

			<div class = "text-light add-menu" style="background-color : #31859c" onclick = "">
		  		중
			</div>

            <div class = "text-light add-menu" style="background-color : #31859c" onclick = "">
		  		하
			</div>
		</div>

        
               
    </div><!-- /.modal -->

    <div class ="fixed-top" id = "init-custom-alert" style="padding-top : 10px; font-size : 15px; z-index:9999; display : none; border-radius : 5px; width : 330px; height : 5%; background-color : #c9c9c9; top : 5%; right : 0; left : 0; margin: 0 auto; text-align : center; border : 1px solid #c9c9c9;"> <!-- alert -->
        <span id = "init-custom-alert-content">
            욤욤욤욤욤욤요묘욤욤ㅇㅁ요
        </span>
    </div> 

    <div class ="modal" id = "sticker-memo-modal" aria-hidden="true" style="margin-top : 10%; padding-right : 0px; margin-right : 0px; bottom: 50%; right: 20%; left : auto; background-color : white; border-radius : 5px; border : 1px solid #c9c9c9; display:none; width : 300px; height : 250px; z-index:9999">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div style="padding : 5px; padding-right : 0px;">
                <span style="margin-left : 10px; font-size : 15px; margin-bottom : 5px">MEMO</span>
                <br>
                INITIATIVE : <span id="sticker-memo-span" style="margin-left : 5px; font-size : 11px; color : #727272;">content</span></span>
            </div>
            <input type="hidden" id="sticker-memo-todo-id" value="">
            <div>
                <textarea id="sticker-memo-textarea" class="form-control" placeholder="스티커 메모" style="resize: none; border : 1px solid #c9c9c9; display : block; width : 100%; height : 140px; margin-left : 3%; margin-right : 2%; padding : 5px;" ></textarea>
                <div></div>
            </div>
            <button id = "todo-sticker-save" type="button" class="btn btn-warning float-right" style = "margin : 5px; border-radius : 3px; background-color : #9F9FFF; border-color : #9F9FFF; color : white; font-size : 12px; width : 20%; display : block" onclick ="saveStickerMemo('s');">등록</button>
            <button id = "todo-sticker-update" type="button" class="btn btn-warning float-right" style = "margin : 5px; border-radius : 3px; border-color : #9F9FFF; background-color : #9F9FFF; color : white; font-size : 12px; width : 20%; display : none" onclick ="updateStickerMemo();">수정</button>
            <button id = "todo-sticker-delete" type="button" class="btn btn-danger float-right" style = "margin : 5px; border-radius : 3px; color : white; font-size : 12px; width : 20%; display : none" onclick ="saveStickerMemo('d');">삭제</button>            
        </div>




    <script>
        //스티커메모 수정버튼 누를 때
        function updateStickerMemo(){
            if(confirm("저장된 메모를 수정하시겠습니까?")){
                $("#sticker-memo-textarea").attr("readonly",false);
                $("#todo-sticker-save").show();
                $("#todo-sticker-update").hide();
                $("#todo-sticker-delete").hide();
            }
        }

        //스티커 메모 열기 + ajax 여기서 따로 연결하는 것이 좋을듯..ㅠㅠ
        function openStickerMemo(n,todoID,todoContent){
            var memoContent ="";
            $.ajax({
                url:"/InitiativeController/getStickerMemoAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : todoID,
                },
                success:function(res){
                    //console.log(res);
                    $("#sticker-memo-content-"+n).val(res.NOTES);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
            
            $("#sticker-memo-modal").modal({
                backdrop:'static'
            })
            $("#sticker-memo-span").text(todoContent);
            $("#sticker-memo-todo-id").val(todoID);
            var memo = $("#sticker-memo-todo-id").val();
            //console.log(memo);


            memoContent=$("#sticker-memo-content-"+n).val();
            
            //저장된 내용 O
            if(typeof memoContent != "undefined" && memoContent != "" && memoContent != "null"){
                //console.log(memoContent);
                $("#todo-sticker-save").hide();
                $("#todo-sticker-update").show();
                $("#todo-sticker-delete").show();
                //$("#sticker-memo-textarea").attr("readonly",false);
                $("#sticker-memo-textarea").attr("readonly",true);
                $("#sticker-memo-textarea").val(memoContent);
            }

            //저장된 내용 X
            else{
                //console.log(memoContent);
                $("#todo-sticker-save").show();
                $("#todo-sticker-update").hide();
                $("#todo-sticker-delete").hide();
                $("#sticker-memo-textarea").val("");
                $("#sticker-memo-textarea").attr("readonly",false);

            }

        }

        //스티커 메모 저장
        function saveStickerMemo(n){
            var str= "메모를 저장하시겠습니까?";
            var compStr="스티커 메모가 저장되었습니다.";
            var todoId = $("#sticker-memo-todo-id").val();
            var memo = $("#sticker-memo-textarea").val();
            //console.log("memo")
            if(n == 'd'){
                memo = "null";
                str="저장된 메모를 삭제하시겠습니까?";
                compStr="스티커 메모가 삭제되었습니다.";
            }
            if(confirm(str)){
                if(memo == ""){
                    showNotification("작성한 내용이 없습니다.\n작성 후 저장하세요","init-custom-alert")
                }
                else{
                    $.ajax({
                        url:"/InitiativeController/updateStickerMemoAjax",
                        type:"post",
                        dataType:"json",
                        data:{
                            id : todoId,
                            notes : memo,
                            update_by : '<?=$_SESSION['admin_names']?>',
                        },
                        success:function(res){
                            //console.log(res);
                            showNotification(compStr,"init-custom-alert");
                            $("#sticker-memo-content-"+n).val(res.NOTES);
                            $("#sticker-memo-modal").modal("hide");
                        },
                        error:function(request,status,error){
                            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    }); 
                }
            }      
        }

        //Initiative + KR 세팅[임의(KR눌렀을 때 나오는것이라서.. 맵에서 나중에 해야할 것 같음)]
        function setViewInitiativeToolKR(krId){
            var str="";
            $(".todo-view-more").html("");
            $("#todo-view-more-proc").show();
            $("#view-comp-hidden").val("none");
            $("#todo-view-more-comp").hide();
            $("#view-proc-hidden").val("block");
            $("#init-maker").text("");
            $("#init-view-reply-div").html("");

            $.ajax({
                url:"/InitiativeController/getKRAjax",
                type:"get",
                dataType:"json",
                data:{
                    id : krId,
                },
                success:function(res){
                    //console.log(res);
                    $("#kr-view-modal-span").text(res.CONTENT);
                    $("#kr-keyid").val(res.ID);
                    $("#newCFRMenu").hide();
                    $("#initiative-view-modal").modal({
                        backdrop:'static'
                    })
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });

            setViewInitiativeToolInit(krId);
           
            
        }

        function setViewInitiativeToolInit(krId){
            var empNum = '<?=$_SESSION['emp_no']?>';
            //console.log($("#kr-keyid").val());
            $.ajax({
                url:"/InitiativeController/getInitiativeListAjax",
                type:"get",
                dataType:"json",
                data:{
                    okrKey: krId,
                    emp_no: empNum
                },
                success:function(res){
                    var cnt = Object.keys(res).length;
                    var tmpStr = '<option disabled selected value ="n">====선택====</option>';
                    for(var i = 0; i < cnt; i++){
                        //console.log(res[i].ID);
                        tmpStr += `<option value='`+res[i].ID+`'>`+res[i].CONTENT+`</option>`;
                    }
                    document.getElementById('modal-init-select-view').innerHTML = tmpStr;
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });


        }

        //완료된 To Do List 버튼 누를 때
        $("#todo-completed-button").click(function(){
            var element2 = document.getElementById('todo-completed-button');
            element2.style.opacity ="1";
            $("#todo-view-more-comp").show();
            $("#view-comp-hidden").val("block");
            $("#todo-view-more-proc").hide();
            $("#view-proc-hidden").val("none");

            var element = document.getElementById('todo-uncompleted-button');
            element.style.opacity = "0.5";

            //각도 확인 후 제거
            if($("#todo-view-more-btn").hasClass("deg"))
                $("#todo-view-more-btn").removeClass("deg");
        });

        //To Do List 버튼 누를 때
        $("#todo-uncompleted-button").click(function(){
            var element2 = document.getElementById('todo-completed-button');
            element2.style.opacity ="0.5";
            $("#todo-view-more-proc").show();
            $("#view-comp-hidden").val("none");
            $("#todo-view-more-comp").hide();
            $("#view-proc-hidden").val("block");

            var element = document.getElementById('todo-uncompleted-button');
            element.style.opacity = "1";
            //console.log($("#todo-view-more-btn").hasClass("deg"));

            if($("#todo-view-more-btn").hasClass("deg")){
                $("#todo-view-more-btn").removeClass("deg");
            }
        });

        //더보기 toggle
        $('#todo-view-more-btn').click(function(){
            var proc = $("#view-proc-hidden").val();
            var comp = $("#view-comp-hidden").val();
            //$(this).css({'transform':'rotate(deg)'});

            if(proc == "block"){
                $("#todo-view-more-proc").toggle();
            }
            else if(comp == "block"){
                $("#todo-view-more-comp").toggle();
            }
            $(this).toggleClass("deg");

            //console.log(proc);
            //console.log(comp);

        });

        //Initiative 골랐을 때[선택 시] 이벤트
        $("#modal-init-select-view").change(function() {
            $("#todo-view-more-comp").html("");
            $("#todo-view-more-proc").html("");
            $("#init-view-reply-div").html("");
            var initID = $("#modal-init-select-view option:selected").val();
            
            //댓글 세팅
            setInitViewReply(initID)

            //댓글 읽기 table 생성[댓글 전체의 읽음여부 파악 -> 없으면 저장]



            // 진행/완료 여부 세팅
            $.ajax({
                url:"/InitiativeController/getInitiativeProcSTAjax",
                type:"get",
                dataType:"json",
                data:{
                    id : initID,
                },
                success:function(res){
                    if(res.PROC_ST == "7"){
                        str = "완료";
                    }
                    else{
                        str = "진행";
                    }
                    //console.log(res);
                    $("#st-btn").text(str);
                    $("$st-btn").val(res.PROC_ST)
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });


            //자신감 세팅
            $.ajax({
                url:"/InitiativeController/getInitConfTPAjax",
                type:"get",
                dataType:"json",
                data:{
                    initKey:$(this).val(),
                },
                success:function(res){
                    //console.log(res);
                    $("#view-conf-span").val(res.CONF_TP);
                    var str="";
                    switch($("#view-conf-span").val()){
                        case "0" : str = "상"; break;
                        case "1" : str = "중"; break;
                        case "2" : str = "하"; break;
                        default : ; break;
                    }
                    //console.log(str);
                    $("#view-conf-span").text(str);
                }
            });
            
            //담당자 세팅
            $.ajax({
                url:"/InitiativeController/getInitMakerAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : initID
                },
                success:function(res){
                    //console.log("담당자: ");
                    //console.log(res);
                    $("#init-maker").text(res.EMP_NM);

                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            })
        
            
            
            //Initative 직접 입력 아닐 시 ToDo 세팅[진행중]
            
            $.ajax({
                url:"/InitiativeController/getTodoListAjax",
                type:"get",
                dataType:"json",
                data:{
                    initKey:$(this).val(),
                    proc_ST : '0',
                },
                success:function(res){
                    var cnt = Object.keys(res).length;
                    var tmpStr = "";
                    for(var i = 0; i < cnt; i++){
                        tmpStr += `<div id = "viewcheckboxProcDiv`+i+`" class="form-check form-check-inline" style = "display : block; margin-top : 5px; margin-bottom : 5px;">`
                                + `<input id="viewInlineCheckboxProc`+ i +`" class="form-check-input" type="checkbox" value="option1" onClick = "viewInlineCheckboxClick(`+i+`)">`
                                + `<label id="viewInlineCheckboxLabelProc`+ i +`"class="form-check-label" for="viewInlineCheckbox`+i+`">`+res[i].CONTENT+`</label>`
                                + `<input id = "viewprocTodoID`+i+`" type = "hidden" value = `+res[i].ID+`>`
                                + `<i id="sticker-memo-proc-`+i+`"class="flaticon-speech-bubble-1" style= "margin-left : 8px; cursor : pointer" onclick="openStickerMemo('`+i+`', '`+res[i].ID+`', '`+res[i].CONTENT+`');"></i>`
                                + `<input type="hidden" id = "sticker-memo-content-`+i+`"  value="`+res[i].NOTES+`">`
                                + `</div>`
                    }
                    //console.log("NOTES");
                    document.getElementById('todo-view-more-proc').innerHTML = tmpStr;
                    $("#todo-view-more-proc").show();
                }
            });

            //Initiaitve 직접 입력 아닐 시 ToDo 세팅[완료]
            $.ajax({
                url:"/InitiativeController/getTodoListAjax",
                type:"get",
                dataType:"json",
                data:{
                    initKey:$(this).val(),
                    proc_ST : '7',
                },
                success:function(res){
                    var cnt = Object.keys(res).length;
                    var tmpStr = "";
                    for(var i = 0; i < cnt; i++){
                        tmpStr += `<div class="form-check form-check-inline" style = "display : block; margin-top : 5px; margin-bottom : 5px;">`
                                + `<input id="viewInlineCheckboxComp`+ i +`" class="form-check-input" type="checkbox" value="option1" checked disabled>`
                                + `<label id="viewInlineCheckboxLabelComp`+ i +`"class="form-check-label" for="viewInlineCheckbox`+i+`">`+res[i].CONTENT+`</label>`
                                + `<i id="sticker-memo-comp-`+i+`"class="flaticon-speech-bubble-1" style= "margin-left : 8px; cursor : pointer"></i>`
                                + `</div>`
                    }
                    $("#viewtodoCompCnt").val(parseInt($("#viewtodoCompCnt").val())+cnt);
                    document.getElementById('todo-view-more-comp').innerHTML = tmpStr;
                }
            });

        });

        //ToDo checkbox 선택 시 실행될 function

        function viewInlineCheckboxClick(n){
            var tmpStr = "";
            var content = $("#viewInlineCheckboxLabelProc"+n).text();
            var cnt = $("#todoCompCnt").val();
            if($("#viewInlineCheckboxProc"+n).is(":checked")){
                
                var todoID = $("#viewprocTodoID"+n).val();
                //console.log(todoID);
                //console.log(cnt);

                
                $("#viewcheckboxProcDiv"+n).hide();
                
                
                $.ajax({
                    url:"/InitiativeController/setTodoListProcSTAjax",
                    type:"post",
                    dataType:"json",
                    data:{ 
                        id : todoID,
                        proc_st : '7',
                        update_by : '<?=$_SESSION['admin_names']?>'
                    },
                    success:function(res){
                        showNotification("해당 내용을 완료된 ToDoList로 이동시켰습니다.","init-custom-alert");

                        tmpStr += `<div class="form-check form-check-inline" style = "display : block; margin-top : 5px; margin-bottom : 5px;">`
                                    + `<input id="viewInlineCheckboxComp`+ cnt +`" class="form-check-input" type="checkbox" value="option1" checked disabled>`
                                    + `<label id="viewInlineCheckboxLabelComp`+ cnt +`"class="form-check-label" for="viewInlineCheckbox`+cnt+`">`+content+`</label>`
                                    + `</div>`
                        $("#todo-view-more-comp").append(tmpStr);

                    },
                    error:function(request,status,error){
                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                    }
                });




            
                
                
                
            }
        } 
        //자신감 변경
        function viewEditConf(s){
            var str = "";
            var initID = $("#modal-init-select-view option:selected").val();
            switch(s){
                    case "0" : str = "상"; break;
                    case "1" : str = "중"; break;
                    case "2" : str = "하"; break;
                    default : ; break;
                }
            //직접입력 : value만 세팅함
            var confStr = $("#view-conf-span").val();
            if(initID == "n"){
                showNotification("Initiative 선택 후 변경할 수 있습니다.","init-custom-alert");
                return ;
            }
            if(confStr != s){
                if(confirm("자신감 : " + str +"\n변경하시겠습니까?")){
                    //직접입력 아닌 경우 : DB에 변경사항 바로 저장됨
                    if(initID != "1"){
                        $.ajax({
                        url:"/InitiativeController/updateConfTPAjax",
                        type:"post",
                        dataType:"json",
                        data:{
                            id : initID,
                            conf_tp : s,
                            update_by : '<?=$_SESSION['admin_names']?>'
                        },
                        success:function(res){
                            showNotification("자신감이 변경되었습니다.","init-custom-alert");
                        },
                        error:function(request,status,error){
                            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                        });
                    }
                    //console.log(str);
                    $("#view-conf-span").text(str);
                    $("#view-conf-span").val(s);
                    //console.log($("#view-conf-span").val());
                }
            }
        }
        
        function setProgress(a){
            var initID = $("#modal-init-select-view option:selected").val();
            var text = $("#st-btn").text();
            var value =$("#st-btn").val();
            //console.log($("#st-btn").text());
            //console.log($("#st-btn").val());
            var id = '<?=$_SESSION['admin_names']?>';
            var emp_no = '<?=$_SESSION['emp_no']?>' ;
            
            if(a != value){
                if(confirm("진행 상태를 변경하시겠습니까?")){
                    
                    if($("#modal-init-select-view option:selected").val() == 'n'){
                        showNotification("Initiative 선택 후 변경할 수 있습니다.","init-custom-alert");
                    }

                    else if(a != value){

                        if(a == '0'){
                            text = "진행";
                        }
                        else if(a == '7'){
                            text = "완료";
                        }

                        $.ajax({
                            url:"/InitiativeController/setProgressAjax",
                            type:"post",
                            dataType:"json",
                            data:{
                                id : initID,
                                proc_st : a,
                                update_by : '<?=$_SESSION['admin_names']?>'
                            },
                            success:function(res){
                                showNotification("진행 상태가 변경되었습니다.","init-custom-alert");
                                $("#st-btn").val(a);
                                $("#st-btn").text(text);
                            },
                            error:function(request,status,error){
                                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                            }
                        });
                    }
                }
            }
                

            
            
        }

        
        //댓글 만들기
        function makeInitViewReply(n,name,content,day,id,like){
            //console.log("makeInitViewReply에서 본 like");
            //console.log(like);

            var tmpStr = "";
            tmpStr += `<div class = "initiative-comment" style="margin-left : 5px; border-radius : 10px; margin : 5px; border : solid 0.1em; width : 95%">`
                                        + `<div>` //프로필, 이름, 날짜

                                            + `<div class="float-right" id="test-date" style ="margin-right: 10px;">`//날짜[오른쪽 정렬]
                                                + `<span>`+day+`<span>`
                                                +  `<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true">
                                                    <a href="#" class="m-portlet__nav-link m-dropdown__toggle btn m-btn m-btn--link" style="display : inline; float:right; padding:0px">
                                                        <i class="la la-ellipsis-h"></i>
                                                    </a>
                                                    <div class="m-dropdown__wrapper" style="z-index: 101; width:auto; height:auto;">
                                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 29.5px;"></span>
                                                        <div class="m-dropdown__inner">
                                                            <div class="m-dropdown__body" style="padding:5px">
                                                                <div class="m-dropdown__content">
                                                                    <ul class="m-nav">
                                                                        <li class="m-nav__item">
                                                                            <a role="button" class="btn" data-toggle="modal" onclick = "updateInitReplyStatus(`+n+`,'s');">수정</a>
                                                                            <a role="button" class="btn" data-toggle="modal" onclick = "updateInitReplyStatus(`+n+`,'d');">삭제</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`//DROPDOWN [댓글 수정/삭제]
                                            + `</div>`
                                            
                                        + `<i id = "init-reply-user-icon-`+n+`" class="flaticon-profile-1" style = "margin-left : 5px"></i>` //프로필
                                        + `<span style="margin-left : 5px;">`+ name +`</span>`// 이름
                                        +`</div>`//프로필, 이름, 날짜 끝
                                        +`<input type="hidden" id = "init-reply-id-`+n+`" value = "`+id+`">` //reply ID 저장하려고 임시로 일단 둠
                                        +`<div>`//좋아요 및 내용 표시
                                            +`<div id = "init-reply-mention-div-`+n+`" style="display : none"></div>` //멘션때문에 임시로 둠
                                            +`<span id = "init-reply-content-`+n+`">`+ content +`</span>` // 내용
                                            + `<div class="float-right" id="test-date" style ="margin-right: 5%;">` //오른쪽 정렬 하트 2개
                                                +`<span id = "likes-cnt-init-rply-`+n+`" style="margin-right : 10px;"></span>`//좋아요 수
                                                +`<i id = "rply-blank-heart-`+n+`" class="far fa-heart" style="display : inline; color : red" onclick = "saveLikeInitReply(`+n+`,0);"></i>`//빈 하트
                                                +`<i id = "rply-heart-`+n+`"class="fas fa-heart" style="display : none; color : red" onclick = "saveLikeInitReply(`+n+`,1);"></i>`//찬 하트
                                            +`</div>`
                                        +`</div>`
                                        ;

            $("#init-view-reply-div").prepend(tmpStr);
            if(like == "Y"){
                $("#rply-blank-heart-"+n).hide();
                $("#rply-heart-"+n).show();
            }
            else if(like == "N"){
                $("#rply-blank-heart-"+n).show();
                $("#rply-heart-"+n).hide();
            }
            getLikeInitReply(n);
            

        }
        //댓글 수정/삭제
        function updateInitReplyStatus(n,s){
            var post_tp = "";
            var str = "";
            var initID = $("#modal-init-select-view option:selected").val();

            //delete일 때
            if(s == 'd'){
                post_tp = "d";
                str = "삭제되었습니다.";
                
                //삭제되었습니다 표시
            }
            //update일 때
            else if(s == 'd'){
                post_tp = "d";
                str = "수정되었습니다.";
            }

            showNotification(str,"init-custom-alert");
        }

        //댓글 좋아요 수 표시
        function getLikeInitReply(n){
            var replyID = $("#init-reply-id-"+n).val();
            $.ajax({
                url:"/InitiativeController/getLikeCntInitReplyAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : replyID,
                },
                success:function(res){
                    //console.log("댓글 좋아요 수 표시");
                    //console.log(res);
                    $("#likes-cnt-init-rply-"+n).text(res.COUNT);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });

        }

        //댓글 좋아요 여부 변경
        function saveLikeInitReply(n,chk){
            var replyID = $("#init-reply-id-"+n).val();
            //console.log("좋아요 누른것의 ID");
            //console.log(replyID);
            var str = ""
            var tmp = "";
            var tmpCnt;
            if(chk == "0"){
                $("#rply-heart-"+n).show();
                $("#rply-blank-heart-"+n).hide();
                tmp = "Y"
                tmpCnt = parseInt($("#likes-cnt-init-rply-"+n).text()) + 1;
                $("#likes-cnt-init-rply-"+n).text(tmpCnt);
            }
            else{
                $("#rply-heart-"+n).hide();
                $("#rply-blank-heart-"+n).show();
                tmp = "N"
                tmpCnt = parseInt($("#likes-cnt-init-rply-"+n).text()) - 1;
                $("#likes-cnt-init-rply-"+n).text(tmpCnt);
                str = "취소되었습니다.";
            }
            

            $.ajax({
                url:"/InitiativeController/saveLikeInitReplyAjax",
                type:"post",
                dataType:"json",
                data:{
                    nice_yn : tmp,
                    update_by : '<?=$_SESSION['admin_names']?>',
                    id : replyID,
                    empy_no : '<?=$_SESSION['emp_no']?>'
                },
                success:function(res){
                    //console.log(res);
                    if(str != "")
                        showNotification(str,"init-custom-alert");
                        getLikeInitReply(n);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });

            
        }
        
        

        //댓글 저장하기
        function saveInitViewReply(){
            var content = $("#init-view-reply-textarea").val();
            var initID = $("#modal-init-select-view option:selected").val();
            var date;

            if(initID == "n"){
                showNotification("Initiative 선택 후 댓글을 입력할 수 있습니다.","init-custom-alert");
                $("#init-view-reply-textarea").val("");
                return ;
            }

            if(content == ""){
                showNotification("입력된 내용이 없습니다.","init-custom-alert");
                return;
            }

            $.ajax({
                url:"/InitiativeController/saveInitViewReplyAjax",
                type:"post",
                dataType:"json",
                data:{
                    create_by : '<?=$_SESSION['admin_names']?>',
                    empy_no : '<?=$_SESSION['emp_no']?>',
                    content : content,
                    id : initID
                },
                success:function(res){
                    date = (res.CREATE_ON).split(".")[0];
                    $("#init-view-reply-textarea").val("");
                    showNotification("댓글이 저장되었습니다.","init-custom-alert");
                    //console.log(res);
                    makeInitViewReply(99999,res.CREATE_BY,res.CONTENT,date,res.ID,"n");
                    saveInitReplyData(res.ID);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });

        }

        
        //댓글 세팅하기
        function setInitViewReply(initID){
            //console.log(initID);
            var rplyID = new Array();
            
            $.ajax({
                url:"/InitiativeController/getInitViewReplyAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : initID,
                    empy_no : '<?=$_SESSION['emp_no']?>'
                },
                success:function(res){
                    var date;
                    var cnt = Object.keys(res).length;
                    //console.log("댓글 세팅 res : ")
                    //console.log(res);
                    //console.log(cnt);
                    for(var i = 0; i < cnt; i++){
                        rplyID[i] = res[i].ID;
                        //console.log()
                        //만약 부른 댓글이 있으면 div 상자 보여지게하고, 내용 입력하기
                        if(res[i].OKR_RPLY_ID == '0'){
                            
                        }
                        date = (res[i].CREATE_ON).split(".")[0];
                        //console.log(date);

                        //내용이 비어있는건 삭제처리된것으로 간주
                        if(res[i].CONTENT != ""){
                            makeInitViewReply(i,res[i].CREATE_BY,res[i].CONTENT,date,res[i].ID,res[i].NICE_YN);
                        }

                    }
                    //console.log("보내는 rply ID");
                    //console.log(rplyID);
                    initReplyReadOK(rplyID);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }

        //스크롤 event : 댓글 읽기에 사용하기위함
        /*
        $('#initiative-view-modal').on("scroll",function(){
            //console.log("Scrolling");
            //console.log(document.documentElement.scrollTop);
        });
        */


        //댓글 읽음 여부 판단 후 만들기
        // select Init댓글ID where 지금 로그인 한 사람 emp_no = 댓글읽음의 emp_no and okr_init_id = 선택된 initiativeID => join : 댓글 ID
        function initReplyReadOK(ary){
            var initID = $("#modal-init-select-view option:selected").val();
            var idList = new Array();
            var savedIndex = new Array();
            //console.log("받는 rply ID");
            //console.log(ary);

            //read 했는지 여부 불러오려고함
            $.ajax({
                url:"/InitiativeController/initReplyReadOKAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : initID,
                    create_by : '<?=$_SESSION['admin_names']?>',
                    empy_no : '<?=$_SESSION['emp_no']?>',
                },
                success:function(res){
                    //console.log("댓글 읽음 저장 res : ")
                    var cnt = Object.keys(res).length;
                    //console.log(res);
                    //console.log(cnt);
                    if(cnt == 0){
                        for(var i = 0; i < ary.length; i++){
                            saveInitReplyData(ary[i]);
                        }
                    }
                    else{
                        var k = 0;
                        for(var i = 0; i < ary.length; i++){
                            for(var j = 0; j < cnt; j++){

                                //console.log("형변환");
                                //console.log(ary[i] == parseInt(res[j].OKR_RPLY_ID));
                                //console.log("형변환X");
                                //console.log(ary[i] == res[j].OKR_RPLY_ID)

                                if(ary[i] == parseInt(res[j].OKR_RPLY_ID)){
                                    //console.log("페이지에 있는거");
                                    //console.log(ary[i]);
                                    //console.log("Ajax에서 가져온거");
                                    //console.log(res[j].OKR_RPLY_ID);
                                    savedIndex[k] = i;
                                    k++
                                }
                                else{
                                    //console.log("페이지에 있는거");
                                    //console.log(ary[i]);
                                    //console.log("Ajax에서 가져온거");
                                    //console.log(res[j].OKR_RPLY_ID);
                                }
                            }
                        }
                        var tmpCnt = k;
                        var j = 0;
                        for(var i = 0; i < k; i++){
                            if(i == savedIndex[j]){
                                j++
                                continue;
                            }
                            else{
                                saveInitReplyData(ary[i]);
                            }
                        }
                    }
                    //console.log(res);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }

        function saveInitReplyData(replyID){
            $.ajax({
                url:"/InitiativeController/saveInitReplyDataAjax",
                type:"post",
                dataType:"json",
                data:{
                    id : replyID,
                    create_by : '<?=$_SESSION['admin_names']?>',
                    empy_no : '<?=$_SESSION['emp_no']?>',
                },
                success:function(res){
                    //console.log("댓글 읽음 저장 res : ");
                    //console.log(res == "");
                    //console.log(res == null);
                    //console.log(res);
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        }


        function writeInputFile(){
            if($("#init-rply-input-file").hasClass("hid")){
                $("#init-rply-input-file").removeClass("hid");
            }
            else{
                $("#init-rply-input-file").addClass("hid");
            }
        }
        function initReplyPressEnter(){
            var str = "";
            var code = event.keyCode;
            if(code == '13'){
                if(confirm("저장하시겠습니까?")){
                    
                    saveInitViewReply();

                }
            }
        }

        
        
       
    </script>
