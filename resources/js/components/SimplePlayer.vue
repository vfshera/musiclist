<template>
    <div class="music-player player-full" >
        <div class="player container ">

            <div class="player-controls">
               <div class="player-btns">

                       <div class="play" >
                           <span class="play-pause" :class=" { 'ti-control-play': !isPlaying , 'ti-control-pause playing': isPlaying }"></span>
                       </div>

               </div>
                <div class="player-info">
                    <div class="current-time">
                        0:00
                    </div>
                    <div class="about-song">
                        <div class="song-info" :class="{ 'name-playing': isPlaying }">
                            {{ this.music.title }}
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

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    const audio = new Audio();

    export default {
        name : 'SimplePlayer',
        props : ["music"],
        data(){
          return{
              isPlaying: false,
              max:true,

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

                audio.addEventListener(
                    "loadeddata",
                    () => {
                        document.querySelector(".end-time").textContent = this.getTimeCodeFromNum(
                            audio.duration
                        );
                        audio.volume = .65;
                        audio.loop = true;
                        audio.pause();
                        audio.play();
                        this.isPlaying = true;
                        this.setVolIcon(audio.volume);
                    },
                    false
                );

            //click on timeline to skip around
                const seeker = document.querySelector(".song-progress-bar");
                seeker.addEventListener("click", e => {
                    const seekerWidth = window.getComputedStyle(seeker).width;
                    const timeToSeek = e.offsetX / parseInt(seekerWidth) * audio.duration;
                    audio.currentTime = timeToSeek;
                    document.querySelector(".seeker").style.width = timeToSeek * 100 + '%';

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
                        } else {
                            this.isPlaying = false;
                            audio.pause();
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
        watch:{
            $route (to, from){
                audio.pause();
            }
        },

        mounted() {

                this.initPlayer(this.music.sample);
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

     .ti-volume{
        font-size: 1.2em;
         transition:transform 5ms ease-in-out;
        cursor: pointer;
    }

    .ti-control-play , .ti-control-pause{

        font-size: 1em;
        transition:transform 5ms ease-in-out;
        cursor: pointer;
    }



    .ti-control-pause:hover , .ti-control-play:hover {
        transform: scale(1.1);
        background-color: #ffffff14;
        padding: 5px;
        border-radius: 8px;
        color: orangered;
        cursor: pointer;
    }

    .playing{
        transform: scale(1.1);
        background-color: #ffffff14;
        padding: 3px;
        border-radius: 8px;
        border: 2px orangered solid;
    }
    .ti-volume:hover{
        transform: scale(1.1);
        color: orangered;
        cursor: pointer;
    }


    .song-progress-bar{

        margin-top: 2px;
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

        background-color: #ffffff44;
        height: 5px;
        border-radius: 5px;
        width: 60%;
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
     background-color: #1d2124;
     /*background-color: #111111fd;*/
        height: 43px;
        width: 100%;
        z-index: 100;
        border-radius: 30px;
    }

    .player-full{
        /*position: fixed !important;*/
        /*bottom: 0 !important;*/
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
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0px 3px;
    }


    .right-controls{
        width: 15%;
        display: flex;
        justify-content: space-around;
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
