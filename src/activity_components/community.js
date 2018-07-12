export default {
    
    name: 'Community',
        data() {
            return {
                store: this.$root.store,
            }
        },
        methods:{
            navigate(path,data){
                this.store.navigatepath(path,data)
            },
            createchatroom(name){
                this.store.communitydata.chat.createchatroom(name)
            }
        }
        ,
        template: `
        <div>
            <ul style="list-style-type:none; padding-left:0">
                <li class="padding accent">Discussion (chat,forums)</li>
                <h4 class="padding">Chat</h4>
                <button @click="createchatroom('Wavers')" >Create chat room</button>
                    <ul>
                        <li v-for="(item,index) in store.communitydata.chat.chatrooms">{{item.name}} -> {{index}} <button @click="navigate('chatroom',{index})">Open</button></li>
                        
                    </ul>
                <h4 class="padding">Forums</h4>
                    <ul>
                    <li v-for="(item,index) in store.communitydata.forum.forums">{{item.name}} -> {{index}} <button @click="navigate('forumcategory',{index})">Open</button></li>
                    </ul><br>
                <li class="padding accent">Leaderboard</li>
                <h4 class="padding">Top 15</h4>
                    <ol>
                        <li v-for="(item,index) in store.communitydata.leaderboard.users">
                            User: {{item.userid}} Points: {{item.points}}
                        </li>
                    </ol><br>
                <li class="padding accent">Profile</li>
                <h4 class="padding">{{store.state.account_details.username}}</h4>
            </ul>
        
        </div>
        `
    }
