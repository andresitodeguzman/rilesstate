export default {
    
    props: ['type','data'],
    name: 'Card',
    data() {
        return{

        }
    },
    template: 
    `
    <div class="card flex column white" v-bind:style="{'background-color':data.background, 'color': data.color}">
        
        <!-- Header-->

        <div class="flex space-between">
            <header style="color: inherit">{{data.title}}</header>

            <!-- Optional Card Menu-->

            <span></span>

        </div>

        <!-- Content -->

        <weather v-bind:data="data" v-if="type == 'weather'"></weather>
        <announcements v-bind:data="data" v-if="type == 'announcements'"></announcements>
        <nearby v-bind:data="data" v-if="type == 'nearby'"></nearby>
        <custom v-bind:data="data" v-if="type == 'custom'"></custom>



    </div>
    `

}