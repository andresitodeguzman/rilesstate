export default {
    
    name: 'Seeker',
    props: ['value'],
    data() {
        return {
            
        }
    },
    computed:{
        pin_style: function(){
            return {
                transition: '1s transform',
                'will-change': 'transform',
                transform: 'translateX(calc('+ this.value * 100 +'% - 0.5rem))'
            }
        }
    },
    template: 
    `
    
    <div style="width: 100%">
    <div v-bind:style="pin_style">
    <span class="lnr lnr-map-marker accent-text bold"></span>
    </div>
    <progress id="seekbar" v-bind:value="value"></progress>
    </div>

    `
}