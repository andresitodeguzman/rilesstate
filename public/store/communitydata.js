export default {    

    // Chat Properties and Methods
    chat: {

        // List of Chatrooms
        chatrooms: [{
            name: "Public Chat",
            messages: [
            {
                userid: 'user1',
                message: 'Hello this is my message',
                date: 'Today, 3pm'
            },
            {

                userid: 'user2',
                message: 'Hello this is my new message',
                date: 'Today, 3:04pm'
            }]
        }],

        // Create a new Chatroom
        createchatroom(name){

            // should add (If backendfunction(arguments) then render script)
            this.chatrooms.push({name: name, messages: []})
        },

        // Push a message to a chat (should be for reading!)
        pullmessage(chatroomid, userid, message, date){
            
            
            this.chatrooms[chatroomid].messages.push(
               {userid, message, date}
            )

        },

        // Push a message to a chat (should be for reading!)
        pushmessage(chatroomid, userid, message, date){
            
            // backendcode here
            
            //Remove this on backend code.
            if(true)
            this.pullmessage(chatroomid,userid,message,date)

        }
    },
    forum:{
        forums:[
            {
                name: "First Forum",
                userid: "admin",
                entries:[
                    {
                        title: "First Post",
                        body: "This is my forum post. Yeah.",
                        userid: "admin",
                        replies:[
                                {
                                    userid: "user",
                                    reply: "This is my reply",
                                },
                                {
                                    userid: "user2",
                                    reply: "This is my another reply",
                                }
                    ]
                    }
                ]
            }
        ],
        createEntry(forumid,userid,title,body){

            // Write to database() then read then return true
            this.forums[forumid].entries.push({
                name: forumid,
                userid: userid,
                title: title,
                body: body,
                replies: []
            })


        }

        
    },
    leaderboard:{
        users:[
            {
                name: 'User1',
                userid: 1,
                points: 10
            },
            {
                name: 'User2',
                userid: 2,
                points: 5
            },
            {
                name: 'User3',
                userid: 3,
                points: 4
            },
    ]
    }
    

}