export default {
    
    name: 'Community',
        data() {
            return {
                store: this.$root.store,
                selected: 'Chatrooms'
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
        <div id="community" class="background-gray wide high">
        
        <!-- CHATROOM -->
        <transition name="wipeup2" appear>
        <div v-if="selected=='Chatrooms'" class="fixed top wide" style="padding: 1rem; margin-top: 3.5rem">
            <div class="select-shrink white padding shadow wide list-item flex align-center" v-for="(item,index) in store.communitydata.chat.chatrooms" style="border-radius: 0.25rem; margin-bottom: 1rem">
                <span>
                    <img src="custom/img.jpg" style="width: 3rem; border-radius: 50%">
                    <span class="online"></span>
                </span>
                <span style="padding-left: 1rem">
                    <div class="name">{{item.name}}</div>
                    <span class="last">last message here</span>
                </span>
                <span class="enter" style="flex-grow: 1; text-align: right">
                    <span class="lnr lnr-enter"></span>
                </span>
            </div>
        </div>
        </transition>

        <!-- Forums -->
        <transition name="wipeup2" appear>
            <div v-if="selected=='Forums'" class="fixed top wide" style="padding: 1rem; margin-top: 3.5rem">
                <div class="select-shrink white padding shadow wide list-item flex align-center" v-for="(item,index) in store.communitydata.forum.forums" style="border-radius: 0.25rem; margin-bottom: 1rem">
                    
                    <span style="padding-left: 1rem">
                        <div class="name bold">{{item.name}}</div>
                        <span class="last">last message here</span>
                    </span>
                    <span class="enter" style="flex-grow: 1; text-align: right">
                        
                    </span>
                </div>
            </div>
        </transition>

        <!--Leaderboard-->
        <transition name="wipeup2" appear>
            <div v-if="selected=='Leaderboard'" class="fixed top wide" style="padding: 1rem; margin-top: 3.5rem">
                <div class="select-shrink white padding shadow wide list-item flex align-center" v-for="(item,index) in store.communitydata.leaderboard.users" style="border-radius: 0.25rem; margin-bottom: 1rem">
                    <span>
                        <img src="custom/img.jpg" style="width: 3rem; border-radius: 50%">
                        <span class="online"></span>
                    </span>
                    <span style="padding-left: 1rem">
                        <div class="name">User{{item.userid}}</div>
                        <span class="last">Points: {{item.points}}</span>
                    </span>
                </div>
            </div>
        </transition>


            <!-- TOP -->
            <div class="fixed top wide flex accent space-between shadow" style="z-index: 2">
                <span class="lnr lnr-chevron-left padding-medium"></span>
                <span class="padding-medium">{{selected}}</span>
                <span class="lnr lnr-cross padding-medium" style="transform: rotate(45deg)" @click="createchatroom('Wavers')"></span>
            </div>
    
            <!-- Bottom -->
            <div class="wide white fixed bottom shadow-up flex space-around">
                <span class="lnr lnr-bubble padding bold" v-bind:style="{color: selected == 'Chatrooms' ? '#ffc000' : 'gray'}" @click="selected='Chatrooms'"></span>
                <span class="lnr lnr-graduation-hat padding bold" v-bind:style="{color: selected == 'Forums' ? '#ffc000' : 'gray'}" @click="selected='Forums'"></span>
                <span class="lnr lnr-star padding bold" v-bind:style="{color: selected == 'Leaderboard' ? '#ffc000' : 'gray'}" @click="selected='Leaderboard'"></span>
                <span class="lnr lnr-user padding bold" v-bind:style="{color: selected == 'Profile' ? '#ffc000' : 'gray'}" @click="navigate('profile')"></span>
            </div>

            
            

        </div>
        `
    }


    /*
    
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
    
    
    */