export default {
    
name: 'Login',
    data() {
        return {
            store: this.$root.store,
            signup: true,
            username : "",
            email : "",
            password : "",
        }
    },
    computed: {
        new_user: function(){
                return !this.store.state.session_details.logged_in
                }
    },
    methods: {
        submit: function(){

            var success = false


            if(this.signup){

                // Perform final validation here
                success = this.store.signup(this.username,this.email,this.password)
            }
            else{

                // Perform final validation here
                success = this.store.login(this.username, this.password)
            }
            if(success){

                //Assign profile variables
                

                //Then go to home
                this.store.navigatepath("home")
            }
                
        }
    },
    template: `
    <div v-if="new_user" class="flex column high wide">
        <div class="wide fixed top flex justify-center" id="tabs">
            <h4 v-bind:class="{'active':signup}" @click="signup=true">Sign Up</h4>
            <h4 v-bind:class="{'active':!signup}" @click="signup=false">Log in</h4>
        </div>
        <div class="padding-large" style="height: 100%; margin-top: 4rem">
            <input-drawable type="text" icon="lnr-user" v-model="username" v-bind:hint="signup ? 'Username' : 'Username or Email'"></input-drawable>
            <input-drawable type="email" icon="lnr-envelope" v-model="email" hint="Email" v-if="signup" ></input-drawable>
            <input-drawable type="password" icon="lnr-lock" v-model="password" hint="Password"></input-drawable>
            <input type=submit class="select-shrink unselect border-radius-large padding wide margin-large-y accent shadow bold" v-bind:value="signup ? 'Register' : 'Login'" @click.preventdefault="submit()">
            <div v-show="signup" class="unselect flex justify-center"><input type="checkbox" id="statistics" checked style="font-size: 0.75rem; "> <label for="statistics" style="margin-left: 0.5rem; font-size: 0.75rem; ">I agree to participate in the UX Improvement Program and share my ride statistics to LRMC</label></div>
        </div>
    </div>
    `
}