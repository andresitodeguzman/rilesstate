export default {
    
    name: 'Weather',
    props: ['data'],
    data() {
        return {
            
        }
    },
    template:
    `
    <div class="flex column align-center">
        <div class="flex space-between align-center wide">
            <div class="flex align-center">
                <weathericon v-bind:type="data.forecasts[0].forecast"></weathericon>
                <span style="position: relative; left: -1rem">SUNNY</span>
            </div>
            <div style="font-size: 4rem; color: #444444" >
                {{data.forecasts[0].temperature}}°
            </div>
        </div>
         
        <div class="flex space-evenly wide align-center justify-center"  style="transform: translateY(0.75rem);">
            <span class="sub-item flex column align-center" v-for="n in 4">
                <span class="small-detail" style="color: #777777">MON {{data.forecasts[n].temperature}}°</span>
                <weathericon size='small' v-bind:type="data.forecasts[n].forecast"></weathericon>
            </span>
            
            
        </div>
    
        
    </div>
    
    `
    
        // <ul>
        //     <li v-for="item in 5">{{data.forecasts[item-1].temperature}} ({{data.forecasts[item-1].forecast}})</li>
        // </ul>

}