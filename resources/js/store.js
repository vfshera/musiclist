 import Vuex from 'vuex'
import Vue from 'vue'

 Vue.use(Vuex)
let localReadBlog = localStorage.getItem('readBlog');
let localDrum = localStorage.getItem('viewDrumkit');

 export default  new Vuex.Store({
     state:{
         readBlog: (localReadBlog) ? JSON.parse(localReadBlog) : {},
         currDrumkit: (localDrum) ? JSON.parse(localDrum) : {},
         currBeat: (localDrum) ? JSON.parse(localDrum) : {},
         csrftoken: "",
         isPlayerMax: false,
         loggedUser: null,
         PlayerSeen: false,
         currentSong: null,
         beats:[{
             cover: 'https://images.unsplash.com/photo-1519070813808-1d7a33907487?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&q=60',
             title: 'Afropop Instrumental Joeboy Type Beat - Selfie',
             sample: '/storage/beats/selfie.mp3',
             time: '4:05',
             bpm: '90.0',
             license: 'FREE',
             isFree: true,
         },
             {
                 cover: 'https://i.pinimg.com/564x/3f/3c/d9/3f3cd93dc8ab87be3722fa1462295727.jpg',
                 title: 'Agressive Trap Beat Tekashi Type Beat - Smoked',
                 sample: '/storage/beats/Smoked.mp3',
                 time: '2:34',
                 bpm: '95.0',
                 license: '$14.50',
                 isFree: false,
             },
             {
                 cover: 'https://images.unsplash.com/photo-1519070813808-1d7a33907487?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&q=60',
                 title: 'Damian Marley Type Beat - Tribe',
                 sample: '/storage/beats/tribe.mp3',
                 time: '3:00',
                 bpm: '75.0',
                 license: 'FREE',
                 isFree: true,
             },
             {
                 cover: 'https://i.pinimg.com/564x/3f/3c/d9/3f3cd93dc8ab87be3722fa1462295727.jpg',
                 title: 'Dancehall Beat Ethic X Boondocks Type Beat- Comma',
                 url: '/storage/beats/comma.mp3',
                 time: '3:42',
                 bpm: '95.0',
                 license: 'FREE',
                 isFree: true,
             },
             {
                 cover: 'https://images.unsplash.com/photo-1519070813808-1d7a33907487?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&q=60',
                 title: 'Dark Trap Instrumental Hopsin X Dax Type Beat - Bleed ',
                 sample: '/storage/beats/bleed.mp3',
                 time: '3:55',
                 bpm: '100.0',
                 license: '$21.50',
                 isFree: false,
             },
             {
                 cover: 'https://images.unsplash.com/photo-1519070813808-1d7a33907487?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&q=60',
                 title: 'Future X Migos Type Beat - City',
                 sample: '/storage/beats/city.mp3',
                 time: '3:40',
                 bpm: '75.0',
                 license: 'FREE',
                 isFree: true,
             },
             {
                 cover: 'https://i.pinimg.com/564x/3f/3c/d9/3f3cd93dc8ab87be3722fa1462295727.jpg',
                 title: 'Zouk Instrumental Afropop Beat - Penzi',
                 sample: '/storage/beats/penzi.mp3',
                 time: '3:47',
                 bpm: '95.0',
                 license: '$25.30',
                 isFree: false,
             }]
     },
     getters:{
         getCSRFTOKEN(state){
             return state.csrftoken;
         },
         getPlayerState(state){
             return state.isPlayerMax;
         },
         getPlayerVisibility(state){
             return state.PlayerSeen;
         },
         getLoggedUser(state){
             return state.loggedUser;
         },
         getSong(state){
             return state.currentSong ? state.currentSong : state.beats[0];
         },
         getBeats(state){
             return state.beats
         },
         getReadBlog(state){
            return state.readBlog;
         } ,
         getCurrDrumkit(state){
            return state.currDrumkit;
         },
         getCurrBeat(state){
            return state.currBeat;
         }
     },
     mutations: {
         setCSRF(state,token) {
             state.csrftoken = token;
         },
         setPlayerState(state,playerState){
             state.isPlayerMax = playerState
         },
         setLoggedUser(state,user){
             state.loggedUser = user
         },
         setSong(state , song){
            state.currentSong = song
         },
         setPlayerVisibility(state, visibility){
              state.PlayerSeen = visibility;
         },
         setReadBlog(state, blog){
             state.readBlog = blog;
         },
         setViewDrumkit(state, drumkit){
             state.currDrumkit = drumkit;
         },
         setViewBeat(state, track){
             state.currBeat = track;
         },

     },
     actions: {
         fetchUser(context){
           context.commit('setCSRF',token);
         },
         setPlayerState(context){
             context.commit('setPlayerState',newPlayerState);
         },
         setReadBlog(context){
             context.commit('setReadBlog',blog);
         }
     }
 })

