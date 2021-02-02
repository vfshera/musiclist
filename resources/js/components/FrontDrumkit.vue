<template>
    <div class="drumkit container">
        <div class="lds-dual-ring" v-show="isProcessing"></div>
       <div class="drumkit-outer">
           <button class="back-btn p-2" @click.prevent="prevPage"><i class="ti-arrow-left"></i></button>
           <div class="drumkit-inner">
                <div class="kit-sample-img col-md-5">
                    <div class="drumkit-header  mt-5" :style="{ backgroundImage: `url(${ drumkit.image } )` }">

                    </div>

                </div>
               <div class="drumkit-info col-md-6">
                   <h3 class="title">{{ drumkit.title }}</h3>
                   <p v-html="drumkit.about"></p>
               </div>
           </div>
           <div class="updates p-2">
               <button class="download-drumkit" @click.prevent="modalOpenClose('#DownloadModal','open')">
                   <i  class="ti-download" ></i>
               </button>

               <button class="share-drumkit" @click.prevent="modalOpenClose('#shareModal','open')">
                   <i  class="ti-sharethis" ></i>
               </button>
           </div>

       </div>

        <Share :title="drumkit.title" :summary="drumkit.about"  :image="drumkit.image" :shared="'Drumkit'"/>

        <!--        share modal-->

        <div class="modal fade" id="DownloadModal" tabindex="-1" role="dialog" aria-labelledby="DownloadModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-body d-flex flex-column ">
                        <p class="drumkit-question text-center text-black "> {{ (drumkit.isFree) ? 'Download This Drumkit?' : 'Purchase This Drumkit at '+ drumkit.price +'?'}}</p>
                        <div class="drumkit-action">
                            <button class="btn-proceed" @click="checkDrumkit(drumkit.isFree)">Yes{{ (drumkit.isFree) ? '' : ', Check Me Out!'}}</button>
                            <button class="btn-cancel" data-dismiss="modal">No</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--       end DownloadModal -->
    </div>
</template>

<script>
    import Share from "./Share";
export default {
    name: 'DrumkitPost',
    components: {Share},
    data(){
        return{
            drumkit:[],
            isProcessing: true,

        }
    },
    methods:{
        checkDrumkit(isFree){
            this.modalOpenClose('#DownloadModal','close')
            if(isFree){
                this.isProcessing = true;
                this.downloadKit(this.drumkit.id);
            }else if(!isFree){
                this.isProcessing = true;
                this.downloadKit(this.drumkit.id);
            }
        },
        downloadKit(id){
            axios.get('/downloadDrumkit/'+ id,{
                responseType: 'arraybuffer'
            })
                .then(response =>{
                    if(response.status == 200){

                        this.isProcessing = false;

                        Toast.fire('Downloading!')

                    }else{
                        this.isProcessing = false;
                        Toast.fire(response.message)
                    }


                })
                .catch(err =>{
                    console.log(err);
                });
        },
        prevPage(){
            this.$router.go(-1)
        },

        modalOpenClose(name,action){

            if(action === 'open'){

                $(name).modal('show');

            }else  if(action === 'close'){

                $(name).modal('hide');
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

            }
        },
        playKit(){
            let song = {
                title : this.drumkit.type + " - " + this.drumkit.title,
                cover : this.drumkit.image,
                sample : this.drumkit.sample,
            }

            this.$store.commit('setSong',song);

            if(this.$store.getters.getPlayerState != true || this.$store.getters.getPlayerVisibility != true){
                this.$store.commit('setPlayerVisibility', true);
                this.$store.commit('setPlayerState', true);
            }
        },
        setDrumkit(){
            axios.get('/getDrumkit/'+ this.$route.params.id)
                .then(response =>{
                    if(response.status == 200){
                        this.drumkit = response.data.data;

                        if( localStorage.getItem('viewDrumkit')){
                            localStorage.removeItem('viewDrumkit')
                        }

                        localStorage.setItem('viewDrumkit' , JSON.stringify(response.data.data));

                        this.$store.commit('setViewDrumkit', response.data.data);

                        this.isProcessing = false;

                        this.scrollToTop();

                        this.playKit()
                    }else{
                        this.isProcessing = false;
                        Swal.fire('Post Unavailable')
                    }


                })
                .catch(err =>{
                    console.log(err);
                });
        },

        scrollToTop() {
            window.scrollTo(0,0)
        }
    },
    computed:{



    },
    mounted(){
        this.setDrumkit();
        console.log('Drumkit Post Mounted')
    }
}
</script>

<style scoped>
    *,html{
        box-sizing: border-box;
    }

    .drumkit-action{
        margin-top:20px;
        display: flex;
        justify-content: space-around;
    }

    .btn-proceed{
        background-color: #0f6674;
        padding: 10px 50px;
        color: white;
        font-weight: bolder;
        border-radius: 15px;
    }

    .btn-cancel{
        background-color: orangered;
        padding: 10px 50px;
        color: white;
        font-weight: bolder;
        border-radius: 15px;

    }

    .drumkit-question{
        font-size: 1.4rem;

    }


    /*loading */
    .lds-dual-ring {

        display: inline-block;
        width: 80px;
        height: 80px;
    }
    .lds-dual-ring:after {
        position: absolute;
        top:50%;
        left:47%;
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: auto;
        border-radius: 50%;
        border: 6px solid orangered;
        border-color: orangered transparent orangered transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
    /*end loading*/


    .kit-sample-img{
    display: flex;
    flex-direction: column;
}

.drumkit-outer{
    margin-top: 50px;
    display: flex;
    justify-content: space-around;
    width: 78vw;
    padding: 10px;
    background-color: white;
    border-radius: 10px;
}

.drumkit-inner{
    display: flex;
    justify-content: space-around;
    width: 78vw;
}

.updates{
    display: flex;
    align-items: flex-start;

}
.download-drumkit{
    width: 40px;
    height: 40px;
    background-color: #007bff;
    color: white;
    border-radius: 25px;
    transition: .4s ease-in-out;
    margin: 5px;
}
.download-drumkit:hover{
    width: 45px;
    height: 45px;
    background-color: gainsboro ;
    color: #007bff;
    border-radius: 25px;
    transition: .4s ease-in-out;
    margin: 5px;
}
    .share-drumkit{
        margin: 5px;
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .share-drumkit:hover{
        width: 45px;
        height: 45px;
        background-color: #ffffff99;
        color: #007bff;
        border-radius: 45px;
    }
/*loader*/


.loader {
    width: 80px;
    height: 20px;
}
.loader div {
    position: absolute;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: orangered;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.loader div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}
.loader div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}
.loader div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}
.loader div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}
@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }
    100% {
        transform: scale(1);
    }
}
@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }
    100% {
        transform: scale(0);
    }
}
@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }
    100% {
        transform: translate(24px, 0);
    }
}


/*endloader*/


    .drumkit{
        width: 81.4vw;
        min-height: 100vh;
        display: flex;
        border-radius: 15px;
        box-shadow: 0px 0px 10px -10px #111111;
    }
    .title{
        padding: 15px;
        color: black;
    }
    .drumkit-header{
        height: 50vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 7px;
        object-fit: cover;
        background-position: center center;
        background-size: cover;
    }


    .back-btn{
        width: 45px;
        height: 40px;
        margin: .5rem !important;
        background-color: #111111cc;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }


    .back-btn:hover{
        width: 60px;
        height: 50px;
        background-color: #cccccc99;
        color: #111111;
        border-radius: 45px;
    }

    .edit-drumkit{
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .drumkit-info{
        display: flex;
        flex-direction: column;
        padding:15px;
        min-height: 50vh;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        background-image: linear-gradient(0deg,#11111111,#ffffff77);
    }

    .drumkit-info p {
        margin-top: 15px;
        background-color: #ffffff;
        min-height: 42vh;
        border-radius: 15px;
        padding:15px;
        color: black;
    }
</style>
