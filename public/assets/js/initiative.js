
        function showNotification(str){
            //문자를 여기서 지정해주고 이거 두개 실행되게한다.
            $("#init-custom-alert").fadeIn(1000);
            $("#init-custom-alert-content").text(str);
            $("#init-custom-alert").fadeOut(1000);
        }