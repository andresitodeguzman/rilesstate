var slides = [
    {graphic: "lnr-train", title: "Track your ride", message: "Never miss the station again. Ever."},
    {graphic: "lnr-map", title: "Get recommendations", message: "Need a quick fix? We got'ya."},
    {graphic: "lnr-users", title: "Be with community", message: "Create connections. Make new friends. "}
]


export default {
    name: 'Onboarding',
    data() {
        return {
            slides,
            translate: 0,
            store: this.$root.store,
        }
    },
    computed:{
        style: function(){
            return{
                width: '300%',
                transition: 'transform 0.5s',
                transform: 'translateX(' + this.translate +'vw)'
            }
        },
        new_user: function(){
           return !this.store.state.session_details.logged_in
        }
    },
    methods:{
        navigatepath : function(path){
           this.store.navigatepath(path)
        }
    },
    template:
    `
    <!-- Container -->
    <div class="wide fixed flex column justify-center" style="height: 90%" v-if="new_user">

        <!-- Card Container -->
        <div class="flex white" v-bind:style="style">
            <div class="flex align-center column wide padding-large" v-for="(item,index) in slides">
            <transition name="wipeup" appear><span  v-show="translate === (index * -100)" class="lnr accent-text absolute" v-bind:class="item.graphic" style="font-size: 5rem; top: -1rem"></span></transition>
            <span class="medium-text bold" style="margin: 3rem 0 2rem; position: relative; top: 2rem">{{item.title}}</span>
            <span class="text-align-center" style="position: relative; top: 2rem; width: 85%">{{item.message}}</span>
            </div>
        </div>


        <div class='wide flex fixed space-between accent-text bottom'>
            <span class="padding-large">
                <span class="disk light-gray" v-bind:class="{ accent: translate === 0}" ></span>
                <span class="disk light-gray" v-bind:class="{ accent: translate === -100}"></span>
                <span class="disk light-gray" v-bind:class="{ accent: translate === -200}"></span>
            </span>
            <button class="transparent onboarding-btn padding-large bold" @click="translate-=100" v-show="translate > -200">Next</button>
            <button class="transparent onboarding-btn padding-large bold" v-show="translate === -200"" @click.prevent="navigatepath('login')">Get Started</button>
        </div>
    </div>


    `
}