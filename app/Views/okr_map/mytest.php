<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- 합쳐지고 최소화된 최신 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- 부가적인 테마 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

    <!-- 합쳐지고 최소화된 최신 자바스크립트 -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <?php echo view("/layout/header"); ?>

    <style>

        .keyresult-content-div{
            border: solid 3px; 
            border-color : #B9D49E; 
            border-radius: 40px; 
            margin-left : 5px; 
            overflow : visible; 
            height : auto;
            display: block; 
            padding:10px;
        }

        .mybadge{
            width:25px; height:25px;
            color:white;
            font-size: 1.20em;
            font-weight: bold;
            margin-right: 2px;
        }

        .mytext{
            font-weight: bold;
            text-decoration: underline;
            
        }

        .init-badge-span{
            margin: 15px;
        }

        .emp_nm{
            color: gray;
            font: 1.4em "Fira Sans", sans-serif;
            font-weight: bold;
            margin:15px;
            text-decoration: underline;
        }

        .dash-kr-ol{
            list-style-type: none;
            font-weight: bold;
            color:black;
        }
        
        .dash-kr-ol li{
            margin: 15px 0px;
        }

        .dash-kr-ol span{
            display: inline-block;
        }

        .span-kr{
            text-align:center;
            background-color: skyblue;
            color:white;
            padding: 4px;
            margin-right:5px;
            width:35px;
        }
    
    </style>

    <title>Document</title>
</head>

<body>
 
    <div class="col-xl-4">
        <div class="m-widget24">
            <div class="m-widget24__item">
                <div class = "keyresult-bar" style="font-weight: bold; color : black; background-color: #B9D49E; margin-right : 5px; margin-left : 5px; height:40px; padding:5px">
                    <h2 class = "text-center text-white" style="vertical-align: middle;">
                        Initiative
                    </h2>
                </div>

                <div style="width:auto;">
                    <div id = "company-kr-div-1" class ="keyresult-content-div">
                        <div class = "text-center okr-badge-div">
                            
                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:skyblue !important">3</span><span class="mytext" style="color:skyblue">진행</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:green !important">2</span><span class="mytext" style="color:green">완료</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:orange !important">2</span><span class="mytext" style="color:orange">펀넬</span>
                            </span>
                   
                        
                        </div>
                        <div class="emp_nm"><ul style="padding-left:15px"><li>고지훈</li></ul></div>
                        <ol class="dash-kr-ol">
                            <li><span class="span-kr">KR 1</span>1. 이니셔1</li>
                            <li><span class="span-kr">KR 2</span>2. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                        </ol> 
                    </div> 

                    <div id = "company-kr-div-1" class ="keyresult-content-div">
                        <div class = "text-center okr-badge-div">
                            
                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:skyblue !important">3</span><span class="mytext" style="color:skyblue">진행</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:green !important">2</span><span class="mytext" style="color:green">완료</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:orange !important">2</span><span class="mytext" style="color:orange">펀넬</span>
                            </span>
                   
                        
                        </div>
                        <div class="emp_nm"><ul style="padding-left:15px"><li>고지훈</li></ul></div>
                        <ol class="dash-kr-ol">
                            <li><span class="span-kr">KR 1</span>1. 이니셔1</li>
                            <li><span class="span-kr">KR 2</span>2. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                        </ol> 
                    </div> 

                    <div id = "company-kr-div-1" class ="keyresult-content-div">
                        <div class = "text-center okr-badge-div">
                            
                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:skyblue !important">3</span><span class="mytext" style="color:skyblue">진행</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:green !important">2</span><span class="mytext" style="color:green">완료</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:orange !important">2</span><span class="mytext" style="color:orange">펀넬</span>
                            </span>
                   
                        
                        </div>
                        <div class="emp_nm"><ul style="padding-left:15px"><li>고지훈</li></ul></div>
                        <ol class="dash-kr-ol">
                            <li><span class="span-kr">KR 1</span>1. 이니셔1</li>
                            <li><span class="span-kr">KR 2</span>2. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                        </ol> 
                    </div> 

                    <div id = "company-kr-div-1" class ="keyresult-content-div">
                        <div class = "text-center okr-badge-div">
                            
                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:skyblue !important">3</span><span class="mytext" style="color:skyblue">진행</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:green !important">2</span><span class="mytext" style="color:green">완료</span>
                            </span>

                            <span class="init-badge-span">
                                <span class="m-type m--bg-brand mybadge" style="background-color:orange !important">2</span><span class="mytext" style="color:orange">펀넬</span>
                            </span>
                   
                        
                        </div>
                        <div class="emp_nm"><ul style="padding-left:15px"><li>고지훈</li></ul></div>
                        <ol class="dash-kr-ol">
                            <li><span class="span-kr">KR 1</span>1. 이니셔1</li>
                            <li><span class="span-kr">KR 2</span>2. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                            <li><span class="span-kr">KR 3</span>3. 이니셔1</li>
                        </ol> 
                    </div> 

                </div>

            <div>

        </div>
    </div>

    
</body>

</html>