export default {
    
    name: 'Home',
    beforeCreate: function(){
        
        var customer = JSON.parse(localStorage.getItem('customer'))
        this.$root.store.state.account_details = customer

    },
    data() {
        return {



            // Store
            store: this.$root.store,

            // App config
            app_config: this.$root.store.state.app_config,

            // Menu visibility
            menu: false,
            ride: false,

            // Managecards
            managecards: false,

            // Ride
            stations : this.$root.store.static.stations,
            from: 0,
            to: 10


        }
    },
    methods:{
        navigatepath(path,data){
            this.store.navigatepath(path,data)
        }
    },
    template: `
    <div class='flex column wide high background-gray' v-bind:style="{'background': app_config.background}">

        <!-- Card container -->
        <div class="wide" style="max-width: 100%; padding: 5rem 1.5rem; height: 95%; overflow-y: scroll; box-sizing: border-box" >
            
        <transition-group name="wipeup" appear>
            <card v-for="(card,index) in store.state.cards" v-bind:key="index" v-bind:type="card.type" v-bind:data="card.data"></card>
            
        </transition-group>
        

        </div>

        <!-- Bottom: Action Bar -->
        <div v-if="!managecards" class="absolute wide bottom white shadow-up flex space-between" style="z-index: 0" >
            <span class="padding" tabindex=0 id="left-menu" @focus="menu = true" @blur="menu = false">
                <span class="lnr lnr-menu" style="font-size: 1.5rem"></span>
            </span>
            <button class="select-shrink flex accent shadow-more bold align-center" v-bind:style="{position: 'relative', top: '-1.7rem', padding: '1rem 2.5rem', 'border-radius': '2rem','background-color':app_config.accent,color: app_config.accent_text}" @click="ride=true;">
            <span class="lnr lnr-train" style="margin-right: 1rem; font-size: 1.3rem"></span>Ride a Train
            </button>
            <span class="padding" @click="navigatepath('community')">
                <span class="lnr lnr-users" style="font-size: 1.5rem"></span>
            </span>
        </div>

        <!-- Top: Assistant -->
        <div class="fixed wide top" v-if="!managecards">
        <span id="header-accent" class="accent wide fixed" v-bind:style="{height:'3rem', top:'0', 'border-radius':'0 0 20% 20%','background-color': app_config.accent}"></span>
            <assistant></assistant>
        </div>

        <!-- Manage Cards -->
        <div id="managecards" class="absolute wide top" v-if="managecards"  >

        <!-- Action bar -->
        <div class="flex accent justify-center space-between" style="width: 100%; padding-top: 0.5rem">
            <button class="padding"  style="background-color: transparent; border: 0; font-size: 1rem; font-weight: bold;"  @click="managecards = false"><span class="lnr lnr-checkmark-circle" style="font-weight: bold; padding-right: 0.5rem"></span>Done</button>
            <button class="padding"  style="background-color: transparent; border: 0; font-size: 1rem; font-weight: bold;" ><span class="lnr lnr-plus-circle padding-small" style="font-weight: bold"></span> Add a Card</button>
        </div>

        
        </div>


        <transition name="fade">
            <div class="wide high fixed top" style="background-color: rgba(0,0,0,0.7);" v-show="menu || ride" @click="ride=false; menu=false"></div>
        </transition>

        <transition name="slideup">        
            <div id="bottom-menu" class="bottom fixed wide white" style="height: 25rem; will-change: transform" v-show="menu">
                <a class="profile " @mousedown="navigatepath('profile')">
                    <img src="custom/img.jpg">
                        <span>
                            <div class="name">{{store.state.account_details.first_name == "" ? store.state.account_details.username : store.state.account_details.first_name}} {{store.state.account_details.last_name}}</div>
                            <span class="email">{{store.state.account_details.email}}</span>
                        </span>
                    <span class="settings">
                        <span class="lnr lnr-cog"></span>
                    </span>
                </a>
                <span class="flex column">
                <span class="menu-item" @mousedown="managecards=true">Manage Cards</span>
                <span class="menu-item">LRT-1 Map</span>
                <span class="menu-item">Shop and Dine</span>
                <span class="menu-item">Exclusive Deals</span>
                <span class="menu-item">Help</span>
                <span class="menu-item">About</span>
                </span>
            </div>
        </transition>



        <!-- Action Pane -->
        <transition name="slideup">
            <div id="action-pane" class="fixed bottom wide flex white" v-show="ride">
                    <!-- Travel selectors (left) -->
                    <span class="travel-selection">
                        <span>
                            <span class="lnr lnr-chevron-down"></span>
                            <select v-model="from">
                                <option v-for="(item,index) in stations" v-bind:value="index">{{item.name}}</option>
                            </select>
                            <label>From Station</label>
                        </span>
                        <br>
                        <hr style="width: 100%" color="#eeeeee" size=1>
                        <span>
                            <span class="lnr lnr-chevron-down"></span>
                            <select v-model="to">
                                <option v-for="(item,index) in stations" v-bind:value="index">{{item.name}}</option>
                            </select>
                            <label>To Station</label>
                        </span>
                    </span>
                    <!-- Travel button (right) -->
                    
                        <label for="action-collapse"  @click="navigatepath('ride',{from,to}); ride=false" class="travelbtn-container" id="travel-button">
                        
                            <span class="lnr lnr-arrow-right" id="travel-button-label"></span>
                        
                        </label>
                    
                </div>
            </transition>


            

        
    
    </div>`
}
