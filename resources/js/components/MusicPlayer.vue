<template>
    <div class="music-player " :class="{ 'player-full': this.$store.getters.getPlayerState }" v-show="this.$store.getters.getPlayerVisibility">
        <div class="player container ">
            <div class="song-cover " >
                <img :class=" { 'music-fx': isPlaying }" :src="this.$store.getters.getSong.cover" alt="">

            </div>
            <div class="player-controls">
               <div class="player-btns">

                       <div class="prev">
                           <span class="ti-control-skip-backward"></span>
                       </div>
                       <div class="play" >
                           <span class="play-pause" :class=" { 'ti-control-play': !isPlaying , 'ti-control-pause playing': isPlaying }"></span>
                       </div>
                       <div class="next">
                           <span class="ti-control-skip-forward"></span>
                       </div>


               </div>
                <div class="player-info">
                    <div class="current-time">
                        0:00
                    </div>
                    <div class="about-song">
                        <div class="song-info" :class="{ 'name-playing': isPlaying }">
                            {{ this.$store.getters.getSong.title }}
                        </div>
                        <div class="song-progress">
                            <div class="song-progress-bar">
                                <div class="seeker"></div>
                            </div>
                        </div>
                    </div>
                    <div class="end-time">
                        0:00
                    </div>
                </div>
                <div class="right-controls">
                    <div class="volume-btn">
                        <span id="vol-state" class="ti-volume"></span>
                    </div>
                    <div class="vol-bg">
                        <div class="vol-seeker"></div>
                    </div>
                    <div class="mini-player" >
                        <span :class="{ 'ti-pin2': !this.$store.getters.getPlayerState , 'ti-angle-down': this.$store.getters.getPlayerState}"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    const audio = new Audio();

    export default {
        name : 'MusicPlayer',
        data(){
          return{
              isPlaying: false,
              max:true,
              currSong: '',
          }
        },
        methods:{
            minmax(){

                if(this.max){
                    this.max = false;

                }else{
                    this.max = true
                }
            },

            initPlayer(songUrl){

                audio.src =  songUrl
                // audio.src = "/storage/beats/"+ songUrl

                audio.addEventListener(
                    "loadeddata",
                    () => {
                        document.querySelector(".end-time").textContent = this.getTimeCodeFromNum(
                            audio.duration
                        );
                        audio.volume = .65;
                        audio.pause();

                        audio.play();
                        this.$store.commit('setPlayerState',true);
                        this.isPlaying = true;
                        this.setVolIcon(audio.volume);
                    },
                    false
                );

            //click on timeline to skip around
                const seeker = document.querySelector(".song-progress-bar");
                const forward = document.querySelector(".next");
                const backward = document.querySelector(".prev");
                seeker.addEventListener("click", e => {
                    const seekerWidth = window.getComputedStyle(seeker).width;
                    const timeToSeek = e.offsetX / parseInt(seekerWidth) * audio.duration;
                    audio.currentTime = timeToSeek;
                    document.querySelector(".seeker").style.width = timeToSeek * 100 + '%';

                }, false);

                forward.addEventListener("click", e => {
                    const seekerWidth = window.getComputedStyle(seeker).width;
                    ((audio.duration - 5) != audio.currentTime) ? audio.currentTime  += 5 :  audio.currentTime =  audio.duration
                    document.querySelector(".seeker").style.width =  (audio.currentTime / audio.duration ) * 100 + '%';
                    this.playerToast("Forward 15s")

                }, false);

                backward.addEventListener("click", e => {
                    const seekerWidth = window.getComputedStyle(seeker).width;
                    (audio.currentTime > 5) ? audio.currentTime = audio.currentTime -= 5 :  audio.currentTime = 0
                    document.querySelector(".seeker").style.width =  (audio.currentTime / audio.duration ) * 100 + '%';

                    this.playerToast("Backward 15s")
                }, false);


            //click volume slider to change volume
                const volumeSlider = document.querySelector(".vol-bg");
                volumeSlider.addEventListener('click', e => {
                    const sliderWidth = window.getComputedStyle(volumeSlider).width;
                    const newVolume = e.offsetX / parseInt(sliderWidth);
                    audio.volume = newVolume;
                    document.querySelector(".vol-seeker").style.width = newVolume * 100 + '%';

                    this.setVolIcon(newVolume * 100);

                }, false)

                document.querySelector('.mini-player').addEventListener('click', () =>{
                    audio.pause();
                    audio.currentTime = 0;
                    this.isPlaying = false;

                    document.querySelector('.music-player').style.position = 'static';
                    this.$store.commit('setPlayerState' , !this.$store.getters.getPlayerState );

                })

            //check audio percentage and update time accordingly
                setInterval(() => {
                    const progressBar = document.querySelector(".seeker");
                    progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
                    document.querySelector(".current-time").textContent = this.getTimeCodeFromNum(
                        audio.currentTime
                    );
                }, 500);


            //toggle between playing and pausing on button click
                const playBtn = document.querySelector(".play-pause");
                playBtn.addEventListener(
                    "click",
                    () => {
                        if (audio.paused) {
                            this.isPlaying = true;
                            audio.play();
                            this.playerToast("Playing Song!")
                            this.$store.commit('setPlayerState',true);
                        } else {
                            this.isPlaying = false;
                            audio.pause();
                            this.playerToast("Song Paused")
                        }
                    },
                    false
                );

                document.querySelector(".volume-btn").addEventListener("click", () => {

                    audio.muted = !audio.muted;
                    if (audio.muted) {
                        this.setVolIcon(0)
                    } else {
                        this.setVolIcon(audio.volume)
                    }
                });



            },
            playerToast(message){
                Toast.fire({
                    title: message,
                    position: 'center'
                })


            }
            ,
            setVolIcon(vol){
                const volumeEl = document.querySelector("#vol-state");
               if (vol != 0){
                   volumeEl.style.color =  'white';
                   document.querySelector(".vol-seeker").style.backgroundColor = 'orangered';
               }else {
                   document.querySelector(".vol-seeker").style.backgroundColor = '#ff450055';
                   volumeEl.style.color =  'orangered';
               }
            },
            getTimeCodeFromNum(num){
                //turn 128 seconds into 2:08
                let seconds = parseInt(num);
                let minutes = parseInt(seconds / 60);
                seconds -= minutes * 60;
                const hours = parseInt(minutes / 60);
                minutes -= hours * 60;

                if (hours === 0){
                    return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
                }else{
                    return `${String(hours).padStart(2, 0)}:${minutes}:${String(
                        seconds % 60
                    ).padStart(2, 0)}`;
                }

            },
        },
        computed: {
            playerVisible: function(){
                return this.$store.getters.getPlayerVisibility;
             },
            selectedSong: function () {
                return this.$store.getters.getSong;
            }
        }
      ,
        watch:{
            playerVisible: function(seen){
                if(seen == true){
                    this.initPlayer(this.$store.getters.getSong.sample);
                }
                this.currSong =  this.selectedSong;
            },

            selectedSong: function (newSong) {
                if(newSong.title != this.currSong){
                    this.initPlayer(this.$store.getters.getSong.sample);
                    this.currSong =  this.selectedSong;
                }
            }

        },
        mounted() {

        }
    }
</script>
<style scoped>

    .ti-angle-down , .ti-pin2{
        font-size: .8em !important;

    }




    .song-info{
        font-weight: bold;
    }

    .name-playing{
        background: linear-gradient(90deg, #ff0000,#ffff00,#ff00f3,#0033ff,#7fff00,#ff00c4,#08f7fe,#f5d300,#a5d8f3,#fdc7d7,#00feca,#ff8b8b,#f85125,#ce96fb,#ff0000);
        background-size: 1000%;
        -webkit-text-fill-color: transparent;
        -webkit-background-clip: text;
        animation: smoothgradient 100s linear infinite;
    }

    @keyframes smoothgradient {
        0% {
            background-position: 0%;
     }
        100%{
            background-position: 1000%;

        }
    }

    .mini-player:hover{
        border: 1px #ffffff22 solid;
    }

    .mini-player{
        position: absolute;
        right: 5%;
        height: 30px;
        width: 30px;

        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        border-radius: 20px;

        cursor: pointer;
    }

    @keyframes xbutton {
      0%{
          color: #ff4500;
      }
        80%{
            color: #ff4500cc;
        }

    }
    .mini-player span {
        color: #ff4500;
        animation: xbutton 1s linear infinite;
        font-size:20px;
        transform: scale(1.4);
        transition: 10ms ease-in-out;
    }

    .mini-player span:hover {
        font-size:25px;
        transform: scale(1.5);
    }

    *{
        box-sizing: border-box;
    }
    .music-fx{
             box-shadow: 1px 1px orangered;
    }

    .ti-control-skip-forward , .ti-control-skip-backward , .ti-control-play , .ti-control-pause , .ti-volume{
        font-size: 1.4em;
        transition: 5ms ease-in-out;
        cursor: pointer;
    }

    .ti-control-play , .ti-control-pause{
        font-size: 1.6em;
        transition: 5ms ease-in-out;
        cursor: pointer;
    }

    .ti-control-skip-forward:hover , .ti-control-skip-backward:hover  {

        color: orangered;
        cursor: pointer;
    }

    .ti-control-pause:hover , .ti-control-play:hover {
        font-size: 1.6em;
        background-color: #ffffff14;
        padding: 10px;
        border-radius: 12px;
        color: orangered;
        cursor: pointer;
    }

    .playing{
        background-color: #ffffff14;
        padding: 7px;
        border-radius: 12px;
        border: 2px orangered solid;
    }
    .ti-volume:hover{
        font-size: 1.4em;
        color: orangered;
        cursor: pointer;
    }


    .song-progress-bar{
        margin-top: 7px;
        background-color: #ffffff;
        height: 5px;
        border-radius: 10px;
        width: 80%;
    }

    .seeker{
        background-color: orangered;
        height: 100%;
        border-radius: 7px;
        width: 78%;
    }


    .vol-bg{

        background-color: #ffffff11;
        height: 5px;
        border-radius: 5px;
        width: 75%;
    }

    .vol-seeker{
        background-color: orangered;
        height: 100%;
        border-radius: 5px;
        width: 50%;
    }

    .volume-btn{
        width: 20%;
    }

    .player-info{
        width: 73%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .about-song{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content:center;
        width: 70%;
    }
    .player-btns{
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 12%;
    }
    .music-player{
        background-color: #111111;
        height: 60px;
        width: 100%;
        z-index: 100;
    }

    .player-full{
        position: fixed !important;
        bottom: 0 !important;
    }
    .player{
        color: #FFFFFF;
        height: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .song-cover{
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        width: 10%;
    }

    .song-cover img{
        height: 70%;
        border-radius: 5px;
        width: 50%;
    }
    .player-controls{
        width: 90%;
        display: flex;
        justify-content: space-between;
    }


    .right-controls{

        width: 15%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }



    .current-time , .end-time{
        font-size: 1rem;
        font-weight: 600;

    }

    .song-progress{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
</style>
