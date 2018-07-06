let railtime = {};

railtime.customer = new Customer();
railtime.session = new Session();
railtime.station = new Station();

$(document).ready(()=>{
    clear();
    showActivity('login');
});

var clear = ()=>{
    $(".activity").hide();
};

var showActivity = (name)=>{
    $(`#${name}Activity`).fadeIn();
};

var login = ()=>{
    var username = $("#usernameInput").val();
    var password = $("#passwordInput").val();

    if(!username){
        alert("Username is Required");
    } else {
        if(!password){
            alert("Password is Required");
        } else {
            railtime.customer.verifyLogin(username,password)
                .then(res=>{
                    if(res.session){
                        localStorage.setItem("session_id",res.session);
                        localStorage.setItem("customer_info",JSON.stringify(res.customer));
                        var c = res.customer;
                        $("#name").html(`${c.first_name} ${c.last_name}`);
                        
                        getStations();

                    } else {
                        alert(res.message);
                    }
                })
                .catch(err=>alert(err));
        }
    }
}

var getStations = ()=>{
    var session_id = localStorage.getItem("session_id");
    railtime.station.getAll(session_id)
        .then(res=>{
            $("#stationList").html("");
            $.each(res,(index,st)=>{
                var tpl = `
                    <li>
                        <h5>${st.name}</h5>
                        <p>City: ${st.city}</p>
                    </li>
                `;
                $("#stationList").append(tpl);
                clear();
                showActivity("main");
            });
        })
        .catch(err=>alert(err));
}