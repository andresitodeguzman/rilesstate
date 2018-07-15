import communitydata from './communitydata.js'
import ajaxmethods from './ajaxmethods.js'




export default {

    store:{

        state:{
            
            // App Configuration Stuff
            app_details: {
                added_to_home_screen: false,
            },

            app_config: {

                
                // accent: '#e31e2a !important',
                // background: 'url("custom/coke.jpg")',
                // accent_text: 'white'
                accent: 'auto',
                background: 'auto',
                accent_text: 'auto'


            },

            // Sessions, Caches, etc?
            session_details: {
                logged_in: false,
                session_id: ""
            },

            // Account and contact details of current user
            account_details: {
                
                
            address:"",
            customer_id: 0,
            date_registered:"",
            dev_share_stats:"",
            email:"",
            first_name:"",
            gender:"",
            last_name:"",
            middle_name:"",
            mobile_number:"",
            profile_picture:null,
            status:"",
            username:""

            },

            // Profile and activity details
            profile_details: {
                
                badges: [
                    {name: "badge 1"},
                    {name: "badge 2"},
                ]

                
            },

            // Card Collection Preferences
            cards:[
                // {type: 'custom', data:{
                //     background: '#ffc000',
                //     color: '#000000',
                //     title: 'Tutorial',
                //     content: 'Hello user! Learn the basic usage of the app.',
                //     action: 'Start Tutorial',
                //     href: '#'
                // }},

                {type: 'weather', data:{
                    title: 'Monumento Weather',
                    location: 'Monumento',
                    forecasts: [
                        {   temperature: 45,
                            forecast: 'sunny'    },
                        {   temperature: 43,
                            forecast: 'cloudy'    },
                        {   temperature: 46,
                            forecast: 'sunny'     },
                        {   temperature: 48,
                            forecast: 'stormy'    },
                        {   temperature: 47,
                            forecast: 'rainy'     },
                    ]
                }},
                {type: 'stationinformation', data:{
                    title: 'Edsa Station Information',
                    station: 'Edsa',
                    northbound: 'Heavily congested',
                    southbound: 'Clear'
                }},
                {type: 'announcements', data:{
                    title: 'Announcements',
                    list:[
                        { type: 'info', body: 'Free rides on July 14-15, 2018 in line with the celebration of HackATren', date: 'July 10, 2018 4:00pm'},
                        { type: 'warning', body: 'Heavy flood on Dorroteo Jose Station. Please be careful.', date: 'July 10, 2018 3:00pm'},
                ]
                }},
                {type: 'nearby', data:{
                    title: 'Near you',
                    coords: {lat:14.6054454,long:120.9798723},
                    type: 'restaurant',
                    radius: 500,
                    list: [
                        {
                            name: 'Pan de Manila',
                            type: 'food',
                            location: 'Pasay',
                            nearest_station: 'Edsa Station'
                        },
                        {
                            name: 'Manila Opera Hotel',
                            type: 'hotel',
                            location: 'Somewhere City',
                            nearest_station: 'Dorroteo Jose'
                        }
                    ]
                }},
                {type: 'custom', data:{
                    background: '#e31e2a',
                    color: '#ffffff',
                    title: 'Coke Studio',
                    content: 'Bring out the musician in you! Ready to kick start your music career?',
                    action: 'Count me in!',
                    href: 'https://cocacola.com'
                }},
                
                
                
            ],

            station_congestion: [
                // 1: clear, 5: highly congested, null: not applicable, closed: not yet open or closed for some reason, unavailable: no data yet
                {north: 5, south: null},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: 1, south: 3},
                {north: null, south: 3},
            ],

            // Screens
            screens : [],
            screen_data: [],
            

        },

        static:{
            stations: [
                {   id: 0, name: "Roosevelt",   address: "Pasay City", latitude:14.6576072,longitude:121.0187903},
                {   id: 1, name: "Balintawak",   address: "Pasay City",   latitude:14.6575508,longitude:121.0190023},
                {   id: 2, name: "Yamaha Monumento",   address: "Pasay City", latitude:14.6543722,longitude:120.9817053},
                {   id: 3, name: "5th Avenue",   address: "Makati City", latitude:14.6444202,longitude:120.9813945},
                {   id: 4, name: "R. Papa",   address: "Pasay City", latitude:14.636055,longitude:120.9801084},
                {   id: 5, name: "Abad Santos",   address: "Pasay City",  latitude:14.63088263,longitude:120.9790571},
                {   id: 6, name: "Bumentritt",   address: "Pasay City", latitude:14.6226405,longitude:120.9807027},
                {   id: 7, name: "Tayuman",   address: "Pasay City" , latitude:14.6167419,longitude:120.980544},
                {   id: 8, name: "Bambang",   address: "Pasay City" , latitude:14.6082169,longitude:120.9778718},    
                {   id: 9, name: "Doroteo Jose",   address: "Pasay City" ,latitude:14.6054454,longitude:120.9798723},
                {   id: 10, name: "Carriedo",   address: "Pasay City" ,latitude:14.5997464,longitude:120.9792228},
                {   id: 11, name: "Central Terminal",   address: "Pasay City" ,latitude:14.5927811,longitude:120.9794726},
                {   id: 12, name: "United Nations",   address: "Pasay City"  ,latitude:14.5825552,longitude:120.9824323},
                {   id: 13, name: "Pedro Gil",   address: "Pasay City"  ,latitude:14.5770233,longitude:120.9872367},
                {   id: 14, name: "Quirino",   address: "Pasay City"  ,latitude:14.5702241,longitude:120.9894316},
                {   id: 15, name: "Vito Cruz",   address: "Pasay City" ,latitude:14.5633042,longitude:120.9926264},
                {   id: 16, name: "Gil Puyat",   address: "Pasay City" , latitude:14.5541678,longitude:120.9949784},
                {   id: 17, name: "Libertad",   address: "Pasay City",latitude:14.5476681,longitude:120.9964217},
                {   id: 18, name: "Edsa",   address: "Pasay City" ,latitude:14.538408,longitude:121.0003645},
                {   id: 19, name: "Baclaran",   address: "Pasay City" ,latitude:14.5342911,longitude:120.9961528}
            ]
        },

        /** Community */
        communitydata: communitydata,

        /* Push a page (for hrefs) */
        navigate(event,data){
            var path = event.target.getAttribute('href')
            this.navigatepath(path,data)
        },

        /* Push a path (for buttons) */
        navigatepath(path,data){
            
            window.history.pushState("","","#")
            this.state.screens.push(path)
            
            if(data == undefined)
                this.state.screen_data.push({})
            else
                this.state.screen_data.push(data)
        },

        peekdata(id){
            return this.state.screen_data[this.state.screens.indexOf(id)]
            
        }
        
        ,

        /** Account Methods */
        signup(username,email,password){

            
            
            // Signup object
            var array = {
                'first_name':'',
                'middle_name':'',
                'last_name':'',
                'address':'',
                'status':'',
                'email':email,
                'mobile_number':'',
                'username':username,
                'password':password,
                'gender':'',
                'dev_share_stats':'',
            }

            
            // Perform async call
            ajaxmethods.signup(array)
            
        },

        login(username, password){

            var array = {
                'username':username,
                'password':password
            }
            
            // Perform async call
            return ajaxmethods.verifylogin(array)
        },
        handlelogin(result){
            
            this.navigatepath('home',data)
            

        },
        

    

        
    
        
    }
    ,
    

}