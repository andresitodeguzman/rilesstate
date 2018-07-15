var clear = ()=>{
    $(".activity").hide();
};

var showActivity = (activity)=>{
    clear();
    $(`#${activity}Activity`).show();
};

var init = ()=>{
    if(isLoggedIn() == "false") {
        window.location.replace("/missioncontrol/auth.php");
    }
    showActivity("main");
};

var isLoggedIn = ()=>{
    if(localStorage.getItem("railtime-admin-isloggedin")){
      var login =  localStorage.getItem("railtime-admin-isloggedin");
      if(login == "true"){
        return "true";
      } else {
        return "false";
      }
    } else {
        return "false";
    }
};

$(document).ready(()=>{
    clear();
    init();
});