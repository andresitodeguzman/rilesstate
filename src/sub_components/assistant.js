export default {
    
    name: 'Assistant',
    data() {
        return {
            store: this.$root.store,
            focused: false,
            suggestions: [''],
            stations: this.$root.store.static.stations,
            query: ""
            
        }
    },
    computed:{
        lowercased_query: function(){
            return this.query.toLowerCase()
        },
    },
    template:
    
    `
    <div class="wide high" style="z-index: 2">
        <!-- Backdrop -->
        <transition name="fade">
            <div class="wide high fixed top" style="background-color: rgba(0,0,0,0.7);" v-show="focused"></div>
        </transition>

        <!-- Assistant -->
        <div id="assistant" class="wide white fixed shadow-more flex space-between align-center">
            <span class="lnr lnr-magnifier absolute" style="margin-left: 1.5rem"></span>    
            <input type="text" class="wide relative transparent" style="padding: 1rem 3.5rem; font-size: 1rem;" placeholder="Look for places.." @focus="focused = true" @blur="focused = false"
            @keypress="query = $event.target.value" @input="query = $event.target.value">    
        </div>
        
        <!-- Suggestions -->
        <div class="fixed margin" style="width: calc(100% - 2rem);overflow: hidden; border-radius: 1rem; top: 5rem; z-index: 1">
            <!-- Built in suggestion list-->
            <div class="padding-x-large white padding flex"  v-for="item in suggestions" v-if="item.includes(' '+lowercased_query) && lowercased_query.length > 1 || item.startsWith(lowercased_query) && lowercased_query.length > 0"><span class="lnr lnr-train" style="vertical-align: middle; margin-right: 1rem"></span>{{item}}</div>
          
            <!-- Station Info-->
            <div class="padding-x-large white padding flex" v-for="item in stations"  v-if="item.name.toLowerCase().includes(' '+lowercased_query) && lowercased_query.length > 1 || item.name.toLowerCase().startsWith(lowercased_query) && lowercased_query.length > 0"><span class="lnr lnr-train" style="vertical-align: middle; margin-right: 1rem"></span>{{item.name}} Station Info</div>
            <div class="padding-x-large white padding flex" v-for="item in stations"  v-if="item.name.toLowerCase().includes(' '+lowercased_query) && lowercased_query.length > 2 || item.name.toLowerCase().startsWith(lowercased_query) && lowercased_query.length > 2"><span class="lnr lnr-map-marker" style="vertical-align: middle; margin-right: 1rem"></span>Places near {{item.name}}</div>

            <!-- Google Maps query-->
            <div class="padding-x-large white padding flex" v-show="query.length > 0"><span class="lnr lnr-map" style="vertical-align: middle; margin-right: 1rem"></span><span>Search for <b>{{query}}</b> in Google Maps</span></div>        
        </div>

    </div>
    `
}