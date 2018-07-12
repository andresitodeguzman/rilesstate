export default {
    
    name: 'Ride',
        data() {
            return{
                store: this.$root.store,
                static: this.$root.store.static,
                data: this.$root.store.peekdata('ride'),
                
                

                // User Ride Info
                location: {x:"",y:""},
                current: -1, // Should be from a external function
                movingstate: '',
                

                // Message
                title: "Good day,",
                subtitle: "Please wait while we update your location...",
                survey: false

            }
        },
        watch:{
            located: function(){
                if(this.located){
                    this.update("Great!","Your location has been updated")
                }
            },
            movingstate: function(){
                if(this.movingstate == 'moving')
                    this.update("You're now leaving "+ this.current_station,"Next station is " + this.next_station)
            },
            current: function(){
                if(this.current == this.data.from){
                    this.update("You're waiting","Random tip here when the user is waiting for a train")
                }
                else if(this.current == this.data.to){
                    this.update("You are now at " + this.current_station,"You may exit the train. Please check your belongings.")
                }
                else{
                    
                    this.update("You're now at " + this.current_station, (this.data.to - this.current) +  " more stations to your destination")
                    }
            },

            survey: function(){
                if(this.survey){
                    this.update("Heya,", "Was it crowded in the previous station?")
                }
                else{
                    this.update("Done", "Thanks for your response.")
                }
            }

        },
        computed: {
            located: function(){
                return (this.location.x != '' && this.location.y != '' )
            },
            current_station: function(){
                if(this.current<0)
                    return "Error reading current station"
                return this.static.stations[this.current].name
            },
            next_station: function(){
                return this.static.stations[this.current + 1].name
            }
        },
        methods:{
            update: function(title,subtitle){
                this.title = title
                this.subtitle = subtitle
                
            }
        },
        template:
        
        `
        <div class="fixed wide high flex column align-center" style="box-sizing: border-box; overflow: scroll">
        
            <!-- TOP -->

            <div class="wide flex space-between" style="z-index: 2; min-height: 3.5rem">
            <span class="lnr lnr-chevron-left padding-medium"></span>
            <span class="padding-medium">{{static.stations[data.from].name}}<span class="lnr lnr-arrow-right margin-small"></span>{{static.stations[data.to].name}}</span>
            <span class="lnr lnr-menu padding-medium"></span>
            </div>

            <!-- ASSISTANT -->

            <div class="margin-large-y" style="max-width: 80%; height: 7rem">
                <transition name="wipeup" mode="out-in" appear>
                <div class="bold" style="font-size: 1.75rem ;max-width: 100%" :key="title">{{title}}</div>
                </transition>
                <transition name="wipeup2" appear mode="out-in">
                <div class="wide-vw margin-y" style="line-height: 1.5rem; max-width: 100%" :key="subtitle">{{subtitle}}</div>
                </transition>
                <transition name="wipeup2" appear mode="out-in">
                <div id="survey-div" v-if="survey" @click="survey=false"><button>Yes</button><button>No</button></div>
                </transition>
            </div>

            <!-- LOCATION LOADER -->

            <transition name="wipeup" appear>
                <div class="wide margin-large-y high flex justify-center align-center center text-align-center" style="box-sizing:border-box; position: relative" v-if="location.x == '' || location.y == ''">
                    
                        <span class="lnr lnr-map-marker large-text" style="position:relative" >
                        <div id="initial-loader">     
                        </div>

                        </span>
                </div>
            </transition>

            <!-- GRAPHIC GUIDES -->

            <transition name="wipeup2">
            <div style="width: 70%; min-height: 10rem; line-height: 0; margin-bottom: 3rem" class="flex space-between" v-if="current>=0">
                <div class="flex column white space-around">
                    
                    <span class="lnr lnr-clock light-gray-text" style="font-size: 4rem"></span>
                    <span>Est. Time Left</span>
                    <span class="medium-text bold">10 mins</span>
                </div>

                <div class="flex column white space-around">
                    
                    <span class="lnr lnr-train light-gray-text" style="font-size: 4rem"></span>
                    <span>Next Station</span>
                    <span class="medium-text bold">{{next_station}}</span>
                </div>

            </div>
            </transition>

            <!-- SEEKER-->

            <transition name="wipeup2">
            <div style="width: 80%" v-if="current>=0">
                <seeker v-bind:value="(current-data.from) / (data.to-data.from)"></seeker>
            </div>
            </transition>

            <!-- Arrow down -->
            <transition name="slideup">
                <div  v-show="current>=0" style="transform: scaleX(2); color: #aaaaaa" class="margin-large-y"><span class="lnr lnr-chevron-down"></span></div>
            </transition>

            

            <!-- Tracking -->
            <transition name="slideleft">
            <tracking class="margin-large-y" v-show="current>=0" v-bind:from="data.from" v-bind:to="data.to" v-bind:current="current"></tracking>
            </transition>
            
            <div style="width: 80%; background: linear-gradient(transparent, white);" class="fixed wide bottom padding-medium">
                <button class="padding wide accent border-radius-large">
                Map
                </button>
            </div>

            <div class="absolute bottom white wide flex" id="chatinput" style="z-index: 2; max-height: 3.5rem; opacity: 0.05">
                <button @click="location.x = 100; location.y = 200;">Set Location</button>
                <button @click="current = data.from">Set current location</button>
                <button @click="movingstate='moving'">Moving</button>
                <button @click="current++">Next</button>
                <button @click="movingstate='stop'">Stop</button>
            </div>

        </div>
        
        `
}