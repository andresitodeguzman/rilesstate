export default {
    
    name: 'Announcements',
    props: ['data'],
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