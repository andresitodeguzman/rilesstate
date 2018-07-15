$(document).ready(()=>{
// do something
});

$("#login").click(()=>{
    var u = $("#username").val();
    var p = $("#password").val();
    console.log(p);

    if(!u){
        M.toast({html:"Username is Required", durationLength:3000});
    } else {
        if(!p) {
            M.toast({html:"Password is Required", durationLength:3000});
        } else {
            $.ajax({
                type:'POST',
                cache:'false',
                url:'/api/v1/Admin/verifyLogin.php',
                data: {
                    username:u,
                    password:p
                },
                success: res=>{
                    if(res.code == 200){                        
                        localStorage.setItem('railtime-session',JSON.stringify(res.session));
                        localStorage.setItem('railtime-session',JSON.stringify(res.admin));
                        localStorage.setItem('railtime-admin-isloggedin',true);
                        window.location.replace('/missioncontrol/');
                    } else {
                        M.toast({html:`Error: ${res.message}`, durationLength:3000});
                    }
                }
            }).fail(err=>{
                if(err.message){
                    M.toast({html:`Error: ${res.message}`, durationLength:3000});
                } else {
                    M.toast({html:"An Error Occurred", durationLength:3000});
                }                
            });
        }
    }
});