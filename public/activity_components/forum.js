export default {

    name: 'Forum',
    data(){
        return{

            store: this.$root.store,
            communitydata: this.$root.store.communitydata,
            data: this.$root.store.peekdata('forum'),
        }
    },
    methods:{
        navigate(path,data){
            this.store.navigatepath(path,data)
        },
    },
    template:
    `
    <div>
    Forum Component<br><br>
    <h1>{{communitydata.forum.forums[data.category].entries[data.index].title}}</h1>
    <span>{{communitydata.forum.forums[data.category].entries[data.index].body}}</span>

    <ul>
    <li v-for="item in communitydata.forum.forums[data.category].entries[data.index].replies">
        {{item.userid}}: {{item.reply}}
    </li>
    </ul>

    </div>

    
    
    `
}