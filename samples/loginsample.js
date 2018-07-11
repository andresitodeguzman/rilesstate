/**
 * How to handle promises (JS)
 * 
 *  Promise.then((data)=>{ //do something with data }).catch((err)=>{//do something w/ error });
 * 
 */
// Sample LOGIN Script

importScripts("../lib/Customer.js");

var __customer = new Customer();

var loginButton = document.getElementById("loginButton");

// Create a button event listener
loginButton.addEventListener("click",()=>{

    // Get form values
    var uname = document.getElementById("username").value;
    var pw = document.getElementById("password").value;

    // Check if empty
    if(!uname){
        alert("Username is Required");
    } else {
        if(!pw){
            alert("Password is Required");
        } else {

            // Send info to db
            __customer.verifyLogin(uname,pw)
                // Chain with then to recieve result of the fulfilled promise 
                .then((res)=>{
                    if(res.code == 200){
                        var session_id = res.session_id;
                        var customer = res.customer;

                        // Save to localstorage for persistence
                        localStorage.setItem("railtime_session_id", session_id);
                        localStorage.setItem("railtime_customer",JSON.stringify(customer));

                        // Do other tasks (ex: set views)

                    } else {
                        alert(`Login Error: ${res.message}`);
                    }
                })
                // Chain with catch to get network error probs
                // Remember, this will not catch server errors but network and code errors only!
                .catch((err)=>{
                    alert("Cannot log you in, are you offline?");
                });

        }
    }
});

// Para maging synch
importScripts("../lib/Station.js");

let __station = new Station();

var getStations = ()=>{
    
    var session_id = localStorage.getItem("session_id");

    __station.getAll(session_id)
        .then((res)=>{
            localStorage.setItem("railtime_stations",JSON.stringify(res));
        })
        .catch((err)=>{
            console.log("Error getting stations");
        })
}

getStations();

var __stations = JSON.parse(localStorage.getItem("railtime_stations"));

//use stations var synchronously
__stations.forEach(element => {
    console.log(element);
});