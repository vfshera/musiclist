<template>
    <div class="gallery">
        <div class="gallery-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="gallery-menu px-3 py-3">
                <h3>Gallery</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': this.focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search gallery ...">
                </div>
                <button class="btn btn-primary rounded-pill new-btn" data-toggle="modal" data-target="#addGalleryModal"> <span class="ti-pencil-alt mr-2"></span>NEW</button>
            </div>
            <div class="gallery-cards px-3 pt-3">
                <div class="gallery-card mx-1 mb-3" v-for="gallery in searchableGallery" @click.prevent="viewGallery(gallery)">
                    <img :src="gallery.img_url" @load="isProcessing = false" alt="" >
                    <span class="gimg-name">
                        {{ gallery.name.slice(0,3) }}
                    </span>
                </div>

            </div>

            <div class="gallery-controls px-4" >
                <ul class="pagination" v-show="pagination.last_page > 1">
                    <li :class="{ 'disabled' : !pagination.prev_url }" class="page-item">
                        <a class="page-link" href="" @click.prevent="fetchGallery(pagination.prev_url)">Prev</a>
                    </li>
                    <li class="page-item disabled" >
                  <span class="page-link text-dark">
                   Page {{ pagination.current_page }} of {{ pagination.last_page }}
                  </span>
                    </li>
                    <li class="page-item" :class="{ 'disabled' : !pagination.next_url }">
                        <a class="page-link" href="" @click.prevent="fetchGallery(pagination.next_url)">Next</a>
                    </li>
                </ul>
            </div>
        </div>

        <!--        add gallery modal-->
        <div class="modal fade" id="addGalleryModal" tabindex="-1" role="dialog" aria-labelledby="addGalleryModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <div class="posting-gallery" v-if="isPosting">
                            <div class="loader"><div></div><div></div><div></div><div></div></div>
                            <h6>Posting...</h6>
                        </div>
                        <div class="add-gallery-body px-1 ">

                                    <div class="gal-image">
                                        <label for="gallery-cover">Image</label>
                                        <input @change="getGalleryCover" id="gallery-cover" class="form-control mt-2" required type="file">
                                    </div>

                        </div>
                    </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="postGallery" class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    <!--        view delete gallery modal-->
        <div class="modal fade" id="viewGalleryModal" tabindex="-1" role="dialog" aria-labelledby="viewGalleryModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content" >

                    <div class="modal-body">
                        <img :src="currGal.img_url" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button"  class="btn btn-primary" @click.prevent="deleteImg(currGal.id)">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>


    export default {
        name: 'Gallery',
        data(){
            return{
                focused : false,
                gallery: [],
                search: '',
                currGal: {},
                isProcessing: true,
                isPosting: false,
                gimg:null,
                pagination: {},
            }
        },
        methods:{


            resetgallery(){
                this.gimg = null;
            },
            viewGallery(gallery){
                this.currGal = gallery;
                this.modalOpenClose('#viewGalleryModal','open')
            },
            deleteImg(id){
                Swal.fire({
                    title: 'Delete Image?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/deleteGallery/'+ id)
                            .then(response => {
                                if(response.status == 200) {

                                    Toast.fire({
                                        icon: 'success',
                                        title: response.data
                                    });

                                    this.modalOpenClose('#viewGalleryModal','close')
                                    Fire.$emit('galleryChanged');

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
            postGallery(){
                this.isPosting = true;

                let fd = new FormData();
                fd.append('image',this.gimg)


                axios.post( '/addGallery',fd,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then( res =>{
                    this.isPosting = false;

                    if(res.status == 201){
                        Fire.$emit('galleryChanged');

                        Toast.fire({
                            icon: 'success',
                            title: res.data
                        });

                        this.resetgallery();

                        this.modalOpenClose('#addGalleryModal', 'close');

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
            fetchGallery(galleryurl){
                let gallery_url = galleryurl || '/getGallery';

                axios.get(gallery_url)
                    .then(response =>{
                        this.gallery = response.data.data;

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

            getGalleryCover(e){
                this.gimg = e.target.files[0];
            },

            searchFocused(value){

                this.focused = value;
            }
        },
        computed:{
            searchableGallery:function (){
                return this.gallery.filter(gal => {
                    return gal.name.toLowerCase().match(this.search.toLowerCase());
                });
            },
        },
        mounted() {
            this.fetchGallery();

            Fire.$on('galleryChanged',()=>{
                this.fetchGallery();

                console.log("gallery Changed");
            });

            console.log('Gallery Component mounted.')
        }
    }
</script>

<style scoped>
    .gimg-name{
        position: relative;
        right: 0px;
        bottom: 40px;
        z-index: 99;
        background: white;
        color: #111111;
        padding: 10px 30px;
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

    .posting-gallery{
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



    .content-link input , .gallery-title input{
        width: 100%;
    }

    .add-gallery-body{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        min-height:60vh;

    }



    .gallery-controls{
        display: flex;
        justify-content: flex-end;
    }
    .gallery-cards{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .gallery-card img{
        /*height: 80%;*/
        width: 100%;
        border-radius: 15px;
        object-fit: contain;
        z-index: 1;
    }

    .gallery-card{
        width: 24%;
        height: 25vh;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
        transition: .1s ease-in-out;
        overflow: hidden;
    }



    .gallery-card:hover{
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

    .gallery-menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px #11111155 solid;

    }

    .gallery{
        width: 80.5vw;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gallery-container{
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 98%;
        height: 98%;
        background-color: #FFFFFF;
        box-shadow: #11111122 ;
    }

    .gal-image{
        width: 100%;
        height: 100%;
    }
</style>
