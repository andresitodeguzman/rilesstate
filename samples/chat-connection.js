// Try to use wss protocol instead of ws
var __chatcon = new WebSocket("ws://localhost:8080");

__chatcon.open = (e)=>{
    console.log("Connected to community chat realtime server");
};

__chatcon.onmessage = (e)=>{
    console.log(JSON.parse(e.data));
}

var sendChatMessage = (session_id,chatroom_id,message)=>{
    var data = {
        "session_id":session_id,
        "chatroom_id":chatroom_id,
        "message":message
    };
    __chatcon.send(JSON.stringify(data));
}