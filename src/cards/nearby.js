export default {
    
    name: 'Nearby',
    props: ['data'],
    data() {
        return {
            
        }
    },
    template:
    `
    <div class="places">
            <span class="items">
            <span class="item" v-for="item in data.list">
                <img src="custom/img.jpg">
                <span class="name">{{item.name}}</span>
                <span class="location">{{item.location}}</span>
            </span>
        </span>
    </div>
    
    `
}