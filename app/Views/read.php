<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link rel="stylesheet" href="css/reply.css"> 

<!-- 댓글 불러오기 -->
<div class="container">
			<div class="reply_view">
				<h3 style="padding:10px 0 15px 0; border-bottom: solid 1px gray;">댓글목록</h3>

				<div class="dat_view">
					<div><b></b></div>
					<div class="dap_to comt_edit"></div>
					<div class="rep_me dap_to"></div>
					<div class="rep_me rep_menu">
						<a class="dat_del_btn" href="#">삭제</a>
					</div>
				</div>

	    	</div>
</div>
<!-- 댓글 불러오기 끝 -->

	<!-- 댓글 달기 -->
<div class="dat_ins">
    <input type="hidden" name="bno" class="bno" value=<?=$bno?>>
    <input type="hidden" name="dat_user" id="dat_user" class="dat_user" value=<?=$userid?>>
    <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
    <div style="margin-top:10px;">
        <textarea name="content" class="rep_con" id="rep_con"></textarea>
        <button id="rep_btn" class="rep_btn">댓글</button>
    </div>
</div>

    
</body>
</html>
