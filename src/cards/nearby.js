export default {
    
    name: 'Nearby',
    props: ['data'],
    data() {
        
        return {
            store: this.$root.store
        }
    },
    methods:{
        getdata(){

            
        }
    },
    template:
    `
    <div class="places">
            <span class="items">
            <span class="item" v-for="item in data.list">
                <img v-bind:src="item.img">
                <span class="name">{{item.name}}</span>
                <span class="location">{{item.location}}</span>
            </span>
        </span>
    </div>
    
    `
}