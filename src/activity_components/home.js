export default {
    
    name: 'Home',
    data() {
        return {
            store: this.$root.store,

            // Menu visibility
            menu: false,
            ride: false,

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
    <div class='flex column wide high background-gray'>

        <!-- Card container -->
        <div class="wide" style="max-width: 100%; padding: 5rem 1.5rem; height: 90%; overflow-y: scroll; box-sizing: border-box" >
            
        <transition-group name="wipeup" appear>
            <card v-for="(card,index) in store.state.cards" v-bind:key="index" v-bind:type="card.type" v-bind:data="card.data"></card>
            
        </transition-group>
        

        </div>

        <!-- Bottom: Action Bar -->
        <div class="absolute wide bottom white shadow-up flex space-between" style="z-index: 0" >
            <span class="padding" tabindex=0 id="left-menu" @focus="menu = true" @blur="menu = false">
                <span class="lnr lnr-menu" style="font-size: 1.5rem"></span>
            </span>
            <button class="select-shrink flex accent shadow-more bold align-center" style="position: relative; top: -1.7rem; padding: 1rem 2.5rem; border-radius: 2rem" @click="ride=true; ">
            <span class="lnr lnr-train" style="margin-right: 1rem; font-size: 1.5rem"></span>Ride a Train
            </button>
            <span class="padding" @click="navigatepath('community')">
                <span class="lnr lnr-users" style="font-size: 1.5rem"></span>
            </span>
        </div>

        <!-- Top: Assistant -->
        <div class="fixed wide top">
        <span id="header-accent" class="accent wide fixed" style="height:3rem; top:0; border-radius: 0 0 20% 20%"></span>
            <assistant></assistant>
        </div>


        <transition name="fade">
            <div class="wide high fixed top" style="background-color: rgba(0,0,0,0.7);" v-show="menu || ride" @click="ride=false; menu=false"></div>
        </transition>

        <transition name="slideup">        
            <div id="bottom-menu" class="bottom fixed wide white" style="height: 25rem; will-change: transform" v-show="menu">
                <a class="profile " @mousedown="navigatepath('profile')">
                    <img src="custom/img.jpg">
                        <span>
                            <div class="name">{{store.state.account_details.first_name}} {{store.state.account_details.last_name}}</div>
                            <span class="email">{{store.state.account_details.email}}</span>
                        </span>
                    <span class="settings">
                        <span class="lnr lnr-cog"></span>
                    </span>
                </a>
                <span class="flex column">
                <span class="menu-item">Manage Cards</span>
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
