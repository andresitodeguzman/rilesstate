import LocationHelper from '../lib/helper/LocationHelper.js'

export default {
    
    name: 'Ride',
        created(){
            
            this.latitude = 0
            this.longitude = 0
            if('geolocation' in navigator){
                var successPosition = (pos)=>{
                    
                    this.latitude = pos.coords.latitude
                    this.longitude = pos.coords.longitude
                    this.speed = pos.coords.speed
                    var loc = new LocationHelper().nearest(this.latitude,this.longitude, this.static.stations)
                    var id = loc.id
                    var station = this.static.stations[id].name
                    console.log(loc + "////" + id + "////" + station)

                };
                var errorPosition = (err)=>{
                    //alert(err);
                    alert("Please turn on your device GPS.");
                    this.store.state.screens.pop();
                    this.store.state.screen_data.pop();
                };
                var options = {
                    enableHighAccuracy:true,
                    maximumAge:0
                };
                this.id = navigator.geolocation.watchPosition(successPosition, errorPosition,options);

            }
        
        },
        destroyed(){
            navigator.geolocation.clearWatch(this.id);
        },
        data() {
            return{
                id: "",
                store: this.$root.store,
                static: this.$root.store.static,
                data: this.$root.store.peekdata('ride'),
                latitude: 0,
                longitude: 0,
                speed:"",

                
                
                

                // User Ride Info
                
                mapview: false,

                // Message
                title: "Good day,",
                subtitle: "Please wait while we update your location...",
                survey: false,

                // Survey answer
                answer: ''

            }
        },
        watch:{
            answer:function(){
                if(this.answer!=''){
                    setTimeout(() => {this.answer='done';this.survey=false}, 1500);
                }
            },
            located: function(){
                if(this.located){
                    this.update("Great!","Your location has been updated")
                }
            },
            movingstate: function(){
                this.survey = false
                if(this.movingstate == 'GAINING_SPEED'){
                    this.update("You're now GAINING SPEED. You're at: "+ this.current_station,"Next station is " + this.next_station)   
                }
                else if(this.movingstate == 'MOVING'){
                    this.update("You're now MOVING. You're at:  "+ this.current_station,"Next station is " + this.next_station)   


                    if(this.current == this.data.from){
                        setTimeout(() => this.survey=true, 5000);
                    }

                }
                else if(this.movingstate == 'STOP'){
                    this.update("You have STOPPED. You're at: "+ this.current_station,"Next station is " + this.next_station)   
                }
                else if(this.movingstate == 'NOT_AVAILABLE'){
                    this.update("Moving state not available"+ this.current_station,"Next station is " + this.next_station)   
                }

                },
            current: function(){
                this.survey = false
                if(this.current == this.data.from){
                    if(this.movingstate=="STOP")
                        this.update("You're waiting","Random tip here when the user is waiting for a train")
                    else if(this.movingstate == "NOT_AVAILABLE")
                        this.update("You're at " + this.current_station,"Sorry, we cannot determine your current speed.")
                }
                else if(this.current == this.data.to){
                    this.update("You are now at " + this.current_station,"You may exit the train. Please check your belongings.")
                }
                else{
                    
                    this.update("You're now at " + this.current_station, this.remaining_stations +  " more stations to your destination")
                    }
                
            },

        },
        computed: {
            located: function(){
                
                return (this.latitude !=0 && this.longitude !=0 )
            },
            current_station: function(){
                if(this.located){
                return this.static.stations[this.current].name
                }
            },
            next_station: function(){
                if(this.current>=0){
                if(this.direction == 'Northbound')
                    if(this.current == 19)
                        return ' '
                    else
                        return this.static.stations[this.current + 1].name
                else if(this.direction == 'Southbound')
                    if(this.current == 0)
                        ' '
                    else
                        return this.static.stations[this.current - 0].name

                 }
            },
            remaining_stations: function(){
                return Math.abs(this.data.to - this.current) 
            },
            direction: function(){

                if(this.data.from < this.data.to)
                    return 'Northbound'
                else if(this.data.from > this.data.to)
                    return 'Southbound'

            },
            current: function(){
                return new LocationHelper().nearest(this.latitude,this.longitude,this.static.stations).id
            },
            movingstate: function(){
                return new LocationHelper().describeSpeed(this.speed)
            },
            seeker: function(){
                if(this.located){
                if(this.direction == 'Northbound')
                    return (this.current - this.from) / (this.data.to - this.data.from)
                else if(this.direction == 'Southbound')
                    return (this.data.from - this.current / this.data.from - this.data.to)
                }
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

            <!-- Not Map View-->
            <div style="max-width: 100%; margin-top: 2rem" class=" flex column align-center" v-if="!mapview">

            <!-- ASSISTANT -->
            <div style="max-width: 80%; min-height: 9rem; display: inline-block">
                <transition name="wipeup" mode="out-in" appear>
                <div class="bold" style="font-size: 1.75rem ;max-width: 100%" :key="title">{{title}}</div>
                </transition>
                <transition name="wipeup2" appear mode="out-in">
                <div class="wide-vw margin-y" style="line-height: 1.5rem; max-width: 100%" :key="subtitle">{{subtitle}}</div>
                </transition>
            </div>

            <!-- LOCATION LOADER -->

            <transition name="wipeup" appear>
                <div class="wide margin-large-y high flex justify-center align-center center text-align-center" style="box-sizing:border-box; position: relative" v-if="!located">
                    
                        <span class="lnr lnr-map-marker large-text" style="position:relative" >
                        <div id="initial-loader">     
                        </div>

                        </span>
                </div>
            </transition>

            <!-- GRAPHIC GUIDES -->

            <transition name="wipeup2" appear mode="out-in">
            <div style="width: 70%; min-height: 10rem; line-height: 0; margin-bottom: 3rem" class="flex space-between" v-if="located">
                <div class="flex column space-around">
                    
                    <span class="lnr lnr-clock light-gray-text" style="font-size: 4rem"></span>
                    <span>Est. Time Left</span>
                    <span class="medium-text bold">10 mins</span>
                </div>

                <div class="flex column space-around">
                    
                    <span class="lnr lnr-train light-gray-text" style="font-size: 4rem"></span>
                    <span>Next Station</span>
                    <span class="medium-text bold">{{next_station}}</span>
                </div>

            </div>
            </transition>

            <!-- SEEKER-->

            <transition name="wipeup2">
            <div style="width: 80%" v-if="located">
                <seeker v-bind:value="(current-data.from) / (data.to-data.from)"></seeker>
            </div>
            </transition>

            <!-- Arrow down -->
            <transition name="slideup">
                <div  v-if="located" style="transform: scaleX(2); color: #aaaaaa" class="margin-large-y"><span class="lnr lnr-chevron-down"></span></div>
            </transition>

            

            <!-- Tracking -->
            <transition name="slideleft">
            <tracking class="margin-large-y" v-if="located" v-bind:from="data.from" v-bind:to="data.to" v-bind:current="current"></tracking>
            </transition>

            </div>

            <div v-if="mapview" style="position: absolute;" class="accent wide high">
            
            </div>

            <div style="width: 100%; background: linear-gradient(transparent, white);" class="fixed wide text-align-center bottom padding-medium">
                <button class="padding accent border-radius-large" @click="mapview=!mapview" style="width: 80%">
                Map
                </button>
            </div>

            <!--
            <div class="absolute bottom white wide flex" id="chatinput" style="z-index: 2; max-height: 3.5rem; opacity: 0.1">
                <button @click="location.lat = 100; location.long = 200;">Set Location</button>
                <button @click="current = data.from">Set current location</button>
                <button @click="movingstate='moving'">Moving</button>
                <button @click="current++">Next</button>
                <button @click="movingstate='stop'">Stop</button>
                <button @click="survey = !survey">Survey</button>
            </div>
            -->

            <transition name="slideup">
            <div v-if="survey" id="survey" class="padding-large shadow-up white fixed bottom wide" style="border-radius: 1rem 1rem 0 0">

              
                <div v-show="answer==''">
                <h1 style="padding: 1rem 0 !important">Was it too crowded in the previous station?</h1>
                <button @click="answer='Yes'">Yes</button>
                <button @click="answer='No'">No</button>
                </div>
              

                <transition name="wipeup" mode="out-in">
                    <div v-show="answer!=''&&answer!='done'">
                    <h1 style="padding: 1rem 0 !important">Thanks for your response.</h1>
                    <span>You earned <span class="accent-text bold">+5 points</span> and <span class="accent-text bold">+5 coins!</span></span>
                    </div>
                </transition>
                

            </div>
            </transition>

        </div>
        
        `
}