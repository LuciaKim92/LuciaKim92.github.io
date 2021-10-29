<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>무한스크롤 예제</title>
  <style>
    html, body{ margin: 0; }
    h1 {position: fixed; top: 0; width: 100%; height: 60px; text-align: center; background: white; margin: 0; line-height: 60px;}
    section .box {height: 500px; background: red;}
    section .box p {margin: 0; color: white; padding: 80px 20px;}
    section .box:nth-child(2n) {background: blue;}
  </style>
</head>
<body>         
  <h1>무한스크롤</h1>
  <section>
    <div class="box">
      <p>
        1번째 블록
      </p>
    </div>
    <div class="box">
      <p>
        2번째 블록
      </p>
    </div>
  </section>
  <script>
    var count = 2;
    window.onscroll = function(e) {
      console.log(window.innerHeight , window.scrollY,document.body.offsetHeight)
      if((window.innerHeight + window.scrollY) >= document.body.offsetHeight) { 
        setTimeout(function(){
          var addContent = document.createElement("div");
          addContent.classList.add("box")
          addContent.innerHTML = `<p>${++count}번째 블록</p>`
          document.querySelector('section').appendChild(addContent);
        }, 1000)  
      }
    }
     // 페이지네이션
     $('#demo').pagination({
            let container = $('#pagination');
            dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 50],
            pageSize: 3,
            showPageNumbers: false,
            showNavigator: true,
            callback: function(data, pagination) {
                var data = '<div style="margin-left : 5px; border-radius : 10px; margin : 5px; border : solid 0.1em; ">'+
                                        '<div class="이름과프로필">'+
                                            '<div class="position-absolute top-0 start-0" id="test-date" style ="right: 20px;">'+
                                                'asd'+
                                            '</div>'+
                                            '<i class="flaticon-profile-1" style = "margin-left : 5px"></i>'+
                                            '<span>유진</span>'+
                                        '</div>'+
                                        '<div class="내용">'+
                                            '<span>dasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasasas</span>'+
                                        '</div>'+
                                    '</div>';
                var dataHtml = "";
                for(int i = 0 ; i < 20 ; i++){
                    dataHtml += data
                }
                /*
                $.each(data, function (index, item) {
                    dataHtml += '<li>' + item.name + '</li>';
                });
                */


                $("#data-container").html(dataHtml);
            }
        })

        var count = 2;
        window.onscroll = function(e) {
            console.log(window.innerHeight , window.scrollY,document.body.offsetHeight)
            if((window.innerHeight + window.scrollY) >= document.body.offsetHeight) { 
                setTimeout(function(){
                var addContent = document.createElement("div");
                addContent.classList.add("box")
                addContent.innerHTML = `<p>${++count}번째 블록</p>`
                document.querySelector('section').appendChild(addContent);
                }, 1000)  
            }
        }
  </script>
</body>
</html>