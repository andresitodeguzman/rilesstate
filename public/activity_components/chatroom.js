export default {
    name: 'Chatroom',
    data(){
        return{
            store: this.$root.store,
            communitydata: this.$root.store.communitydata,
            data: this.$root.store.peekdata('chatroom'),
            id: this.$root.store.peekdata('chatroom').index,
            currenttext: ""
        }
    },
    methods:{
        // Push a sample message
        pushmymessage(){

            //Should call backend code, not this
            this.communitydata.chat.pushmessage(this.id, this.store.state.account_details.username, this.currenttext, 'today, 5pm')

            // if success
            this.currenttext = ""
        }
        
    },
    computed: {

        //Chatroom name
        name: function(){
            return this.communitydata.chat.chatrooms[this.id].name
        },
        messages: function(){
            return this.communitydata.chat.chatrooms[this.id].messages
        }



    },
    // template:`
    // <div>
    //     <h4>{{name}}</h4>

    //     <div v-for="message in messages">
    //     {{message.userid}} : {{message.message}} ({{message.date}})
    //     </div>

    //     <button @click="pushmymessage()">Push my message</button>

    // </div>`
    template:
    `
    <div class="wide high background-gray flex column">
    
    <!-- -->
    <div class="fixed top wide flex accent space-between shadow" style="z-index: 2">
    <span class="lnr lnr-chevron-left padding-medium"></span>
    <span class="padding-medium">{{name}}</span>
    <span class="lnr lnr-menu padding-medium"></span>
    </div>

    <!-- -->
    <div class="wide high column flex" style="margin-top: 3rem; padding-top: 1rem; padding-bottom: 2rem; overflow-y: scroll; overflow-x: hidden;max-width: 100%">
        <span>
        <div class="message flex" v-for="(message,index) in messages" v-bind:key="index" v-bind:class="message.userid == store.state.account_details.username ? 'self' : ''">
            <img src="custom/img.jpg" style="min-width: 3rem">

            <span class="detail">
                
                    <span class="username">{{message.userid}}</span>

                    <span class="time">{{message.date}}</span>
               
            </span>
            
            <span class="body">
                {{message.message}}
            </span>

            
        </div>
        </span>

    </div>
    
    <div class="white shadow-up flex" id="chatinput" style="line-height: 0; z-index: 2;">
        <button class="padding white"><span class="lnr lnr-plus-circle"></span></button>
        <input type="text" placeholder="Message.." v-model="currenttext" @keypress="currenttext = $event.target.value" @input="currenttext = $event.target.value" @keyup.enter="pushmymessage()"></input>
        <button v-bind:disabled="currenttext==''" id="send" class="padding accent" @click="pushmymessage()"><span class="lnr lnr-arrow-right"></span></button></div>
    </div>

    
    `

}