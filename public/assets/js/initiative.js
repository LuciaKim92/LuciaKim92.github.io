
        function showNotification(str, name){
            //문자를 여기서 지정해주고 이거 두개 실행되게한다.
            $("#"+name).fadeIn(1000);
            $("#"+name+"-content").text(str);
            $("#"+name).fadeOut(1000);
        }
