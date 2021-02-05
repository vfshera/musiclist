<template>
    <div class="beat-container p-2">
        <div class="beat">
            <div class="beat-header ">
                <button class="back-btn " @click.prevent="prevPage"><i class="ti-arrow-left"></i></button>
                <div class="beat-title ">
                    <SimplePlayer :music="beat"/>
                </div>
                <div class="updates p-2 ">
                    <button class="edit-beat" @click.prevent="editBeat">
                        <i  class="ti-pencil" ></i>
                    </button>
                    <button class="delete-beat " @click.prevent="deleteBeat(beat.id)">
                        <i  class="ti-trash" ></i>
                    </button>
                </div>
            </div>
            <div class="lds-dual-ring" v-show="isProcessing"></div>
            <div class="beat-cover-info pt-2 px-3">
                <div class="beat-cover">
                    <img :src="beat.cover" :alt="beat.title" height="300px">

                </div>
                <div class="beat-info">
                    <h3>Details</h3>
                    <div class="d-flex pt-3">
                        <span class="font-weight-bold">TAGS :</span>
                        <div class="beat-tags  d-flex ">
                            <span class="mx-1  badge badge-dark py-1 px-3 " v-for="tag in beat.tags.split(',')">
                                #{{ tag }}
                            </span>
                        </div>
                    </div>
                    <div class="beat-about pt-2"><span class="font-weight-bold">BPM & KEY : </span>{{ beat.bpmkey }}</div>
                    <div class="pt-2">
                        <span class="font-weight-bold">{{ beat.title }} </span> is {{ (beat.isFree) ? 'Not For Sale' : 'For Sale'}}.
                        <div class=" pt-2 font-weight-bold">Pick Your Package Below : </div>
                        <div class="beat-license">
                            <button class="bronze">BRONZE</button>
                            <button class="silver">SILVER</button>
                            <button class="gold">GOLD</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</template>

<script>
    import SimplePlayer from "./SimplePlayer";
    export default {
        name: 'Beat',
        components: {SimplePlayer},
        data(){
            return{
                beat:null,
                isPosting: false,
                isProcessing: true,
                editedBeat: {
                    beat:null,
                    title: '',
                    about: '',
                    tags: [],
                    tag: '',
                    price: '',
                    cover:null,
                    sample: null
                },
            }
        },
        methods:{
            validate(){
                if(this.editedBeat.beat != null && this.editedBeat.title  != null &&  this.editedBeat.about != null &&    this.editedBeat.cover != null &&   this.editedBeat.sample != null){
                    return true;
                }else{
                    return false;
                }
            },
            resetBeat(){

                this.editedBeat.beat = null;
                this.editedBeat.title = '';
                this.editedBeat.type = '';
                this.editedBeat.about = '';
                this.editedBeat.cover = null;
                this.editedBeat.sample = null;

            },
            getBeatZip(e){
                this.editedBeat.beat = e.target.files[0];
            },
            getBeatCover(e){
                this.editedBeat.cover = e.target.files[0];
            },
            getBeatSample(e){
                this.editedBeat.sample = e.target.files[0];
            },
            deleteBeat(id){
                Swal.fire({
                    title: 'Delete Beat?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/deleteBeat/'+ id)
                            .then(response => {
                                if(response.status == 200) {

                                    Toast.fire({
                                        icon: 'success',
                                        title: response.data
                                    });

                                    localStorage.removeItem('viewBeat')
                                    this.$store.commit('setViewBeat', {});
                                    this.prevPage();
                                }else if(response.status == 403){
                                    Toast.fire({
                                        icon: 'error',
                                        title: response.data
                                    });
                                }else{
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Something wiered Happened!'
                                    });
                                }

                            })
                            .catch(err => {
                            })
                    }
                })

            },
            updateBeat(){
                if(this.validate()){
                    this.isPosting = true;

                    let fd = new FormData();

                    fd.append('image',this.editedBeat.cover)
                    fd.append('title',this.editedBeat.title)
                    fd.append('type',this.editedBeat.type)
                    fd.append('sample',this.editedBeat.sample)
                    fd.append('beat',this.editedBeat.beat)
                    fd.append('about',this.editedBeat.about)

                    axios.post( '/updateBeat/'+this.editedBeat.id,fd,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }).then( res =>{
                        this.isPosting = false;

                        if(res.status == 201){


                            Toast.fire({
                                icon: 'success',
                                title: res.data
                            });

                            this.modalOpenClose('#EditBeatModal','close');
                            this.refreshBeat();

                        }else if(res.status == 403){
                            Toast.fire({
                                icon: 'error',
                                title: res.data
                            });
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: 'Something wiered Happened!'
                            });
                        }

                    }).catch(err => {
                        console.log(err)
                    })



                }else{
                    Swal.fire('Fill The Form')
                }
            },
            prevPage(){
                this.$router.go(-1)
            },
            editBeat(){
                this.editedBeat = this.beat;
                this.modalOpenClose('#EditBeatModal','open');
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
            setBeat(){
                axios.get('/getBeat/'+ this.$route.params.id)
                    .then(response =>{
                        if(response.status == 200){
                            this.beat = response.data.data;

                            if( localStorage.getItem('viewBeat')){
                                localStorage.removeItem('viewBeat')
                            }

                            localStorage.setItem('viewBeat' , JSON.stringify(this.beat));

                            this.$store.commit('setViewBeat', this.beat);

                            this.isProcessing = false;

                            this.scrollToTop();
                            this.selectTrack(this.$store.getters.getCurrBeat);
                        }else{
                            this.isProcessing = false;
                            Swal.fire('Beat Unavailable')
                        }


                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            selectTrack(song){

                this.$store.commit('setSong',song);

                if(this.$store.getters.getPlayerState != true || this.$store.getters.getPlayerVisibility != true){
                    this.$store.commit('setPlayerVisibility', true);
                    this.$store.commit('setPlayerState', true);
                }

            },

            scrollToTop() {
                window.scrollTo(0,0)
            },
            refreshBeat(){

                axios.get( '/getBeat/'+this.editedBeat.id).then(resp => {

                    if( localStorage.getItem('readBeat')){
                        localStorage.removeItem('readBeat')
                    }

                    localStorage.setItem('readBeat' , JSON.stringify(resp.data));
                    this.$store.commit('setReadBeat', resp.data);

                    this.setBeat()

                }).catch(err => {
                    Toast.fire(err)
                })

            }
        },
        computed:{
            numOfCharacters:function () {
                return this.editedBeat.about.length;
            }
        },
        mounted(){
            this.setBeat();
            console.log('Beat Post Mounted')
        }
    }
</script>

<style scoped>
    .beat-license{
        border-top: 2px #11111111 solid;
        padding: 15px;
        margin-top: 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .bronze , .silver , .gold{
        color: white;
        font-weight: bold;
        height: 40px;
        width: 120px;
        border-radius: 10px;
    }


    .bronze{
        background-color: #905923;

    }

    .silver{
        background-color: #9a9a9a;
    }

    .gold{
        background-color: #b39700;
    }


    .beat-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .beat{
        display: flex;
        flex-direction: column;
        min-height: 50vh;
        background: white;
        border-radius: 10px;
        width:99.4%;
        margin-bottom: 30vh;
    }

    .beat-cover-info{
        display: flex;
        justify-content: space-between;
    }

    .beat-cover{

    }

    .beat-info{
        min-width: 49%;
        max-width: 50%;
    }
    .beat-container{
        height: 100%;
        width: 100%;
        display: flex;
        justify-content: center;
    }
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

    .beat-title{
        min-width: 85%;
        height: 60%;
    }
    .back-btn{
        width: 45px;
        height: 40px;
        margin: .5rem !important;
        color: #111111;
        transition: transform .3s ease-in-out;
    }


    .back-btn:hover{
        transform: scale(1.5);
    }

    .edit-beat{
        width: 40px;
        height: 40px;
        color: #007bff;
        transition: transform .3s ease-in-out;
    }

    .edit-beat:hover{
        transform: scale(1.5);
    }

    .delete-beat{
        margin-left: 10px;
        width: 40px;
        height: 40px;
        color: red;
        transition: transform .3s ease-in-out;
    }

    .delete-beat:hover{
        transform: scale(1.5);
    }


</style>
