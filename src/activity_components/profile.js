export default {
    name: 'Profile',
    data(){
        return{
            store: this.$root.store,
            account_details: this.$root.store.state.account_details
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
        <h1>{{account_details.first_name}} {{account_details.last_name}}</h1>
        <span>{{account_details.location}}</span>

        <span id="bio">{{account_details.bio}}</span>

        <div class="light-gray wide padding">
            <h3>Badges</h3>
            <div class="flex justify-center">
                <span>Badge1</span>
                <span>Badge2</span>
                <span>Badge3</span>
            </div>
        </div>

    </div>
    
    
    </div>
    `

}