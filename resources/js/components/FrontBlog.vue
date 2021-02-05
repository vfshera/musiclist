<template>
    <div class="blog-post container">
        <div class="lds-dual-ring" v-show="isProcessing"></div>
        <div class="blog-header" :style="{ backgroundImage: `url(${ post.image } )` }">
            <div class="blog-actions">
                <button class="back-btn" @click.prevent="prevPage"><i class="ti-arrow-left"></i></button>
               <div class="updates">
                   <button class="share-blog" @click.prevent="modalOpenClose('#shareModal','open')">
                       <i  class="ti-sharethis" ></i>
                   </button>
               </div>
            </div>
            <h3 class="title text-white">{{ post.title }}</h3>
        </div>
        <div class="blog-content">
            <span class="badge badge-light badge-pill">{{ post.reflink }} <a :href="post.reflink" target="_blank"> <i class="ti-world"></i></a></span>
            <p v-html="post.content"></p>
        </div>

        <Share :title="post.title" :summary="post.content"  :image="post.image" :shared="'Blog'"/>

    </div>
</template>

<script>
import Share from "./Share";
export default {
    name: 'BlogPost',
    components: {Share},
    data(){
        return{
            post:[],
            isProcessing: true,
        }
    },
    methods:{
        clipboardState(value){
            if(value){

                Toast.fire({
                    icon:'success',
                    title:'Link Copied To Clipboard!'
                })

                this.modalOpenClose('#shareModal' , 'close')

            }else{
                    Toast.fire({
                        icon:'error',
                        title:'Link Not Copied!'
                    })
                this.modalOpenClose('#shareModal' , 'close')
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
        prevPage(){
            this.$router.go(-1)
        },

        setBlog(){
                axios.get('/getBlog/'+ this.$route.params.id)
                    .then(response =>{
                        if(response.status == 200){
                            this.post = response.data.data;

                            if( localStorage.getItem('readBlog')){
                                localStorage.removeItem('readBlog')
                            }

                            localStorage.setItem('readBlog' , JSON.stringify(response.data.data));

                            this.$store.commit('setReadBlog', response.data.data);

                            this.isProcessing = false;

                            this.scrollToTop();
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
                this.setBlog();
        console.log('BlogPost Mounted')
    }
}
</script>

<style scoped>



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



    .blog-post{
        margin-top: 70px;
        width: 81.4vw;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        border-radius: 15px;
        box-shadow: 0px 0px 10px -10px #111111;
    }
    .title{
        padding: 15px;
        background-image: linear-gradient(0deg,#11111156,transparent);
    }
    .blog-header{
        height: 35vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .blog-actions{
        margin-top: 20px;
        margin-left: 15px;
        margin-right: 15px;
        display:flex;
        justify-content: space-between;
    }

    .back-btn{
        width: 40px;
        height: 40px;
        background-color: #111111cc;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }


    .back-btn:hover{
        /*width: 50px;*/
        /*height: 50px;*/
        background-color: #cccccc99;
        color: #111111;
        /*border-radius: 45px;*/

        transform: scale(1.1);
    }

    .share-blog{
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .share-blog:hover{
        /*width: 50px;*/
        /*height: 50px;*/
        background-color: #ffffff99;
        color: #007bff;
        /*border-radius: 45px;*/
        transform: scale(1.1);

    }

       .blog-content{
        display: flex;
        flex-direction: column;
        padding:15px;
        min-height: 50vh;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        background-image: linear-gradient(0deg,#11111111,#ffffff77);
    }

    .blog-content p {
        margin-top: 15px;
        background-color: #ffffff;
        min-height: 42vh;
        border-radius: 15px;
        padding:15px;
        color: black;
    }
</style>
