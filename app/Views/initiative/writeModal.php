<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <!-- Modal -->
    <div class="modal fade" id="initiative-write-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style = "border-bottom: 0 none; padding-bottom : 5px">
                    <h5 class="modal-title text-center" id="exampleModalLongTitle">Initiative Tool</h5>
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
                                                                <select style="height : 30px" id = 'modal-init-select'>
                                                                    <option disabled selected value ="n">KR을 선택해주세요</option>
                                                                </select>
                                                                <input type="text" id="init-input-box" style="width : 95%; margin-top : 5px; display : none; height : 30px;">
                                                            </span></div>
                                                            <br><input type="file" style="margin-bottom : 10px;"></input>
                                                        <!-- ToDo 완료/진행중 버튼 -->
                                                        <div style="margin-top : 5px">
                                                            <button id = "write-todo-uncompleted-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 10px; opacity : 1; ">To Do List</button>
                                                            <button id = "write-todo-completed-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 0; margin-left : 5px; opacity : 0.5;">완료된<br>To Do List</button>
                                                        </div>
                                                    </div>
                                                   
                                                    <!-- ToDo 더보기 -->
                                                    <div id = "todo-write-more-btn" style="margin : 5px; cursor : pointer; margin-top : 20px;">
                                                        <img src="/assets/icon/top_icon.png" width="20px" height="20px" style = "transform : rotate(180deg);">
                                                        <span style="font-size : 12px;">더 보기</span>
                                                    </div>

                                                    <!-- ToDo 더보기 자세한 내용들 -->
                                                    <div id = "todo-write-more" style = "display : none; margin : 5px" style = "display : block">

                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1" checked disabled>
                                                            <label class="form-check-label" for="inlineCheckbox1" style ="text-decoration:line-through">OKR System 화면 구성 미팅</label>
                                                            <i class="flaticon-speech-bubble-1" style= "margin-left : 8px;"></i>
                                                        </div>

                                                        <div id ="init-write-file-download" class="첨부파일">
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
                                                    
                                                    <!--ToDo 새로운 항목 추가하여 입력 -->
                                                    <div id ="new-todo-list-div" style="margin-left: 5px; margin-top : 5px;">
                                                        <span id = "new-todo-make-span" style=" margin-left : 4%; display: block">항목 추가&nbsp;<i id = "new-todo-make-btn" class="flaticon-add-circular-button " onclick="newTodoAdd(0);" style="cursor:pointer;"></i></span><br>
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
        $("#write-todo-completed-button").click(function(){
            var element2 = document.getElementById('write-todo-completed-button');
            element2.style.opacity ="1";
            var element = document.getElementById('write-todo-uncompleted-button');
            element.style.opacity = "0.5";
        });

        $("#write-todo-uncompleted-button").click(function(){
            var element2 = document.getElementById('write-todo-completed-button');
            element2.style.opacity ="0.5";
            var element = document.getElementById('write-todo-uncompleted-button');
            element.style.opacity = "1";
        });

        //더보기 toggle
        $('#todo-write-more-btn').click(function(){
			$("#todo-write-more").toggle();
        });
        

        //KR 선택 시 Initiative 세팅
        $("#modal-kr-select").on("change", function(){
            $("#todo-write-more").hide();
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


        //Initiative 직접입력
        $(function(){
            //직접입력 인풋박스 기존에는 숨어있다가
            $("#init-input-box").hide();
            $("#new-todo-make-span").hide();
            $("#init")
            $("#modal-init-select").change(function() {
                //$("#todo-write-more").html("");
                //직접입력을 누를 때 나타남
                if($("#modal-init-select").val() == "1") {
                    $("#new-todo-make-span").show();
                    $("#init-input-box").show();
                    $("#write-todo-completed-button").hide();
                    $("#todo-write-more-btn").hide();
                    $("#todo-write-more").html("");

                }else {
                    $("#new-todo-make-span").show();
                    $("#init-input-box").hide();
                    $("#write-todo-completed-button").show();
                    $("#todo-write-more-btn").show();
                    console.log($(this).val());
                    $("#todo-write-more").show();
                    
                    //Initative 직접 입력 아닐 시 ToDo 세팅
                    $.ajax({
                        url:"/InitiativeController/getTodoListAjax",
                        type:"get",
                        dataType:"json",
                        data:{
                            initKey:$(this).val(),
                        },
                        success:function(res){
                            var cnt = Object.keys(res).length;
                            var tmpStr = "";
                            for(var i = 0; i < cnt; i++){
                                tmpStr += `<div class="form-check form-check-inline" style = "display : block">`
                                        + `<input id="writeInlineCheckbox`+ i +`" class="form-check-input" type="checkbox" value="option1">`
                                        + `<label id="writeInlineCheckboxLabel`+ i +`"class="form-check-label" for="writeInlineCheckbox`+i+`">`+res[i].CONTENT+`</label>`
                                        + `<input type = "hidden" value = `+res[i].ID+`>`
                                        + `</div>`
                            }
                            console.log(tmpStr);
                            document.getElementById('todo-write-more').innerHTML = tmpStr;
                        }
                    });
                    
                }
            }) 
        });

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
                <input type="text" id="init-input-box-`+ n +`" style="width : 88%; margin-top : 5px; display : inline; height : 30px;"></input>
                <i id = "todo-del-btn-`+n+`" class="flaticon-cancel" onclick="deleteTodoAdds(`+n+`);" style="cursor:pointer; margin-left : 5px;"></i>
             </span>`;

            btnStr +=
            `항목 추가&nbsp;<i id = "new-todo-make-btn" class="flaticon-add-circular-button" onclick="newTodoAdd(`+n+`);" style="cursor:pointer; value="`+n+`"></i><br>
             <input id = "new-todo-make-cnt" type="hidden" value =`+n+`>`;
            $("#new-todo-make-span").html(btnStr);
            // $("#new-todo-list-div").append($("#new-todo-list-div").html() + tmpStr);
            $("#new-todo-list-div").append(tmpStr);
            console.log($("#new-todo-make-btn").html());
            console.log(tmpStr);

        }

        //Todo 숨기기
        function deleteTodoAdds(n){
            $("#init-input-box-"+n).val("");
            console.log($("#init-input-box-"+n).val()+"이건 deleteTo어쩌고 에서");
            $("#init-input-span-"+n).hide();
            
        }

        //Initiative 등록
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

                if(saveOK == 1){
                    console.log("onlyInit의 값은 뭐죠?");
                    console.log(onlyInit);
                    if(confirm("내용을 저장하시겠습니까?")){
                        console.log("통과");


                        //Initiative Tool에 내용 저장하는 경우
                        $.ajax({
                            url:"/InitiativeController/saveInitiativeAjax",
                            type:"post",
                            dataType:"json",
                            data:{
                                "okr_keys_id" : krID,
                                "empy_no" : empNum,
                                "content" : initContent,
                                "conf_tp" : initConfTP,
                                "create_by" : empName
                            },
                            success:function(res){
                                alert("저장되었습니다.");
                                console.log(jQuery.parseJSON(res));
                                //console.log(JSON.parse(JSON.stringify(res))); 
                            },
                            error:function(request,status,error){
                                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                            }
                        });
                        
                        
                        


                        //ToDoList까지 같이 저장하는 경우
                        if(onlyInit == 0){
                            console.log("ToDo까지 저장됨");
                            

                        }

                        //ToDo MST Table에 ToDo 저장
                        /*
                        $.ajax({
                            url:"/InitiativeController/saveInitiativeAjax",
                            type:"post",
                            dataType:"json",
                            data:{
                                keysID : krID,
                                initConfTP : initConfTP,
                                toDoContent : toDoContent,
                                initContent : iniiContent,
                                initProcST : initProcST,
                                emp_no: empNum,
                            },
                            success:function(res){
                                var cnt = Object.keys(res).length;
                                var tmpStr = "";
                                for(var i = 0; i < cnt; i++){
                                    tmpStr += `<option value='`+res[i].ID+`'>`+res[i].CONTENT+`</option>`;
                                }
                                tmpStr += `<option value= '1'>직접 입력</option>`
                                document.getElementById('modal-init-select').innerHTML = tmpStr;
                            }
                        });
                        */

                        //Initiative MST Table에 Initiative 저장
                        /*

                        */
                    }
               
                }
                
            }

            
        });

        //자신감 변경
        function writeEditConf(s){
            var str = "";
            switch(s){
                case "0" : str = "상"; break;
                case "1" : str = "중"; break;
                case "2" : str = "하"; break;
                default : ; break;
            }
            var confStr = $("#write-conf-span").val();
            if(confStr != s){
                if(confirm("                                     자신감 : " + str +"\n                                 변경하시겠습니까?")){
                    console.log(str);
                    $("#write-conf-span").text(str);
                    $("#write-conf-span").val(s);
                    console.log($("#write-conf-span").val());
                }
            }
        }



       
    </script>
