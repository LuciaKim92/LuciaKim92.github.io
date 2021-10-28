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
    <div class="modal fade" id="initiative-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
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
                                            <span style="font-size : 13px; margin-left : 5px" contenteditable="true">OKR을 구축한다.</span><br>
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
                                                        <span style="font-size : 12px; margin-left : 5px" contenteditable="true">OKR System 설계</span></div>
                                                    <div style="margin-top : 5px">
                                                        <button id = "todo-uncompleted-button" type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 10px; opacity : 1; ">To Do List</button>
                                                        <button id = "todo-completed-button"type="button" class="btn btn-warning proc-btn" style = "border-color : #F79646; color : white; font-size : 11px; border-radius : 3px; background-color : #F79646; padding : 0; margin-left : 5px; opacity : 0.5;">완료된<br>To Do List</button>
                                                    </div>
                                                </div>

                                                <div id = "todo-view-more-btn"style="margin : 5px; cursor : pointer; margin-top : 20px;">
                                                    <img src="/assets/icon/top_icon.png" width="20px" height="20px" style = "transform : rotate(180deg);">
                                                    <span style="font-size : 12px;">더 보기</span>
                                                </div>
                                                <div id = "todo-view-more" style = "display : none; margin : 5px">
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
											</div>
										</div>
									</div>
                                    <div class="col-xl-3">
                                        <div class="m-widget24">
                                            <div class="m-widget24__item">
                                                <div style = "margin : 5px">
                                                    <button id = "st-btn" type="button" class="btn btn-info dropdown-toggle" style = "margin-left : 10%; width : 80% ;text-align: center; height : 30px; padding : 7px; border-radius : 3px"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">완료</button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#" onclick="setProgress('x');">진행</a>
                                                            <a class="dropdown-item" href="#" onclick="setProgress('o');">완료</a>
                                                        </div>
                                                </div>
                                                <div>
                                                    <div style="text-align : center; margin-left : 10%; width : 80% ;">
                                                        <span style="font-size : 15px; font-weight : bold">담당</span><br>
                                                        <i class="flaticon-profile-1"></i>
                                                        <span>유진</span>
                                                    </div>
                                                    <div style="margin : 5px;">

                                                    </div>
                                                </div>
                                                <div style = "margin : 5px">
                                                   <button class="btn btn-primary dropdown-toggle" type="button" style = "margin-left : 10%; width : 80% ;text-align: center; height : 50px; padding : 7px; border-radius : 3px" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">자신감&nbsp;&nbsp;<span id ="view-conf">상</span><br></button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="#">상</a>
                                                            <a class="dropdown-item" href="#">중</a>
                                                            <a class="dropdown-item" href="#">하</a>
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
                                <form>
                                    <div style = "margin-top : 10px; margin-bottom : 50px">
                                        <span style = "margin-left : 10px">댓글 입력</span>
                                        <div style="margin-left : 10%; border-radius : 10px; margin : 5px; border : solid 0.1em; height : 50px;">
                                            <div class="내용" style="margin-bottom : 30px">
                                                <span contenteditable="true">asdasdasdasdda</span>
                                            </div>
                                        </div>
                                        <div class="float-right" style="text-align : center; margin-right : 5px;">
                                            <button type="button" class="btn btn-info" style = "width : 50px; text-align: center; height : 30px; padding : 7px; border-radius : 3px">등록</span>
                                        </div>
                                    </div>
                                </form>
                                <!-- 댓글 입력 end -->

                                <!-- Initiative Tool 댓글들 시작   -->
                                <div style ="overflow:auto; height : 200px">
                                <hr>
                                    <!-- 댓글 한칸 start -->
                                    <div class = "initiative-comment" style="margin-left : 5px; border-radius : 10px; margin : 5px; border : solid 0.1em; ">
                                        <div class="이름과프로필">
                                            <div class="float-right" id="test-date" style ="margin-right: 10px;">
                                                asd
                                            </div>
                                            <i class="flaticon-profile-1" style = "margin-left : 5px"></i>
                                            <span>유진</span>
                                        </div>
                                        <div class="내용">
                                            <span>유진유진유진유진유진</span>
                                        </div>
                                    </div>
                                    <!-- 댓글 한 칸 end -->
                                    <!-- 댓글 한칸 start -->
                                    <div class = "initiative-comment" style="margin-left : 5px; border-radius : 10px; margin : 5px; border : solid 0.1em; ">
                                        <div class="이름과프로필">
                                            <div class="float-right" style ="margin-right: 10px;">
                                                asd
                                            </div>
                                            <i class="flaticon-profile-1" style = "margin-left : 5px"></i>
                                            <span><?=$_SESSION['emp_no']?></span>
                                        </div>
                                        <div class="내용">
                                            <span>유진유진유진유진유진</span>
                                        </div>
                                    </div>
                                    <!-- 댓글 한 칸 end -->
                                    <!-- 댓글 한칸 start -->
                                    <div class = "initiative-comment" style="margin-left : 5px; border-radius : 10px; margin : 5px; border : solid 0.1em; ">
                                        <div class="이름과프로필">
                                            <div class="float-right" style ="margin-right: 10px;">
                                                asd
                                            </div>
                                            <i class="flaticon-profile-1" style = "margin-left : 5px"></i>
                                            <span><?=$id?></span>
                                        </div>
                                        <div class="내용">
                                            <span>유진유진유진유진유진</span>
                                        </div>
                                    </div>
                                    <!-- 댓글 한 칸 end -->

                                   
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

    
    <script>
        var dt;
        dt = new Date();
        date = dt.getFullYear() + "-";
        if((dt.getMonth() + 1) < 10){
            date += "0" + (dt.getMonth() + 1) + "-";
        }
        else{
            date += (dt.getMonth() + 1) + "-";
        }

        if(dt.getDate() < 10){
            date += "0" + dt.getDate();
        }
        else{
            date += dt.getDate();
        }
        document.getElementById('test-date').innerText = date;

        $("#todo-completed-button").click(function(){
            var element2 = document.getElementById('todo-completed-button');
            element2.style.opacity ="1";
            var element = document.getElementById('todo-uncompleted-button');
            element.style.opacity = "0.5";
        });

        $("#todo-uncompleted-button").click(function(){
            var element2 = document.getElementById('todo-completed-button');
            element2.style.opacity ="0.5";
            var element = document.getElementById('todo-uncompleted-button');
            element.style.opacity = "1";
        });

        $('#todo-view-more-btn').click(function(){
			$("#todo-view-more").toggle();
        });
        
        function setProgress(a){
            var value = "'"+$("#st-btn").text()+"'";
            var id = <?=$id?>;
            var emp_no = <?php echo('"'.$_SESSION['emp_no'].'"');?>;
            if(a == 'x'){
                if(value != '진행'){

                    if(confirm("내용을 변경하시겠습니까?")){
                        console.log(value);
                        console.log(id);
                        console.log(emp_no);
                        //$("#form").submit();
                        //document.location = 'InitiativeController/setProgress?id='+id+'&st=0'+'&emp_no='+emp_no;
                       // document.getElementById('st-btn').innerText = '진행';
                        /*
                        $.ajax({
						url:'/InitiativeController/setProgress',
						type:'get',
						data:{
							progress : "x"
                            id : "<?=$id?>"
						},
						success:function(data){
							//document.getElementById('st-btn').innerText = '진행';
						}
					});
                    */
                    
                    }
                }
                else{
                    //console.log(value);
                }

            }
            
            else if(a == 'o'){
                if(value != '완료'){
                    if(confirm("내용을 변경하시겠습니까?")){
                        console.log(value);
                        console.log(<?=$id?>);
                        //$("#form").submit();
                        document.location = 'InitiativeController/setProgress?id='+id+'&st=7'+'&emp_no='+emp_no;
                        document.getElementById('st-btn').innerText = '완료';
                        /*
                        $.ajax({
						url:'/InitiativeController/setProgress',
						type:'get',
						data:{
							progress : "x"
                            id : "<?=$id?>"
						},
						success:function(data){
							//document.getElementById('st-btn').innerText = '진행';
						}
					});
                    */
                    
                    }
                }
            }
            
        }
        


       
    </script>
