export default {
    
    name: 'Announcements',
    props: ['data'],
    // created(){

    //     $.ajax({
    //         type: 'GET',
    //         url: "api/v1/Announcement/getAll.php",
    //         cache: 'false',
    //         success: result => {
                
    //             console.log(result)
            
    //     }}).fail((err)=>{
    //             console.log(err)
    //     });

    // },
    data() {
        return {
            
        }
    },
    template:
    `
    <div>
        
        <div class="announcement-item" v-bind:class="item.type" v-for="item in data.list">
            <div style="font-size: 0.7rem; color: #aaaaaa">{{item.date}}</div>
            {{item.body}}
        </div>
        
    </div>
    
    `

}