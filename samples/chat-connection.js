/**
 * RailTime
 * 2018
 * 
 * Samples
 * chat-connection
 */

// Try to use wss protocol instead of ws
var __rt = new WebSocket("ws://localhost:9000");

__rt.open = (e)=>{
    console.log("Connected to RailTime realtime server");
}

__rt.onmessage = (e)=>{
    data = e.data;
    if(data.type == "community-chat"){
        //communityChat.handleMessage(data);
    }
}

__rt.onclose = (e)=>{
    console.log("Disconnected to Railtime realtime server");
}

var sendChatMessage = (session_id,chatroom_id,customer_id,body)=>{
    var data = {
        session_id:session_id,
        type:"community-chat",
        ChatMessage:{
            chatroom_id:chatroom_id,
            customer_id:customer_id,
            body:body
        }
    };
    __rt.send(JSON.stringify(data));
}

