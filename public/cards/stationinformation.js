export default {
    
    name: 'StationInformation',
    props: ['data'],
    data() {
        return {
            
        }
    },
    template:
    `
    <div id="stationinformation">

    <span class="congestion">
        <span class="indicator">
            <span class="lnr lnr-arrow-up-circle"></span>
        </span>
        <span class="text">
            <span class="direction">Northbound</span>
            <span class="status">{{data.northbound}}</span>
        </span>
    </span>
    <span class="congestion">
        <span class="indicator">
            <span class="lnr lnr-arrow-down-circle"></span>
        </span>
        <span class="text">
            <span class="direction">Southbound</span>
            <span class="status">{{data.southbound}}</span>
        </span>
    </span>


    </div>
    
    `
}