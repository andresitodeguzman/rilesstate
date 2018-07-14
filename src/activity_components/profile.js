export default {
    name: 'Profile',
    data(){
        return{
            store: this.$root.store,
            account_details: this.$root.store.state.account_details,
            profile_details: this.$root.store.state.profile_details
        }
    },
    template:
    `
    <div>

    <!-- -->
    <div class="fixed top accent wide flex space-between" style="z-index: -1; height:7.5rem">
    <span class="lnr lnr-chevron-left padding-medium"></span>
    <span class="padding-medium"></span>
    <span class="lnr lnr-menu padding-medium"></span>
    </div>

    <!-- -->
    <div id="profile-container" class="wide high flex column align-center text-align-center">

        <img id="profile-pic" src="custom/img.jpg">
        <h1>{{account_details.first_name}} {{account_details.middle_name}} {{account_details.last_name}}</h1>
        <span>{{account_details.location}}</span>

        <span id="bio">{{account_details.status}}</span>

        <div class="padding text-align-center flex justify-center space-around" style="width: 85%; border-top: 1px solid #cccccc" >
        <div><h3>Coins</h3><br><span class="large-text bold accent-text" style="line-height: 0.5rem">50</span></div>
        <div><h3>Points</h3><br><span class="large-text bold accent-text" style="line-height: 0.5rem">150</span></div>

        </div>

        <div class="light-gray padding text-align-center shadow" style="width: 85%; border-radius: 0.5rem" >
            <h3 style="margin-bottom: 0.5rem">Badges</h3>
            <div class="flex justify-center" style=" flex-wrap: wrap">
                <span class="margin-small white border-radius-large padding padding-x-large" v-for="item in profile_details.badges">
                    <span style="margin-right: 0.25rem; font-size: 1.2rem" class="lnr"
                    v-bind:class="{
                        'lnr-pencil': item=='wordsmith',
                        'lnr-magic-wand': item=='wizard',
                        'lnr-dice': item=='gamer',
                        'lnr-eye': item=='patroller',
                        'lnr-pushpin': item=='wanderlust'}"
                        ></span><br><span style="text-transform: uppercase; font-size: 0.8rem">{{item}}</span>
                </span>
            </div>
        </div>

    </div>
    
    
    </div>
    `

}