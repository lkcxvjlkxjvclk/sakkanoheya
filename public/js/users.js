// This is a JavaScript file


/**********************************
 * 로그인 하기
 * **********************************/
 window.loginClick = function(){
     var idFocus = document.getElementById("username");
     var pwFocus = document.getElementById("password");
      var idValue = idFocus.value;
      var pwValue = pwFocus.value;
      if(idValue == ""){
        alert("아이디를 입력하세요..!!");
        idFocus.focus();
        return ;
      }else if(pwValue == ""){
        alert("비밀번호를 입력하세요..!!");
        pwFocus.focus();
        return;
      }else if(idValue != "" && pwValue != ""){
      $.ajax({
                 type:"get",
                 url: "http://150.95.130.43/get_novel/userInfo",
                 data:{
                     id : idValue,
                     pw : pwValue
                 },
                 success: function(msg){
                     if(msg == 1){
                    alert("로그인 완료");
                    document.getElementById("loginBtn").style.display = "none";
                    document.getElementById("joinBtn").style.display = "none";
                    document.getElementById("logoutBtn").style.display = "";
                    myNavigator.popPage();
                     }else{
                    alert("아이디와 비밀번호를 확인해 주세요");
                     }
                 }
         })
      }      
 }
 /**********************************
 * 로그아웃 하기
 * **********************************/   
 window.logoutClick = function(){
    alert("로그아웃 되었습니다.");
    document.getElementById("loginBtn").style.display = "";
    document.getElementById("joinBtn").style.display = "";
    document.getElementById("logoutBtn").style.display = "none";
    menuClose();
 }
 
 /**********************************
 * 회원가입 정보 입력
 * **********************************/
 window.JoinClick = function(){
     var idFocus = document.getElementById("idJoin");
     var nickFocus = document.getElementById("nickJoin");
     var pwFocus = document.getElementById("pwJoin");
     var pwFocusRe = document.getElementById("pwJoinRe");
     var emailFocus = document.getElementById("emailJoin");
     var idJoin = idFocus.value;
     var nickJoin = nickFocus.value;
     var pwJoin = pwFocus.value;
     var pwJoinRe = pwFocusRe.value;
     var emailJoin = emailFocus.value;
     var regEmail = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     if(idJoin == ""){
        alert("아이디를 입력하세요..!!");
        idFocus.focus();
        return ;
      }else if(nickJoin == ""){
        alert("닉네임을 입력하세요..!!");    
        nickFocus.focus();
      }else if(pwJoin == ""){
        alert("비밀번호를 입력하세요..!!");
        pwFocus.focus();
        return;
      }else if(pwJoinRe == ""){
        alert("비밀번호 확인을 입력하세요..!!");
        pwFocusRe.focus();
        return;
      }else if(emailJoin == ""){
        alert("이메일을 입력하세요..!!");
        emailFocus.focus();
        return;
      }else if(!regEmail.test(emailJoin)){
        alert("이메일 주소를 똑바로 입력해 주세요..!!");
        emailFocus.focus();
        return;
      }else if(pwJoin != pwJoinRe){
        alert("패스워드가 서로 일치하지 않습니다.");
        pwFocusRe.focus();
        return;
      }else{
          $.ajax({
              type:"get",
              url: "http://150.95.130.43/get_novel/idCheck",
              data: { id : idJoin },
              success: function(msg){
                  if(msg == 1){
                      alert("이미 있는 아이디 입니다.");
                      idFocus.focus();
                      return;
                  }else if(idJoin != "" && nickJoin != "" && pwJoin != "" && pwJoinRe != "" && emailJoin != ""){
                    var joinInfo = {"user_id" : idJoin, "nickname" : nickJoin, "email" : emailJoin, "user_pw" : pwJoin};
                    $.ajax({
                      type: "get",
                       url: "http://150.95.130.43/get_novel/writeJoin",
                         data: joinInfo,
                         success: function(data){
                             alert('가입되었습니다.');
                             myNavigator.pushPage('login.html');
                         },
                         error : function(jqXHR, textStatus, errorThrown){
                             alert("가입되지 않았습니다."+ textStatus + " : " + errorThrown);
                             
                        }
                    })
                  }
              }
          })
      }  
 }
 
 /**********************************
 * id 찾기
 * **********************************/    
    window.idSearch = function(){
        var emailFocus = document.getElementById("idSearchEmailInput");
        var emailJoin = emailFocus.value;
        var regEmail = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if(emailJoin == ""){
            alert("이메일을 입력하세요..!!");
            emailFocus.focus();
            return;
        }else if(!regEmail.test(emailJoin)){
            alert("이메일 주소를 똑바로 입력해 주세요..!!");
            emailFocus.focus();
            return;
        }else{
            $.ajax({
                type : "get",
                url : "http://150.95.130.43/get_novel/idSearch",
                data : {
                    email : emailJoin  
                },
                success: function(data){
                    alert("해당 이메일주소의 아이디는 "+ data[0].user_id + "입니다.");
                },
                error : function(jqXHR, textStatus, errorThrown){
                    alert("해당 이메일의 아이디를 찾지 못했습니다."+ textStatus + " : " + errorThrown);
                }
            })
        }
    }