export default {
    
    name: 'InputDrawable',
        props: ['type','icon','hint','value'],
        data() {
            return {
               signup: true 
            }
        },
        
        template: `
        <div class="wide flex align-center" style="border-bottom: 1px solid #dadada">
        <span class="lnr" v-bind:class="icon"></span>
        <input v-bind:type="type" v-bind:value="value" v-on:input="$emit('input',$event.target.value)" class="padding-medium wide" v-bind:placeholder="hint">
        </div>
        `
    }