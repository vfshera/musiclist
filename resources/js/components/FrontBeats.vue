<template>
    <div class="front-beats">
        <div class="front-beats-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="beat-menu px-3 py-3">
                <h3>Beats</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search Beats ...">
                </div>

            </div>
            <div class="front-beat-cards px-2 pt-2">
                <div id="labels"class="track-labels row">
                    <div id="cover" class="col-md-1">COVER</div>
                    <div id="title" class="col-md-4">TITLE</div>
                    <div id="bpm" class="col-md-2 ">BPM & KEY</div>
                    <div id="actions" class="col-md-4">TAGS</div>
                    <div id="price" class="col-md-1 text-center">LICENSE</div>
                </div>

                <!--                mobile-->
                <div class="mobile-track d-none" v-for=" track in beats">
                    <div  class="m-cover-container" @click="selectTrack(track)">
                        <img class="m-cover" :src="track.cover" alt="" >
                    </div>
                    <div class="m-title-container " @click="selectTrack(track)">
                        <span class="m-title" > {{ track.title }}</span>
                    </div>
                    <div  class=" text-center ">
                        <p class="m-free-price" v-if="!track.isPaid">
                            <span class="m-price-amount">FREE</span>
                        </p>
                        <p class="m-price" v-if="track.isPaid">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="m-price-amount">{{ track.license }}</span>
                        </p>
                    </div>
                </div>

                <!--              end  mobile-->

                <div class="track beat row px-2" v-for="track in searchableBeats"  >
                    <div  class="col-md-1 " @click="selectTrack(track)">
                        <img class="cover" :src="track.cover" :alt="track.title" height="50px" width="50px" style="object-fit: cover">
                    </div>
                    <div class="col-md-4 title-container" @click="selectTrack(track)">
                        <span class="title" > {{ track.title }}</span>
                    </div>
                    <div class="col-md-2 " @click="selectTrack(track)">
                        <span class="bpm">{{ track.bpmkey }}</span>
                    </div>
                    <div  class="col-md-4  track-tags">

                        <span v-for="tag in track.tags.split(',')">
                            #{{ tag }}
                        </span>
                    </div>
                    <div  class="col-md-1 text-center ">
                        <p class="free-price" v-if="!track.isPaid">
                            <span class="price-amount">FREE</span>
                        </p>

                        <p class="price" v-if="track.isPaid">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="orangered" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="price-amount">${{ $store.getters.getBasicPrice.amount }}</span>
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
    </div>
</template>

<script>
    export default {
        name: 'FrontBeats',
        data(){
            return{
                focused : false,
                beats: [],
                search: '',
                isProcessing: true,
                pagination: {}

            }
        },
        methods:{

            selectTrack(song){

                this.$store.commit('setSong',song);

                if(this.$store.getters.getPlayerState != true || this.$store.getters.getPlayerVisibility != true){
                    this.$store.commit('setPlayerVisibility', true);
                    this.$store.commit('setPlayerState', true);
                }

            },
            formatTags(tags){
               var tags = tags.split(",")

                return tags;
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
            fetchBeats(beatsurl){
                let beats_url = beatsurl || '/frontBeats';

                axios.get(beats_url)
                    .then(response =>{
                        this.beats = response.data.data;

                        this.makePagination(response.data.meta , response.data.links)
                        window.scrollTo(0,0);
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
            this.$seohelpers.setSEO('Beats');
            console.log('Beats Component mounted.')
        }
    }
</script>

<style scoped>

    /*mobile*/


    .m-cover{
        height: 50px;
        width: 50px;
    }
    .m-title{

        font-size: .8rem;

    }
    .title-container{
        cursor: pointer;
    }
    .m-title-container{
        padding: 0 5px;
    }
    .m-price{
        background-color: orangered;
        height: 40px;
        width: 70px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 300;
        font-size: 14px !important;
    }

    .free-price{
        background-color: #F4F3F177;
        height: 40px;
        width: 100px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black;
        font-weight: 500;
    }

    .m-free-price{
        background-color: #F4F3F177;
        height: 20px;
        width: 50px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black;
        font-weight: 500;
    }

    .mobile-track{
        margin-top: 5px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgba(0,0,0,.1);
        height: 60px;
        width: 99%;
    }
    /*end mobile*/

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
    .withmb{
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

     .track-labels{
        background-color: #c6c8ca22;
        margin: 2px 0px;
        padding: 3px;
        display: flex;
        align-items: center;
        border-radius: 3px;
        font-weight: bold;
    }


    .content-link{

    }
    .beat-controls{
        display: flex;
        justify-content: flex-end;
    }
    .front-beat-cards{
        display: flex;
       flex-direction: column;
        background-color: #EBECF111;
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
        color: orangered;

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

    .price-btn{
        width: 40px;
    }

    .price-btn:hover{
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

    .front-beats{
        margin-top: 60px;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .front-beats-container{
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 75%;
        height: 98%;
        /*background-color: #FFFFFF;*/
        box-shadow: #11111122 ;
    }
</style>
