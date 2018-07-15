export default {
    props:['from','to','current'],
    name: 'tracking',
    data() {
        return{

        }
    },
    methods:{
        status: function(station_stop){            
            if(station_stop == this.current)
                return 'active'
            else if((station_stop - this.from) * (station_stop - this.to) <= 0)
                return 'normal'
        }
    },
    template: 
    `
    <div class="tracking" style="width: 100%" >
        
        <div class="flex column padding tracking-stop" v-bind:class="status(index)" v-for="(item,index) in this.$root.store.static.stations">
            <span>{{item.name}}
                <span class="guide" style="font-size: 0.8rem;"><span class="lnr lnr-map-marker"></span></span>
            </span>
            <span class="address">{{item.address}}</span>
        </div>
    </div>
    `
}