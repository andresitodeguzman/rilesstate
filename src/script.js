
/* Global Variables */

/** Stack of screens/activity that are loaded
 *  Wwhen the id of activity is pushed to the array (push method),
    the screen or the <activity> tag will be visible.;
    A screen is hidden and removed using pop() method

    If you want to start with the home screen, just change this to:

    var __screens=['#parent','#onboarding','#home']
*/ 
var __screens=['#parent','#onboarding','#home'] // In this case, starts with #onboarding activity

/** Cards that are displayed on the home dashboard
 *  User can add/remove cards
*/ 

var __cards=[{type: 'weather'}  ,{type: 'station'},{type: 'nearby'}]

/**
 * Account details
 */
var __account = {
    name:'John',
    email:'email@email'
}

/** Messages displayed during ride */

var __travelnotes = {
    title:'Hello,',
    message:'Thank you for choosing to ride with us. While waiting, here are some things to do. Thanks!',
    timeremaining : '30secs',
    nextstation : 'Pedro Gil',
    progress: 0.5
}

var __recommendations = [
    {name:'Establishment Name', location:'City, Province'},
    {name:'National Museum of Natural History', location:'Somewhere, Here'},
    {name:'National Museum of Anthropology', location:'Somewhere, There'},
    {name:'National Museum of Fine Arts', location:'Somewhere, There'},
]

/**
 * These are global methods that should be accessed by components
 * that can control the switching of screens
 */

var __methods = {
    push : function(page){
        this.screens.push(page);
    },
    
    pop: function(page){
        this.screens.pop()
    }
}


/**
 * Activity Component
 */
Vue.component('activity', {

    // Activity has data `screens`
    data: function(){
        return {
            screens: __screens,
        }
    },
    computed:{
        show: function(){
            return this.screens.includes('#'+this.id)
        },
        secondpeek: function(){
            var second = this.screens[this.screens.length - 2]
            if(second == '#parent')
                return false
            else return second == '#' + this.id;
        },
    },
    props:['id'],
    template: `<transition name='slidertl'>
    <div class="activity fixed white high wide" v-bind:class="{shift: secondpeek}" v-bind:id="id" style="transition: 0.5s transform" v-if="show"><slot></slot></div>
    </transition>`
})

/**
 * Three-Page Onboarding
 */
Vue.component('onboarding', {
    data: function(){
        return{
            screens: __screens,
            translate: 0,
        }
    },
    computed:{
        style: function(){
            return{
                width: '300%',
                transition: 'transform 0.5s',
                transform: 'translateX(' + this.translate +'vw)'
            }
        }
    },
    methods:{
        push: __methods.push,
        shift: function(){
            document.querySelector(this.screens[this.screens.length - 1]+"").style.transform = "translate(-30vw)"
        }
        
    },
    template: `
    
    <div class='wide high flex column'>
        <div class="grow flex" v-bind:style="style"
        
        
        >
  
  
            <slot></slot>
        </div>
        <div class='wide flex space-between'>
            <span class="padding-large">
                <span class="disk accent-gray margin-x-small" v-bind:class="{ accent: translate === 0}" ></span>
                <span class="disk accent-gray margin-x-small" v-bind:class="{ accent: translate === -100}"></span>
                <span class="disk accent-gray margin-x-small" v-bind:class="{ accent: translate === -200}"></span>
            </span>
            <span class="padding-large bold" @click="translate-=100" v-show="translate > -200" style="cursor: pointer">Next</span>
            <span class="padding-large bold" v-show="translate === -200" style="cursor: pointer" @click=" shift();push('#login');">Get Started</span>
        </div>
    </div>
    `
})

/**
 * Slides for Onboarding
 */
Vue.component('slide', {
    props:['title','body'],
    template: `
    <div class="wide flex column justify-center align-center center">
        <span class="icon-large accent-text lnr lnr-train"></span>
        <span class="large bold" style="margin: 3rem 0 2rem">{{title}}</span>
        <span class="wide-75">{{body}}</span>
    </div>
    `
})

/** Login */
Vue.component('login',{
    data: function(){
            return{
                screens: __screens,
                translate: 0,
                mode: "signup"
            }
    },
    methods:{
        push: __methods.push,
        shift: function(){
            document.querySelector(this.screens[this.screens.length - 1]+"").style.transform = "translate(-30vw)"
        }
        
    },
    template:`
    
    <div class="activity login">
    <h3>
        <span class="option" v-bind:class="{active:mode==='signup'}"  @click="mode='signup'">Sign Up</span>
        <span class="option"  v-bind:class="{active:mode==='login'}" @click="mode='login'">Login</span>
    </h3>
    <div class="inputs">
        
            <span class="input">
                    <input type="text" placeholder="Juan dela Cruz"  v-show="mode=='signup'"><span class="lnr lnr-user"></span>
            </span>
            <span class="input">
                    <input type="email" v-bind:placeholder="mode=='signup' ? 'juandelacruz@email.com' : 'Email or Username'"><span class="lnr lnr-envelope"></span>
            </span>
            <span class="input">
                    <input type="password" placeholder="••••••••"><span class="lnr lnr-lock"></span>
            </span>
            
            
            <input type="submit" @click="screens.push('#success')" v-bind:value="mode=='signup' ? 'Create Account' : 'Login'">
            <button><small>or </small> Continue as Guest</button>

            <div class="connect">
                    <span class="connection">
                        <span class="lnr lnr-envelope"></span>
                    </span>
                    <span class="connection">
                        <span class="lnr lnr-sun"></span>
                        </span>
                    <span class="connection">
                        <span class="lnr lnr-rocket"></span>
                    </span>
            </div>
        
    </div>
    


</div>
        `
})

/** Card */
Vue.component('card',{
    props:['type','index'],
    data: function(){
        return{
            cards: __cards
        }
    },
    methods:{
        removeIndex: function(index){
                    this.cards.splice(index,1)
        }
    },
    template: `
        <div class="card">
            <slot></slot>
            <weather v-if="type=='weather'"></weather>
            <station v-if="type=='station'"></station>
            <nearby v-if="type=='nearby'"></nearby>
        </div>`

})

/** Weather component (do not use explicitly; use <card type="weather"></card>) */

Vue.component('weather',{
    template:`<div>
                <h4>Taft Avenue</h4>
                    <div class="weather-main">
                        <span class="detail-main">
                            <span class="lnr lnr-sun"></span>
                            <span class="text-detail">SUNNY</span>
                        </span>
                        <span class="temperature">
                                45°
                        </span>
                            
                    </div>

                    <div class="weather-sub">
                        <span class="sub-item">
                            <span class="day">TUE 45°</span>
                            <span class="lnr lnr-sun"></span>
                        </span>
                        <span class="sub-item">
                            <span class="day">WED 45°</span>
                            <span class="lnr lnr-sun"></span>
                        </span>
                        <span class="sub-item">
                            <span class="day">THUR 45°</span>
                            <span class="lnr lnr-sun"></span>
                        </span>
                        <span class="sub-item">
                            <span class="day">FRI 45°</span>
                            <span class="lnr lnr-sun"></span>
                        </span>
                    </div>
    
                </div>`
})

/** Station component (do not use explicitly; use <card type="weather"></card>) */
Vue.component('station',{
    template:`<div class="station">
    <h4>EDSA Station Information</h4>
    <span class="congestion">
        <span class="indicator">
            <span class="lnr lnr-location"></span>
        </span>
        <span class="text">
            <span class="direction">Northbound</span>
            <span class="status">Heavily Congested</span>
        </span>
    </span>
    <span class="congestion">
        <span class="indicator">
            <span class="lnr lnr-location"></span>
        </span>
        <span class="text">
            <span class="direction">Southbound</span>
            <span class="status">Moderate</span>
        </span>
    </span>
    
    </div>`
})

/** Nearby component */
Vue.component('nearby',{
    data: function(){
        return {
            recommendations: __recommendations
        }
    },
    template:`
    <div class="places">
                <h4>Near You</h4>
                <span class="items">
                <span class="item" v-for="item in recommendations">
                    <img src="custom/img.jpg">
                    <span class="name">{{item.name}}</span>
                    <span class="location">{{item.location}}</span>
                </span>
            </span>
            </div>
    `
    })
    

/** Ride Panel (need pa ng props) */
Vue.component('ride-panel',{
    data: function(){
        return{
            title: __travelnotes.title,
            message: __travelnotes.message,
            timeremaining: __travelnotes.timeremaining,
            nextstation: __travelnotes.nextstation,
            progress: __travelnotes.progress,
            screens: __screens,
        }
    },
    methods: __methods,
    computed:{
        tipstyle: function(){
            return "margin-left: " + this.progress * 100 + "%"
        }
    },
    template: ` 
    <div class="ride-panel">
    <input type="checkbox" id="map-reveal" style="display: none">
        <div class="flex wide space-between align-center"><span class='padding padding-x-large lnr lnr-chevron-left bold' @click="screens.pop()"></span><span class="title">Ride a Train</span><span class="padding padding-x-large"></span></div>
        
        <span class="view">
        <span class="message-large">{{title}}</span>
        <span class="sub-message">
            <span>{{message}}</span>
            <span></span>
        </span>
        <span class="infodetail">
            <span class="item">
                
                <span class="lnr lnr-clock"></span>
                <span class="head">Estimated Time</span>
                <span class="value">{{timeremaining}}</span>
            </span>
            <span class="item">
                    
                <span class="lnr lnr-clock"></span>
                <span class="head">Next Station</span>
                <span class="value">{{nextstation}}</span>
            </span>
        </span>
        <span class="track">
            <progress max="1" v-bind:value="progress"></progress>
            <span class="indicator">
                <span class="start"></span>
            <span class="tip" v-bind:style="tipstyle"></span>
            <span class="end lnr lnr-map-marker"></span>
            </span>
            
        </span>
    </span>
    <span class="map" id="map">
        
    </span>
    <label for="map-reveal">
    <span class="button">
            <span class="lnr lnr-map"></span><span class="lnr lnr-map-marker"></span>
            <span class="lnr lnr-cross"></span>
        </span>
    </label>
        
        
    </div>
    `
})

/** Assistant(Search bar) component */
Vue.component('assistant',{
    data: function(){
        return{
            showbody: false,
            suggestions: ['one','two','three','four','five'],
            query: ''
        }
    },
    template:`
            <div class="wide">
                <transition name="fade">
                <div class="wide high fixed" style="top: 0; background-color: rgba(0,0,0,0.5);" v-show="showbody" ></div>
                </transition>
                    <div id="assistant" class="wide white fixed shadow flex space-between align-center">
                <span class="lnr lnr-magnifier absolute" style="margin-left: 1.5rem"></span>    
                <input type="text" class="wide relative transparent" style="padding: 1rem 3.5rem; font-size: 1rem;" placeholder="Look for places.." @focus="showbody = true"
                @blur="showbody = false" @keypress="query = $event.target.value" @input="query = $event.target.value">
            
            
                    </div>
                    <div class="fixed wide" v-show="showbody" style="padding: 0.5rem; top: 5rem; z-index: 1">
                        <div class="margin-y white padding"  v-for="item in suggestions" v-if="item.includes(query) && query.length > 1 || item.startsWith(query) && query.length > 0"><span class="lnr lnr-train" style="vertical-align: middle; margin-right: 1rem"></span>{{item}}</div>
                    </div>
                </div>
                
    `
})




/**
 * Vue Instance
 */
new Vue({

    el: '#parent',
    data:{
        screens:__screens,
        cards: __cards,
        suggestions: ['one','two','three','four','five'],
        query: '',
        account: __account,
        travelnotes: __travelnotes
        
    },
    computed:{
        peek: function(){
            return this.screens[this.screens.length - 1];
        },

    },
    methods:{
        push: __methods.push,
        pop: __methods.pop,
        uncheck: function(){
            document.querySelector("#bottom-menu-collapse").checked = false
            document.querySelector("#action-collapse").checked = false
        },
        removeIndex: function(index){
            this.cards.splice(index,1)
}
    }

});