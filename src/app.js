import Store from './store/store.js'

import Activity from './activity_components/activity.js';
import Onboarding from './sub_components/onboarding.js';
import InputDrawable from './sub_components/input-drawable.js';
import Login from './activity_components/login.js';
import Home from './activity_components/home.js';
import Assistant from './sub_components/assistant.js';
import Community from './activity_components/community.js';
import Chatroom from './activity_components/chatroom.js';
import Ride from './activity_components/ride.js';
import Seeker from './sub_components/seeker.js';
import Card from './sub_components/card.js';
import WeatherIcon from './sub_components/weathericon.js';
import Weather from './cards/weather.js';
import StationInformation from './cards/stationinformation.js';
import Announcements from './cards/announcements.js';
import Nearby from './cards/nearby.js'
import Custom from './cards/custom.js'
import ForumCategory from './activity_components/forumcategory.js';
import Forum from './activity_components/forum.js';
import Profile from './activity_components/profile.js';
import Tracking from './sub_components/tracking.js';
import Leaderboard from './activity_components/leaderboard.js';


Vue.component('activity', Activity)
Vue.component('onboarding', Onboarding),
Vue.component('input-drawable', InputDrawable)
Vue.component('login',Login)
Vue.component('input-drawable', InputDrawable)
Vue.component('home', Home)
Vue.component('assistant', Assistant)
Vue.component('community', Community)
Vue.component('chatroom', Chatroom)
Vue.component('ride', Ride)
Vue.component('seeker', Seeker)
Vue.component('forum', Forum)
Vue.component('weathericon', WeatherIcon)
Vue.component('profile', Profile)

Vue.component('card', Card)
Vue.component('weather', Weather)
Vue.component('stationinformation', StationInformation)
Vue.component('announcements', Announcements)
Vue.component('nearby', Nearby)
Vue.component('custom', Custom)
Vue.component('forumcategory', ForumCategory)
Vue.component('tracking', Tracking)


Vue.component('leaderboard', Leaderboard)





var vue_app = new Vue({
    el: '#app',
    data: Store
    
})

var preloader = new Vue({
    el: '#preloader-container',
    data: {
        loading: true
    },
})



/** NATIVE EVENTS */

window.addEventListener('load',function(event){
    preloader.$data.loading = false
})

window.onpopstate = function(){
    event.preventDefault()
    vue_app.$data.store.state.screens.pop()
    vue_app.$data.store.state.screen_data.pop()
}
  
  

        
        

