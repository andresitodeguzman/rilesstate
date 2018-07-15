/**
 * PWA Kit
 * 2018
 * https://github.com/andresitodeguzman/pwa-kit
 * 
 * Service Worker
 *
 */

'use strict';

let cn = '1';
let cacheWhiteList = ['1'];
let assetsList = [
    
    '/',
    '/index.html',
    '/app.js',
    '/activity_components/activity.js',
    '/activity_components/chatroom.js',
    '/activity_components/community.js',
    '/activity_components/forum.js',
    '/activity_components/forumcategory.js',
    '/activity_components/home.js',
    '/activity_components/leaderboard.js',
    '/activity_components/login.js',
    '/activity_components/profile.js',
    '/activity_components/ride.js',

       
    
    '/cards/announcements.js',
    '/cards/custom.js',
    '/cards/nearby.js',
    '/cards/stationinformation.js',
    '/cards/weather.js',
    
    '/custom/img.jpg',

    '/dependencies/fonts/hkfonts/HKGrotesk-Regular.woff2',
    '/dependencies/fonts/lnrfonts/Linearicons-Free.woff2',
    '/dependencies/fonts/hk-grotesk.css',
    '/dependencies/fonts/linear-icons.css',
    '/dependencies/scripts/jquery-ajax.js',
    '/dependencies/scripts/vue.js',
    '/store/ajaxmethods.js',
    '/store/communitydata.js',
    '/store/store.js',
    '/styles/style.css',
    '/manifest.json',
    '/sub_components/input-drawable.js',
    '/sub_components/onboarding.js',
    '/sub_components/assistant.js',
    '/sub_components/seeker.js',
    '/sub_components/card.js',
    '/sub_components/weathericon.js',
    '/sub_components/tracking.js',
    '/lib/helper/LocationHelper.js',
    '/icon.png'
    
 
];

// Install Event
self.addEventListener('install', event=>{
    // Open the cache
    event.waitUntil(caches.open(cn)
        .then(cache=>{
            // Fetch all the assets from the array
            return cache.addAll(assetsList);
        }).then(()=>{
            console.log("done caching");
        })
    );
});


self.addEventListener('fetch', event=>{
    event.respondWith(
        caches.match(event.request)
            .then(response=>{
                //Fallback to network
                return response || fetch(event.request);
            })
            .catch(r=>{
                let method = event.request.method;
                let urlContainsApi = event.request.url.indexOf("api");


                if(method !== 'POST'){
                    return caches.match('/')
                }

            })
    );
});

// Remove Old Caches
self.addEventListener('activate', (event)=>{
    event.waitUntil(
        caches.keys().then((keyList)=>{
            return Promise.all(keyList.map((key)=>{
                if(cacheWhiteList.indexOf(key) === -1){
                    return caches.delete(key);
                }
            }));
        })
    );
});