export default {
    
    name: 'Custom',
    props: ['data'],
    data() {
        return {
            
        }
    },
    methods:{
        navigatelink(link){
            window.open(link)
        }
    },
    template:
    `
    <div class="flex column">
        <span>
            {{data.content}}
        </span>

        <div style="margin-top: 0.5rem; text-align: right">
            <a class="bold" @click="navigatelink(data.href)" target="_blank" style="color: inherit">{{data.action}}</a>
        </div>
        
    </div>
    
    `

}