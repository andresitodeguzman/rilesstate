<<<<<<< HEAD
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
=======
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
>>>>>>> 97abbe19e8a7027d7d50f3d506d3d9cc87fdf0f6
}