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
    </style>

</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="initiative-write-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style = "border-bottom: 0 none; padding-bottom : 5px">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Initiative Tool 등록</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- form 시작-->
                <form>
                    <div class="modal-body" style="padding : 0">
                        <div class="m-portlet  m-portlet--unair">
							<div class="m-portlet__head"  style = "padding : 0; margin : 5px;">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
                                            <span class="init-badge m-badge m-badge--success m-badge--wide" style = "border-radius : 3px; padding : 10px; background-color : #9F9FFF">KR</span>
                                            <span style="font-size : 13px; margin-left : 5px" contenteditable="true">
                                                <select id = 'modal-kr-select' style="height : 30px;">
                                                    <option disabled selected value ="n">====선택====</option>
                                                    <?php                   
                                                        $i = 1;                  
                                                        foreach($dashBoardData['team']['krList'] as $key => $bean){
                                                        ?>
                                                            <option value='<?=$bean["ID"]?>'><?=$bean["CONTENT"]?></option>
                                                        <?php
                                                        $i = $i + 1;
                                                        }
                                                    ?>
                                                </select>
                                            </span><br>
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
                                                            <span style="font-size : 12px; margin : 5px;">
                                                                <select style="height : 30px; width : 70%" id = 'modal-init-select'>
                                                                    <option disabled selected value ="n">KR을 선택해주세요</option>
                                                                </select>
                                                                <!--여기 추가하려고 생각한 것 : 수정버튼[누를 시 selected 내용이 textbox로 변경되며 select는 숨겨짐 + todo에도...]-->
                                                                <input type="text" id="init-input-box" style="width : 95%; margin-top : 5px; display : none; height : 30px;">
                                                            </span></div>
                                                            <br><input id ="init-file" type="file" style="margin-bottom : 10px; display : hidden"></input>

                                                        <!-- ToDo 완료/진행중 버튼 -->
                                                        <div style="margin-top : 5px">
                                                            <button id = "write-todo-uncompleted-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 10px; opacity : 1; ">To Do List</button>
                                                            <button id = "write-todo-completed-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 0; margin-left : 5px; opacity : 0.5;">완료된<br>To Do List</button>
                                                        </div>
                                                    </div>
                                                   
                                                    <!-- ToDo 더보기 -->
                                                    <div  style="margin : 5px; cursor : pointer; margin-top : 20px;">
                                                        <img  id = "todo-write-more-btn" src="/assets/icon/top_icon.png" width="20px" height="20px">
                                                    </div>
                                                    

                                                    <!-- ToDo 더보기 자세한 내용들[진행중] / 초기값 : block -> 처음 보여지는 것이 진행중인 ToDo목록이라서 -->
                                                    <input id = "proc-hidden" type ="hidden" value = "block">
                                                    <div class ="todo-write-more" id = "todo-write-more-proc" style = "display : none; margin : 5px" style = "display : none">
                                                    </div>

                                                    <!-- ToDo 더보기 자세한 내용들[완료] -->
                                                    <input id = "comp-hidden" type = "hidden" value = "none">
                                                    <div class ="todo-write-more" id = "todo-write-more-comp" style = "display : none; margin : 5px" style = "display : none">
                                                    </div>

                                                    <!--완료된 To Do List Count-->
                                                    <input id = "todoCompCnt" type = "hidden" value = 0 >
                                                    
                                                    <!--ToDo 새로운 항목 추가하여 입력 -->
                                                    <div id ="new-todo-list-div" style="margin-left: 5px; margin-top : 5px;">
                                                        <span id = "new-todo-make-span" style=" margin-left : 4%; display: block">To Do List 추가&nbsp;<i id = "new-todo-make-btn" class="flaticon-add-circular-button " onclick="newTodoAdd(0);" style="cursor:pointer;"></i></span><br>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <div class="m-widget24">
                                                <div class="m-widget24__item">
                                                    <div style = "margin : 5px">
                                                        <button id = "st-btn" type="button" class="btn btn-info" style = "margin-left : 10%; width : 80% ;text-align: center; height : 30px; padding : 7px; border-radius : 3px">진행</button>
                                                    </div>
                                                    <div>
                                                        <div style="text-align : center; margin-left : 10%; width : 80% ;">
                                                            <span style="font-size : 15px; font-weight : bold">담당</span><br>
                                                            <i class="flaticon-profile-1"></i>
                                                            <span><?=$_SESSION['admin_names']?></span>
                                                        </div>
                                                        <div style="margin : 5px;">

                                                        </div>
                                                    </div>
                                                    <div style = "margin : 5px">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" style = "margin-left : 10%; width : 80% ;text-align: center; height : 50px; padding : 7px; border-radius : 3px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">자신감&nbsp;&nbsp;<span id ="write-conf-span" value = "0">상</span><br></button>
                                                            <div id = "write-conf-select" class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:writeEditConf('0');">상</a>
                                                                <a class="dropdown-item" href="javascript:writeEditConf('1');">중</a>
                                                                <a class="dropdown-item" href="javascript:writeEditConf('2');">하</a>
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            

                            </div>
                            <hr>
                            <button id = "init-write-save" type="button" class="btn btn-secondary float-right" style = "margin : 5px; border-radius : 3px; background-color : #9F9FFF; color : white; font-size : 12px; width : 20%">등록</button>
                            
                            <!-- 이걸로 하면 모달도 닫히는거 참고하라고 남겨둠
                            <button id = "init-write-save" type="button" class="btn btn-secondary float-right" data-dismiss="modal" style = "margin : 5px; border-radius : 3px; background-color : #9F9FFF; color : white; font-size : 12px; width : 20%">등록</button>
                            -->

                            <!-- modal-footer end -->
						</div>

                        <div style="height : 10px"></div>
                    </div>
                </form>

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

    
    <script>

    
        //완료된 To Do List 버튼 누를 때
        $("#write-todo-completed-button").click(function(){
            var element2 = document.getElementById('write-todo-completed-button');
            element2.style.opacity ="1";
            $("#todo-write-more-comp").show();
            $("#comp-hidden").val("block");
            $("#todo-write-more-proc").hide();
            $("#proc-hidden").val("none");

            var element = document.getElementById('write-todo-uncompleted-button');
            element.style.opacity = "0.5";

            //각도 확인 후 제거
            if($("#todo-write-more-btn").hasClass("deg"))
                $("#todo-write-more-btn").removeClass("deg");
        });

        //To Do List 버튼 누를 때
        $("#write-todo-uncompleted-button").click(function(){
            var element2 = document.getElementById('write-todo-completed-button');
            element2.style.opacity ="0.5";
            $("#todo-write-more-proc").show();
            $("#comp-hidden").val("none");
            $("#todo-write-more-comp").hide();
            $("#proc-hidden").val("block");
            var element = document.getElementById('write-todo-uncompleted-button');
            element.style.opacity = "1";
            console.log($("#todo-write-more-btn").hasClass("deg"));
            if($("#todo-write-more-btn").hasClass("deg")){
                $("#todo-write-more-btn").removeClass("deg");
            }
        });

        //더보기 toggle
        $('#todo-write-more-btn').click(function(){
            var proc = $("#proc-hidden").val();
            var comp = $("#comp-hidden").val();
            //$(this).css({'transform':'rotate(deg)'});

            if(proc == "block"){
                $("#todo-write-more-proc").toggle();
            }
            else if(comp == "block"){
                $("#todo-write-more-comp").toggle();
            }
            $(this).toggleClass("deg");

            console.log(proc);
            console.log(comp);

        });
        

        //KR 선택 시 Initiative 세팅
        $("#modal-kr-select").on("change", function(){
            $(".todo-write-more").hide();
            var empNum = '<?=$_SESSION['emp_no']?>';
            $.ajax({
                url:"/InitiativeController/getInitiativeListAjax",
                type:"get",
                dataType:"json",
                data:{
                    okrKey:$(this).val(),
                    emp_no: empNum
                },
                success:function(res){
                    var cnt = Object.keys(res).length;
                    var tmpStr = '<option disabled selected value ="n">====선택====</option>';
                    for(var i = 0; i < cnt; i++){
                        tmpStr += `<option value='`+res[i].ID+`'>`+res[i].CONTENT+`</option>`;
                    }
                    tmpStr += `<option value= '1'>직접 입력</option>`
                    document.getElementById('modal-init-select').innerHTML = tmpStr;
                },
                error:function(request,status,error){
                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            });
        });


        //Initiative 직접입력 && 초기실행
        $(function(){


            //직접입력 인풋박스 기존에는 숨어있다가
            $("#init-file").hide();
            $("#init-input-box").hide();
            $("#new-todo-make-span").hide();
            $("#init")
            $("#modal-init-select").change(function() {
                //$("#todo-write-more").html("");

                //Initiative 직접입력을 누를 때 동작
                if($("#modal-init-select").val() == "1") {

                    //파일, 직접 입력할 TextBox, ToDoList 추가하기 버튼 보이기
                    $("#init-file").show();
                    $("#new-todo-make-span").show();
                    $("#init-input-box").show();

                    //완료된 To Do List 버튼/내용 더 보기 버튼 숨기기
                    $("#write-todo-completed-button").hide();
                    $("#todo-write-more-btn").hide();

                    //To Do List 비우는작업
                    $("#todo-write-more-comp").html("");
                    $("#todo-write-more-proc").html("");

                    //자신감 기본세팅 : 상
                    $("#write-conf-span").text("상");
                }else {
                    //파일 비우기도 해야함!
                    $("#new-todo-make-span").show();
                    $("#init-input-box").hide();
                    $("#init-file").hide();
                    $("#write-todo-completed-button").show();
                    $("#todo-write-more-btn").show();
                    console.log($(this).val());
                    if($("#proc-hidden").val() == "block"){
                        $("#todo-write-more-proc").show();
                    }
                    else if($("#comp-hidden").val() == "block"){
                        $("#todo-write-more-comp").show();
                    }

                    //Initiaitve 직접 입력 아닐 시 자신감 세팅
                    $.ajax({
                        url:"/InitiativeController/getInitConfTPAjax",
                        type:"get",
                        dataType:"json",
                        data:{
                            initKey:$(this).val(),
                        },
                        success:function(res){
                            console.log(res);
                            $("#write-conf-span").val(res.CONF_TP);
                            var str="";
                            switch($("#write-conf-span").val()){
                                case "0" : str = "상"; break;
                                case "1" : str = "중"; break;
                                case "2" : str = "하"; break;
                                default : ; break;
                            }
                            console.log(str);
                            $("#write-conf-span").text(str);
                        }
                    });
                    
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
                                tmpStr += `<div id = "checkboxProcDiv`+i+`" class="form-check form-check-inline" style = "display : block; margin-top : 5px; margin-bottom : 5px;">`
                                        + `<input id="writeInlineCheckboxProc`+ i +`" class="form-check-input" type="checkbox" value="option1" onClick = "writeInlineCheckboxClick(`+i+`)">`
                                        + `<label id="writeInlineCheckboxLabelProc`+ i +`"class="form-check-label" for="writeInlineCheckbox`+i+`">`+res[i].CONTENT+`</label>`
                                        + `<input id = "procTodoID`+i+`" type = "hidden" value = `+res[i].ID+`>`
                                        + `</div>`
                            }
                            console.log(tmpStr);
                            document.getElementById('todo-write-more-proc').innerHTML = tmpStr;
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
                                        + `<input id="writeInlineCheckboxComp`+ i +`" class="form-check-input" type="checkbox" value="option1" checked disabled>`
                                        + `<label id="writeInlineCheckboxLabelComp`+ i +`"class="form-check-label" for="writeInlineCheckbox`+i+`">`+res[i].CONTENT+`</label>`
                                        + `</div>`
                            }
                            $("#todoCompCnt").val(parseInt($("#todoCompCnt").val())+cnt);
                            console.log(tmpStr);
                            document.getElementById('todo-write-more-comp').innerHTML = tmpStr;
                        }
                    });
                    
                }
            }) 
        });

        //ToDo checkbox 선택 시 실행될 function

        function writeInlineCheckboxClick(n){
            var tmpStr = "";
            var content = $("#writeInlineCheckboxLabelProc"+n).text();
            var cnt = $("#todoCompCnt").val();
            if($("#writeInlineCheckboxProc"+n).is(":checked")){
                if(confirm("해당 내용을 완료된 ToDoList로 이동시키겠습니까? \n[※ 완료 처리 후 수정 불가능]")){
                    var todoID = $("#procTodoID"+n).val();
                    console.log(todoID);
                    console.log(cnt);

                    
                    $("#checkboxProcDiv"+n).hide();
                    
                    
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
                            alert("해당 내용을 완료된 ToDoList로 이동시켰습니다.");

                            tmpStr += `<div class="form-check form-check-inline" style = "display : block; margin-top : 5px; margin-bottom : 5px;">`
                                        + `<input id="writeInlineCheckboxComp`+ cnt +`" class="form-check-input" type="checkbox" value="option1" >`
                                        + `<label id="writeInlineCheckboxLabelComp`+ cnt +`"class="form-check-label" for="writeInlineCheckbox`+cnt+`">`+content+`</label>`
                                        + `</div>`;
                            $("#todo-write-more-comp").append(tmpStr);

                        },
                        error:function(request,status,error){
                            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                    });




                }
                
                else{
                    $("#writeInlineCheckboxProc"+n).prop("checked",false);
                }
                
            }
        }
        

        //첨부파일 할라한거..
        $("#init-write-file-download").on("click",function(){

        })
        
        //Todo 추가
        function newTodoAdd(n){
            var tmpStr = "";
            var btnStr = "";
            n++;
            tmpStr +=
            `<span id = "init-input-span-`+n+`" style ="display : block">
                <input type="text" id="init-input-box-`+ n +`" style="width : 85%; margin-top : 5px; display : inline; height : 30px;"></input>
                <i id = "todo-del-btn-`+n+`" class="flaticon-cancel" onclick="deleteTodoAdds(`+n+`);" style="cursor:pointer; margin-left : 5px;"></i>
                <i id = "todo-file-btn-`+n+`" class="flaticon-tool-1 icon-xs" onclick="viewInputFile(`+n+`);"></i>
                <input id = "todo-file-`+n+`"type="file" style="display : none; margin-top : 5px; margin-bottom : 5px"> 
             </span>`;

            btnStr +=
            `To Do List 추가&nbsp;<i id = "new-todo-make-btn" class="flaticon-add-circular-button" onclick="newTodoAdd(`+n+`);" style="cursor:pointer;" value="`+n+`"></i><br>
             <input id = "new-todo-make-cnt" type="hidden" value =`+n+`>`;
            $("#new-todo-make-span").html(btnStr);
            // $("#new-todo-list-div").append($("#new-todo-list-div").html() + tmpStr);
            $("#new-todo-list-div").append(tmpStr);
            console.log($("#new-todo-make-btn").html());
            console.log(tmpStr);

        }

        

        //Todo 숨기기
        function deleteTodoAdds(n){
            if($("#init-input-box-"+n).val() != ""){
                if(confirm("해당 내용을 삭제하시겠습니까?")){
                    $("#init-input-box-"+n).val("");
                    console.log($("#init-input-box-"+n).val()+"이건 deleteTo어쩌고 에서");
                    $("#init-input-span-"+n).hide();
                }
            }
            else{
                $("#init-input-box-"+n).val("");
                console.log($("#init-input-box-"+n).val()+"이건 deleteTo어쩌고 에서");
                $("#init-input-span-"+n).hide();
            }
            
        }

        //첨부파일 아이콘 눌렀을 때 아래의 input type="file" 보이게하기
        function viewInputFile(n){
            $("#todo-file-"+n).show();
            //toggle로 하려다가 업로드했다가 닫으면 첨부 안한걸로 할까봐 show로 바꿈..  
        }

        //Initiative + ToDo 등록
        $("#init-write-save").on("click", function(){
            if($("#write-conf-span").val() == ""){
                $("#write-conf-span").val("0");
            }
            var empNum = '<?=$_SESSION['emp_no']?>';
            var empName = '<?=$_SESSION['admin_names']?>';
            //KR 관련
            var krID = $("#modal-kr-select option:selected").val(); //value : KR ID 들어있음

            //Initiative 관련
            var initContent = "";
            var initID = $("#modal-init-select option:selected").val();
            var initConfTP = $("#write-conf-span").val();
            var initProcST = '0';
            var postInit = "";

            //ToDoList 관련
            var toDoContent = new Array();
            var toDoNotes; // 조회창에서 등록 가능하게 하기
            var toDoProcST = '0';
            var toDoCnt = 0;
            var saveOK = 1;
            var toDoIndex = 0;
            // Init만 저장 : 1, ToDo도 같이 저장 : 0
            var onlyInit = 0;


            if(initID == "1"){
                initContent = $("#init-input-box").val();
            }
            else{
                //직접입력 아닐 때 선택한 Initiative의 value(ID) 추출 --> TodoList 저장에 사용
                initID;
                console.log(initID);
                
            }
            console.log(krID);
            console.log(initConfTP);
            toDoCnt = $("#new-todo-make-cnt").val();
            console.log(toDoCnt);
            
            //Cnt만큼 반복하며 입력된 내용이 있는 것만 추출 + 입력된 것들에서만 첨부파일 추출해야함 같은 방식으로
            if(toDoCnt > 0){
                for(var i = 1; i <= toDoCnt; i++){
                    if($("#init-input-box-"+i).val() == ""){
                        continue;
                    }
                    else{
                        toDoContent[toDoIndex] = $("#init-input-box-"+i).val();
                        console.log(toDoContent[toDoIndex]);
                        toDoIndex++;
                    }
                }
            }
            
            //KR / Initiative 선택 or 입력 안했을 시 저장 불가능하게함.
            if(initID == "n"){
                
                if(krID == "n"){
                    alert("KR을 선택해주세요.");
                    
                }
                else{
                    alert("Initiative를 선택해주세요.");
                    
                }
            }
            else if(initID == "1" && initContent == ""){
                alert("Initiative를 입력해주세요.");
            }
            else{
                saveOK = 1;
                console.log("saveOK 1인가요?");
                console.log(saveOK == 1);
                if(toDoIndex == 0){
                    saveOK = 0;
                    console.log("saveOK 0인가요?");
                    console.log(saveOK == 0);
                    if(confirm("To Do List를 작성하지 않았습니다.\n저장하시겠습니까?")){
                        saveOK = 1;
                        onlyInit = 1;
                    }
                }
                else{
                    onlyInit = 0;
                }
                var tmpStr ="";
                if(saveOK == 1){
                    console.log("onlyInit의 값은 뭐죠?");
                    console.log(onlyInit);
                    console.log("글자수 : ");
                    console.log();
                    
                    console.log(typeof initContent);
                    if(confirm("내용을 저장하시겠습니까?")){
                        console.log("통과");
                        if(initID == "1"){
                            console.log(initContent.length >= 50);
                            if(initContent.length >= 50){
                                alert("Initiative의 최대 글자수는 50자입니다.\n다시 입력해주세요.");
                            }
                            else{
                                //Initiative Tool에 내용 저장하는 경우
                                $.ajax({
                                    url:"/InitiativeController/saveInitiativeAjax",
                                    type:"post",
                                    dataType:"json",
                                    data:{
                                        okr_keys_id : krID,
                                        empy_no : empNum,
                                        content : initContent,
                                        conf_tp : initConfTP,
                                        create_by : empName
                                    },
                                    success:function(res){
                                        
                                        tmpStr = res.ID;
                                        $("#modal-init-select option:selected").val(res.ID);
                                        console.log("initID 변경 : ");
                                        console.log($("#modal-init-select option:selected").val());
                                        if(onlyInit == 1){
                                            alert("저장되었습니다.");
                                            location.reload(true);
                                        }
                                        else{
                                            if(confirm("Initiative 저장되었습니다.\nToDo List를 저장하시겠습니까?")){
                                                $.ajax({
                                                    url:"/InitiativeController/saveToDoAjax",
                                                    type:"post",
                                                    dataType:"json",
                                                    data:{
                                                        okr_init_id : $("#modal-init-select option:selected").val(),
                                                        empy_no : empNum,
                                                        content : toDoContent,
                                                        proc_st : toDoProcST,
                                                        create_by : empName
                                                    },
                                                    success:function(res){
                                                        console.log(res);
                                                        alert("To Do List가 저장되었습니다.");
                                                        location.reload(true);
                                                        //console.log(jQuery.parseJSON(res));
                                                        //console.log(JSON.parse(JSON.stringify(res))); 
                                                    },
                                                    error:function(request,status,error){
                                                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                                                    }
                                                    
                                                    
                                                    //console.log(jQuery.parseJSON(res));
                                                    //console.log(JSON.parse(JSON.stringify(res))); 
                                                });
                                            }
                                        }
                                    },
                                    error:function(request,status,error){
                                        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                                    }
                                });
                            }
                        }
                        else{
                            console.log("initID 변경[TODO에서 확인하기] : ");
                            console.log(initID);
                            console.log("tmpStr : ");
                            console.log(tmpStr);
                            console.log("ToDo까지 저장됨");
                            if(initID == "1"){
                                initID = $("#modal-init-select option:selected").val();
                                console.log("init ID :")
                                console.log($("#modal-init-select option:selected").val());
                            }
                            
                            $.ajax({
                                url:"/InitiativeController/saveToDoAjax",
                                type:"post",
                                dataType:"json",
                                data:{
                                    okr_init_id : $("#modal-init-select option:selected").val(),
                                    empy_no : empNum,
                                    content : toDoContent,
                                    proc_st : toDoProcST,
                                    create_by : empName
                                },
                                success:function(res){
                                    console.log(res);
                                    alert("To Do List가 저장되었습니다.");
                                    location.reload(true);
                                    //console.log(jQuery.parseJSON(res));
                                    //console.log(JSON.parse(JSON.stringify(res))); 
                                },
                                error:function(request,status,error){
                                    alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                                }
                            });
                        }
                
                       
                    }
               
                }
                
            }

            
        });

        //자신감 변경
        function writeEditConf(s){
            var str = "";
            var initID = $("#modal-init-select option:selected").val();
            switch(s){
                    case "0" : str = "상"; break;
                    case "1" : str = "중"; break;
                    case "2" : str = "하"; break;
                    default : ; break;
                }
            //직접입력 : value만 세팅함
            var confStr = $("#write-conf-span").val();
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
                            alert("자신감이 변경되었습니다.");
                        },
                        error:function(request,status,error){
                            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                        }
                        });
                    }
                    console.log(str);
                    $("#write-conf-span").text(str);
                    $("#write-conf-span").val(s);
                    console.log($("#write-conf-span").val());
                }
            }
        }

        function openWriteModal(){
            $("#initiative-write-modal").modal({
            backdrop:'static'
            })
        }
        





       
    </script>
