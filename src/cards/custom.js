export default {
    
    name: 'Custom',
    props: ['data'],
    data() {
        return {
            
        }
    },
    template:
    `
    <div class="flex column">
        <span>
            {{data.content}}
        </span>

        <div style="margin-top: 0.5rem; text-align: right">
            <a class="bold" v-bind:href="data.href" style="color: inherit">{{data.action}}</a>
        </div>
        
    </div>
    
    `

}