<template>
    <div class="beats">
        <div class="beats-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="beat-menu px-3 py-3">
                <h3>Beats</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search Beats ...">
                </div>
                <button class="btn btn-primary rounded-pill new-btn" data-toggle="modal" data-target="#addBeatModal"> <span class="ti-pencil-alt mr-2"></span>NEW</button>
            </div>
            <div class="beat-cards px-3 pt-3">
                <div class="track beat row " v-for="track in searchableBeats"  @click.prevent="showBeat(track)" >
                    <div  class="col-md-1 ">
                        <img class="cover" :src="track.cover" :alt="track.title" height="50px" width="50px" style="object-fit: cover">
                    </div>
                    <div class="col-md-4 title-container">
                        <span class="title" > {{ track.title }}</span>
                    </div>
                    <div  class="col-md-1 text-center">
                        <span class="time "> {{ track.time }}</span>
                    </div>
                    <div class="col-md-1 text-center">
                        <span class="bpm">{{ track.bpm }}</span>
                    </div>
                    <div  class="col-md-4 text-center track-tags">

                        <span v-for="tag in track.tags.split(',')">
                            #{{ tag }}
                        </span>
                    </div>
                    <div  class="col-md-1 text-center ">
                        <p class="free-price" v-if="track.isFree">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="black" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="price-amount">{{ track.price }}</span>
                        </p>

                        <p class="price" v-if="!track.isFree">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="24" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="price-amount text-black">{{ track.price }}</span>
                        </p>
                    </div>
                </div>

            </div>

            <div class="beat-controls px-4" >
                <ul class="pagination" v-show="pagination.last_page > 1">
                    <li :class="{ 'disabled' : !pagination.prev_url }" class="page-item">
                        <a class="page-link" href="" @click.prevent="fetchBeats(pagination.prev_url)">Prev</a>
                    </li>
                    <li class="page-item disabled" >
                  <span class="page-link text-dark">
                   Page {{ pagination.current_page }} of {{ pagination.last_page }}
                  </span>
                    </li>
                    <li class="page-item" :class="{ 'disabled' : !pagination.next_url }">
                        <a class="page-link" href="" @click.prevent="fetchBeats(pagination.next_url)">Next</a>
                    </li>
                </ul>
            </div>
        </div>

        <!--        add beat modal-->
        <div class="modal fade" id="addBeatModal" tabindex="-1" role="dialog" aria-labelledby="addBeatModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addBeatModalLongTitle" style="display: inline-block">Add Beat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="posting-beat" v-if="isPosting">
                            <div class="loader"><div></div><div></div><div></div><div></div></div>
                            <h6>Posting...</h6>
                        </div>
                        <div class="add-beat-body px-1 ">
                            <div class="row beat-head ">
                                <div class="cover-key-tags col-md-6">
                                    <div class="cover ">
                                        <label for="beat-cover">Beat Cover</label>
                                        <input @change="getBeatCover" id="beat-cover" required type="file" class="form-control mt-2">
                                    </div>

                                    <div class="content-link">
                                        <label for="sample">Sample Audio</label>
                                        <input @change="getBeatSample" id="sample" required type="file" class="form-control mt-2">
                                    </div>

                                    <div class="zip">
                                        <label for="beat-key">BPM , Key</label>
                                        <input v-model="bpmkey" id="beat-key" required type="text" class="form-control mt-2" placeholder="As 96.0 , C# Major ....">
                                    </div>

                                    <div class="tags">
                                        <label for="beat-tags">Beat Tags</label>
                                        <input id="beat-tags" v-model.trim="tag" required type="text" @keypress.prevent.stop.enter="addTag" class="form-control mt-2"  placeholder="Afrobeat , Gengetone , Hip Hop ....">
                                    </div>
                                </div>
                                <div class="link-n-title col-md-6">
                                    <div class="beat-title ">
                                        <label for="title">Beat Title</label>
                                        <input type="text" id="title" required v-model="title" name="title" class="form-control mt-2" placeholder="Beat title goes here ....">
                                    </div>

                                    <div class="basic ">
                                        <label for="basic-link ">BASIC LICENSE
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="basic-link" required type="text"  v-model="basic" class="form-control mt-2" placeholder="Link to Basic Beat">
                                    </div>
                                    <div class="premium ">
                                        <label for="premium-link ">PREMIUM LICENSE
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="premium-link" required type="text"  v-model="premium" class="form-control mt-2" placeholder="Link to Premium Beat">
                                    </div>
                                    <div class="unlimited ">
                                        <label for="unlimited-link ">UNLIMITED LICENSE
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="unlimited-link" required type="text"  v-model="unlimited" class="form-control mt-2 " placeholder="Link to Unlimited Beat">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="freecustomRadio" name="free"  @change="setBeatValue">
                                    <label class="custom-control-label" for="freecustomRadio">Free Beat</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="paidcustomRadio" name="paid" value="true" @change="setBeatValue">
                                    <label class="custom-control-label" for="paidcustomRadio">Paid Beat</label>
                                </div>
                            </div>
                            <div class="tags-list col-md-12" v-show="tags.length > 0">
                                <span>TAGS </span>
                                <ul class="tags-ul">
                                    <li class="tag-item px-2 mx-1" v-for="(tag, index) in setTags" :key="index">
                                        <span>{{ tag }}</span>
                                        <span @click="tags.splice(index, 1)" style="cursor: pointer">&times;</span>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="postBeat" class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                focused : false,
                beats: [],
                search: '',
                isProcessing: true,
                isPosting: false,
                title: '',
                tags: [],
                tag: '',
                bpmkey: '',
                basic: '',
                premium: '',
                unlimited: '',
                isFree: false,
                cover:null,
                sample: null,
                pagination: {}

            }
        },
        methods:{
            setBeatValue(e){
                console.log(e.target.name)
            },
            formatTags(tags){
               var tags = tags.split(",")

                return tags;
            },
            showBeat(track){

                let title = track.title.toLowerCase().replace(/ /g , "-");
                let id = track.id;

                this.$router.push({ name : 'viewBeat' , params : {  id , title } })

            },
            addTag() {
                if (this.tag && !this.tags.includes(this.tag)) {
                    if(this.tags.length < 5){
                        this.tags.push(this.tag);
                        this.tag = '';
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Max Tags Limit Reached!',
                        })
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Tag Already Exists!',
                    })
                }
            },

            resetBeat(){
                this.beat = null;
                this.title = '';
                this.tags = [];
                this.bpmkey = '';
                this.basic = '';
                this.premium = '';
                this.unlimited = '';
                this.cover = null;
                this.sample = null;
            },
            viewBeat(beat){
                this.isProcessing = true;

                if( localStorage.getItem('viewBeat')){
                    localStorage.removeItem('viewBeat')
                }

                localStorage.setItem('viewBeat' , JSON.stringify(beat));

                this.$store.commit('setViewBeat', beat);
                this.isProcessing = false;

                let title = beat.title.toLowerCase().replace(/ /g , "-");
                let id = beat.id;
                this.$router.push({ name : 'viewBeat' , params : {  id , title }})

            },
            postBeat(){
                this.isPosting = true;

                let fd = new FormData();
                fd.append('cover',this.cover)
                fd.append('title',this.title)
                fd.append('sample',this.sample)
                fd.append('basic',this.basic)
                fd.append('bpmkey',this.bpmkey)
                fd.append('premium',this.premium)
                fd.append('unlimited',this.unlimited)
                fd.append('tags',this.tags)


                axios.post( '/addBeat',fd,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then( res =>{
                    this.isPosting = false;

                    if(res.status == 201){
                        Fire.$emit('BeatChanged');

                        Toast.fire({
                            icon: 'success',
                            title: res.data
                        });

                        this.resetBeat();

                        this.modalOpenClose('#addBeatModal', 'close');

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
            },
            fetchBeats(beatsurl){
                let beats_url = beatsurl || '/getBeats';

                axios.get(beats_url)
                    .then(response =>{
                        this.beats = response.data.data;

                        this.makePagination(response.data.meta , response.data.links)

                        this.isProcessing = false;
                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            makePagination(meta , links){
                this.pagination  = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    first_url : links.first,
                    last_url : links.last,
                    next_url : links.next,
                    prev_url : links.prev,
                }
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
            getBeatZip(e){
                this.beat = e.target.files[0];
            },
            getBeatCover(e){
                this.cover = e.target.files[0];
            },
            getBeatSample(e){
                this.sample = e.target.files[0];
            },
            searchFocused(value){
                this.focused = value;
            },
        },
        computed:{
            searchableBeats:function (){
                return this.beats.filter(beat => {
                    return beat.title.toLowerCase().match(this.search.toLowerCase())  ||  beat.tags.toLowerCase().match(this.search.toLowerCase());
                });
            },
            numOfCharacters:function () {
                return this.about.length;
            },
            setTags:function () {
                return this.tags;
            },



        },
        mounted() {
            this.fetchBeats();

            Fire.$on('BeatChanged',()=>{
                this.fetchBeats();

                console.log("Beat Changed");
            });

            console.log('Beats Component mounted.')
        }
    }
</script>

<style scoped>

    .basic label i{
        color: #ffd300;
    }
    .premium label i{
        color: #007bff;
    }
    .unlimited label i{
        color: green;
    }
    .tags-list{
        height: 15%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-top: 10px;
    }
    .tags-list span{
        font-weight: bold;
        margin: 5px;
    }
    .tags-ul {
        display: flex;
    }
    .tags-ul .tag-item{
        height: 100%;
        background-color: #111111;
        color: white;
        border-radius: 5px;
    }

    .track-tags{
        font-size: .75rem;
    }

    .track-tags span {
        color: white;
        background-color: #908887;
        padding: 3px 7px;
        margin: 0px 3px;
        border-radius: 5px;
    }
    .typing-progress{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .lds-dual-ring {

        display: inline-block;
        width: 80px;
        height: 80px;
    }
    .lds-dual-ring:after {
        position: absolute;
        top:45%;
        left:56%;
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
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

    .posting-beat{
        position: absolute;
        top: 49%;
        left: 43%;
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



    .content-link input , .beat-title input{
        width: 100%;
    }
    .link-n-title{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .content-body{

    }
    .add-beat-body{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        min-height:60vh;

    }

    .beat-cover{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: flex-start;
    }

    .beat-title{

    }

    .beat-head{
        min-height: 85%;
        width: 100%;
    }
    .beat-head div{
        margin-bottom: 30px;
    }
    .beat{
        background-color: white;
        margin: 2px 0px;
        padding: 3px;
        display: flex;
        align-items: center;
        border-radius: 3px;
    }

    .content-link{

    }
    .beat-controls{
        display: flex;
        justify-content: flex-end;
    }
    .beat-cards{
        display: flex;
       flex-direction: column;
        background-color: #EBECF1;
        height: 100%;
    }
    .beat-item img{
        height: 10%;
        width: 10%;

        object-fit: contain;
    }
    .caption{
        height: 20%;
        font-size: 13px;
        text-align: center;
    }
    .price{
        height: 20%;
        font-size: 13px;
        text-align: center;
    }

    .price-sec{

    }
    .beat-item{
        width: 100%;
        height: 50px;
        border-radius: 5px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
        transition: .1s ease-in-out;
    }

    .beat-item:hover{
        transform: scale(1.02);
        border: 2px #007bff33 solid;
        box-shadow: 0 4px 10px 0 #007bff45 , 0 6px 22px 0 #007bff45;
    }

    .new-btn{
        width: 100px;
    }

    .new-btn:hover{
        font-weight: bold;
    }

    .search-bar input{
        width: 96%;
        text-align: center;
    }

    .search-bar{
        border: #11111133 1px solid;
        width: 40%;
        height: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 25px;
        transition: .2s ease-in-out;
    }

    .search-bar:hover{
        border: #11111177 2px solid;
    }

    .search-bar-focused{
        border: #0275d8 2px solid !important;

    }

    .beat:hover{
        background: linear-gradient(145deg, #ffffffaa, #ffffffee);
        box-shadow:  3px 3px 5px #EBECF2,
        -3px -3px 5px #EBECF2;
    }

    .beat-menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px #11111155 solid;

    }

    .beats{
        width: 80.5vw;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .beats-container{
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 98%;
        height: 98%;
        background-color: #FFFFFF;
        box-shadow: #11111122 ;
    }
</style>
