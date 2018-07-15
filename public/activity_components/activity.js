export default {
    
    name: 'Activity',
        props: ['id','direction'],
        data() {
            return {
                debug: false
            }
        },
        computed: {
            visible: function(){
                    return this.$root.store.state.screens.includes(this.id)
            },
            data: function(){
                if(this.visible)
                    return this.$root.store.state.screen_data[this.$root.store.state.screens.indexOf(this.id)]
            },
            secondpeek: function(){
                if(this.$root.store.state.screens.length>1){
                    var second = this.$root.store.state.screens[this.$root.store.state.screens.length - 2]
                    return second == this.id;
                }
                return false
            },

        }
        ,
        template: `
        <transition v-bind:name="direction">
        <div v-if="visible" class="activity wide high fixed white" v-bind:class="{'shift':secondpeek}">
        <div v-if="debug" class="fixed" style="z-index: 10">{{data}}</div>
            <slot></slot>
        </div>
        </transition>
        `
    }