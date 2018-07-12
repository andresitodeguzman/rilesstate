import communitydata from './communitydata.js'

export default {

    store:{

        state:{

            message: 'State message',
            
            // App Configuration Stuff
            app_details: {
                added_to_home_screen: false,
            },

            // Sessions, Caches, etc?
            session_details: {
                logged_in: false,
                session_id: ""
            },

            // Account and contact details
            account_details: {

                /*
                user_id: "",
                username: "me",
                avatar: "",
                first_name: "",
                last_name: "",
                email: "",
                date_joined: ""
                 */

                user_id: "01",
                username: "lucky8548875",
                avatar: "",
                bio:"Hi! I'm Stephen, an aspiring web developer. Welcome to my profile.",
                location: "Imus, Cavite",
                first_name: "Stephen John",
                last_name: "Raymundo",
                email: "bayan.mahal@live.com",
                date_joined: ""

            },

            // Profile and activity details
            profile_details: {
                coins: 0,
                badges: [
                    {name: "badge 1"},
                    {name: "badge 2"},
                ]
                
            },

            // Card Collection Preferences
            cards:[
                {type: 'weather', data:{
                    title: 'Monumento Weather',
                    location: 'Monumento',
                    forecasts: [
                        {   temperature: 45,
                            forecast: 'sunny'    },
                        {   temperature: 43,
                            forecast: 'cloudy'     },
                        {   temperature: 46,
                            forecast: 'sunny'     },
                        {   temperature: 48,
                            forecast: 'stormy'     },
                        {   temperature: 47,
                            forecast: 'rainy'     },
                    ]
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
                    background: '#ee2222',
                    color: '#ffffff',
                    title: 'Coke Studios',
                    content: 'Bring out the musician in you! Ready to kick start your music career?',
                    action: 'Count me in!',
                    href: '#'
                }},
                
                
            ],

            // Screens
            screens : [],
            screen_data: []

        },

        static:{
            stations: [
                {   id: 0, name: "Baclaran",   address: "Pasay City",  },
                {   id: 1, name: "Edsa",   address: "Pasay City"  },
                {   id: 2, name: "Libertad",   address: "Pasay City",  },
                {   id: 3, name: "Gil Puyat",   address: "Makati City",  },
                {   id: 4, name: "Vito Cruz",   address: "Pasay City", },
                {   id: 5, name: "Quirino",   address: "Pasay City",   },
                {   id: 6, name: "Pedro Gil",   address: "Pasay City" },
                {   id: 7, name: "United Nations",   address: "Pasay City"  },
                {   id: 8, name: "Central Terminal",   address: "Pasay City"  },
                {   id: 9, name: "Carriedo",   address: "Pasay City"  },
                {   id: 10, name: "Doroteo Jose",   address: "Pasay City"  },
                {   id: 11, name: "Bambang",   address: "Pasay City"  },
                {   id: 12, name: "Tayuman",   address: "Pasay City"  },
                {   id: 13, name: "Blumentritt",   address: "Pasay City"  },
                {   id: 14, name: "Abad Santos",   address: "Pasay City"  },
                {   id: 15, name: "R. Papa",   address: "Pasay City"  },
                {   id: 16, name: "5th Avenue",   address: "Pasay City"  },
                {   id: 17, name: "Yamaha Monumento",   address: "Pasay City"  },
                {   id: 18, name: "Balintawak",   address: "Pasay City"  },
                {   id: 19, name: "Roosevelt",   address: "Pasay City"  },
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
            window.history.pushState("","","")
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

            // call backend code and get values


            // this.state.account_details.user_id = ""
            // this.state.account_details.username = ""
            // this.state.account_details.avatar = ""
            // this.state.account_details.first_name = ""
            // this.state.account_details.last_name = ""
            // this.state.account_details.email = ""
            // this.state.account_details.date_joined = ""

            return true
        },

        login(username, password){

            //Update credentials here

            return true
        },

        
    
        
    }
    

}