 import Vuex from 'vuex'
import Vue from 'vue'

 Vue.use(Vuex)


let localReadBlog = localStorage.getItem('readBlog');
let localDrum = localStorage.getItem('viewDrumkit');
let localBeat = localStorage.getItem('viewBeat');

let localDrumCart = localStorage.getItem('kitCart');
let localBeatCart = localStorage.getItem('beatCart');


 export default  new Vuex.Store({
     state:{
         readBlog: (localReadBlog) ? JSON.parse(localReadBlog) : {},
         currDrumkit: (localDrum) ? JSON.parse(localDrum) : {},
         currBeat: (localBeat) ? JSON.parse(localBeat) : {},
         csrftoken: "",
         isPlayerMax: false,
         loggedUser: {},
         PlayerSeen: false,
         currentSong: {},
         beats:[],
         drumkits:[],
         beatcart: (localBeatCart) ? JSON.parse(localBeatCart) : [],
         kitcart: (localDrumCart) ? JSON.parse(localDrumCart) : [],
         basicPrice: '',
         beatLicenses: []
     },
     getters:{
         getBeatLicenses(state){
             return state.beatLicenses;
         },
         getBasicPrice(state){
             return state.basicPrice[0];
         },
         getBeatCart(state){
             return state.beatcart;
         },
         getKitCart(state){
             return state.kitcart;
         },
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
             return state.currentSong;
         },
         getBeats(state){
             return state.beats
         },
         getKits(state){
             return state.drumkits
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
         setPurchaseLicense(state, beat ,index) {
             state.beatcart.splice(index,1)
             state.beatcart.push(beat);
         },
         setBasicLicense(state, basic) {
             state.basicPrice = basic;
         },
         setLicenses(state, licenses) {
             state.beatLicenses = licenses;
         },
         setBeatCart(state, beatItems) {
             state.beatcart.push(beatItems);
         },
         setKitCart(state, kitItems) {
             state.kitcart.push(kitItems);
         },
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
         setBeats(state, beats){
             state.beats = beats;
         },
         setKits(state, kits){
             state.beats = kits;
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

