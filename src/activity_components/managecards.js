export default {
    
    name: 'ManageCards',
        data() {
            return{
                store: this.$root.store,
            }
        },
        template:
        `
        <div id="managecards" >

            <!-- Accent -->
            <span class="accent wide fixed" style="z-index:-1; height:6rem; top:0;"></span>
            <br>

            <!-- Action bar -->
            <div class="flex justify-center space-between padding-x-large" style="width: 100%; padding-top: 0.5rem">
                <button class="dark-accent-text"  style="background-color: transparent; border: 0; font-size: 1rem; font-weight: bold;" @click="pop()"><span class="lnr lnr-chevron-left" style="font-weight: bold; padding-right: 0.5rem" ></span>Back</button>
                <button class="dark-accent-text"  style="background-color: transparent; border: 0; font-size: 1rem; font-weight: bold;" @click="cards.push({type:'weather'})"><span class="lnr lnr-plus-circle padding-small" style="font-weight: bold"></span>Add a Card</button>
            </div>

            <!-- Card Container -->
            <div class="flex column justify-center padding" style="width: 100; overflow-y: scroll">
                    <transition-group name="slidertl" appear>                    
                    <card v-for="(card,index) in store.state.cards" v-bind:key="index" v-bind:type="card.type" v-bind:data="card.data"></card>
                    <div style="color: #888888; text-align: right; position: relative; top: 1rem; right: 0.5rem;">
                        <!-- <span class="lnr lnr-chevron-up padding-small"></span>
                        <span class="lnr lnr-chevron-down padding-small"></span>
                        <span class="lnr lnr-cog padding-small"></span> -->
                        <span class="lnr lnr-trash padding-small" @click="removeIndex(index)"></span>
                    </div>
                </card>            
                </transition-group>
            </div>
        </div>
        `
}