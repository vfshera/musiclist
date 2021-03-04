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
                            <button class="bronze">{{ basicLicense[0].name }} ${{ basicLicense[0].amount }}</button>
                            <button class="silver">{{ premiumLicense[0].name }} ${{ premiumLicense[0].amount }}</button>
                            <button class="gold">{{ unlimitedLicense[0].name }} ${{ unlimitedLicense[0].amount }}</button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--        edit beat modal-->
        <div class="modal fade" id="EditBeatModal" tabindex="-1" role="dialog" aria-labelledby="EditBeatModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="addBeatModalLongTitle" style="display: inline-block">Edit Beat</h4>
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
                                    <div class="cover withmb">
                                        <label for="beat-cover">Beat Cover</label>
                                        <input @change="getBeatCover" id="beat-cover" required type="file" class="form-control mt-2">
                                    </div>

                                    <div class="content-link withmb">
                                        <label for="sample">Sample Audio</label>
                                        <input @change="getBeatSample" id="sample" required type="file" class="form-control mt-2">
                                    </div>

                                    <div class="zip withmb">
                                        <label for="beat-key">BPM , Key</label>
                                        <input v-model="editedBeat.bpmkey" id="beat-key" required type="text" class="form-control mt-2" placeholder="As 96.0 , C# Major ....">
                                    </div>

                                    <div class="tags ">
                                        <label for="beat-tags">Beat Tags</label>
                                        <input id="beat-tags" v-model.trim="tag" required type="text" @keypress.prevent.stop.enter="addTag" class="form-control mt-2"  placeholder="Afrobeat , Gengetone , Hip Hop ....">
                                    </div>
                                </div>
                                <div class="link-n-title col-md-6 ">
                                    <div class="beat-title withmb">
                                        <label for="title">Beat Title</label>
                                        <input type="text" id="title" required v-model="editedBeat.title" name="title" class="form-control mt-2" placeholder="Beat title goes here ....">
                                    </div>

                                    <div class="basic withmb">
                                        <label for="basic-link ">MP3 LINK
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="basic-link" required type="text"  v-model="editedBeat.basic" class="form-control mt-2" placeholder="Link to Basic Beat">
                                    </div>
                                    <div class="premium withmb">
                                        <label for="premium-link ">MP3 + WAV LINK
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="premium-link" required type="text"  v-model="editedBeat.premium" class="form-control mt-2" placeholder="Link to Premium Beat">
                                    </div>
                                    <div class="unlimited ">
                                        <label for="unlimited-link ">MP3 + WAV + STEMS LINK
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </label>
                                        <input id="unlimited-link" required type="text"  v-model="editedBeat.unlimited" class="form-control mt-2 " placeholder="Link to Unlimited Beat">
                                    </div>
                                </div>
                            </div>

                            <div class="tags-list col-md-12 mt-3" v-show="tags.length > 0">
                                <span>TAGS </span>
                                <ul class="tags-ul">
                                    <li class="tag-item px-2 mx-1" v-for="(tag, index) in setTags" :key="index">
                                        <span>{{ tag }}</span>
                                        <span @click="tags.splice(index, 1)" style="cursor: pointer">&times;</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="payment mt-2">
                                <input type="checkbox" class="payswitch" :checked="isPaid" @change="setBeatValue">
                                <label for="">{{ (isPaid) ? "PAID BEAT" : "FREE BEAT"}} </label>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="updateBeat" class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
        <!--        end edit beat modal-->
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
                tag: '',
                tags: [],
                editedBeat: {
                    title: '',
                    tags: [],
                    bpmkey: '',
                    basic: '',
                    premium: '',
                    unlimited: '',
                    isPaid: true,
                    cover:null,
                    sample: null,
                },
            }
        },
        methods:{
            setBeatValue(e){
                this.editedBeat.isPaid = e.target.checked
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
            validate(){
                if(this.editedBeat.beat != null && this.editedBeat.title  != null &&  this.editedBeat.about != null &&    this.editedBeat.cover != null &&   this.editedBeat.sample != null){
                    return true;
                }else{
                    return false;
                }
            },
            resetBeat(){

                this.editedBeat.title = '';
                this.editedBeat.cover = null;
                this.editedBeat.sample = null;
                this.tags = [];
                this.editedBeat.bpmkey = '';
                this.editedBeat.basic = '';
                this.editedBeat.premium = '';
                this.editedBeat.unlimited = '';
                this.editedBeat.isPaid = true;

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
                    fd.append('sample',this.editedBeat.sample)
                    fd.append('basic',this.editedBeat.basic)
                    fd.append('bpmkey',this.editedBeat.bpmkey)
                    fd.append('premium',this.editedBeat.premium)
                    fd.append('unlimited',this.editedBeat.unlimited)
                    fd.append('ispaid',this.editedBeat.isPaid)
                    fd.append('tags',this.tags)

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
            },
            basicLicense: function () {
                    return this.$store.getters.getBeatLicenses.filter( lice => (lice.code.match('BSC')))
            },
            premiumLicense: function () {
                    return this.$store.getters.getBeatLicenses.filter( lice => (lice.code.match('PRE')))
            },
            unlimitedLicense: function () {
                    return this.$store.getters.getBeatLicenses.filter( lice => (lice.code.match('UNL')))
            },
            setTags:function () {
                return this.tags;
            },
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
        padding: 15px 0px;
        margin-top: 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
    .bronze , .silver , .gold{
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: bold;
        height: 50px;
        min-width: 100px;
        border-radius: 10px;
        padding: 20px 30px;
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



    /*//extraaa*/


    .payment{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .payswitch{
        position: relative;
        height:20px;
        width:50px;
        -webkit-appearance: none;
        background:#c6c6c6;
        outline:none;
        border-radius: 10px;
        box-shadow:inset 0 0 5px rgba(0,0,0,.2);
    }


    .payswitch:checked{
        background:#03a9f4;
    }


    .payswitch:before{
        content: "";
        position: absolute;
        top:.25px;
        left: .5px;
        height: 19.5px;
        width:19.5px;
        background-color: white;
        border-radius: 50%;
        box-shadow: inset 0 2px 5px rgba(0,0,0,.2);
        transition: .5s;
    }

    .payswitch:checked:before{
        left: 29.5px;
    }
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


    .beat-item img{
        height: 10%;
        width: 10%;

        object-fit: contain;
    }



</style>
