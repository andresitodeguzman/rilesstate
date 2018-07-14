export default {
    name: 'ForumCategory',

    data(){
        return{

            store: this.$root.store,
            communitydata: this.$root.store.communitydata,
            data: this.$root.store.peekdata('forumcategory'),
        }
    },
    methods:{
        navigate(path,data){
            this.store.navigatepath(path,data)
        },
        createForum(){
            this.communitydata.forum.createEntry(this.data.index,this.store.state.account_details.user_id,"Title Title Title","Body body body.")
        }
    },
    template:
    `
    <div>
    Forum Component<br><br>
    <button @click="createForum()">Create forum</button>
    <h1>{{communitydata.forum.forums[data.index].name}}</h1>

    <ul>
        <li v-for="(entry,index) in communitydata.forum.forums[data.index].entries">
            <b>{{entry.title}}</b> by {{entry.userid}} [{{entry.replies.length}} replies]
            <button @click="navigate('forum',{category:data.index,index})">Open</button>
        </li>
    </ul>
    
    </div>
    
    `
}