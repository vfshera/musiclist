<template>
    <div id="home">
        <div id="hero" >
          <div class="info">
              <h1>Tony On The Track</h1>
              <p class="container">The Official Website For Bangers</p>
          </div>
        </div>
        <div class="lds-dual-ring" v-show="isProcessing"></div>
        <div id="beats"  class=" my-5" >
            <h2 class="text-center">BEATS</h2>

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


            <!--                mobile-->


            <div id="beatList " class="container my-4">
                <div id="labels"class="row">
                    <div id="cover" class="col-md-1">COVER</div>
                    <div id="title" class="col-md-4">TITLE</div>
                    <div id="bpm" class="col-md-2 ">BPM & KEY</div>
                    <div id="actions" class="col-md-3">TAGS</div>
                    <div id="price" class="col-md-2 text-center">LICENSE</div>
                </div>

                <div class="track row " v-for=" track in beats" >
                    <div  class="col-md-1 ">
                        <img class="cover" :src="track.cover" :alt="track.title+' Beat Cover' " @click="selectTrack(track)">
                    </div>
                    <div class="col-md-4 title-container">
                       <span class="title font-weight-bold" @click="selectTrack(track)"> {{ track.title }}</span>
                    </div>

                    <div class="col-md-2 ">
                        <span class="bpm font-italic">{{ track.bpmkey }}</span>
                    </div>
                    <div class="col-md-3 track-tags">
                            <span  v-for="tag in track.tags.split(',')">
                                #{{ tag }}
                            </span>
                    </div>
                    <div  class="col-md-2 text-center ">
                        <p class="free-price" v-if="!track.isPaid">
                           <span class="price-amount">FREE</span>
                        </p>

                        <p class="price" v-if="track.isPaid" @click="addToCart(track)">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="24" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="price-amount">{{ track.license }}</span>
                        </p>
                    </div>
                </div>



            </div>

            <div id="more-beats" class="mt-md-4 mt-sm-2 mt-xs-2  d-flex justify-content-center container">
                <router-link :to="{ path : '/tracks' }" class="btn btn-primary  ">BROWSE BEATS</router-link>
            </div>
        </div>

        <div id="drumkits" class="my-5">
            <h2 class="text-center ">DRUMKITS</h2>
            <div class="kits my-4 " :class="{ 'd-flex justify-content-between': (drumkits.length > 2) ,  'd-flex justify-content-center': (drumkits.length == 1)}">
                <a href="#" class="mobile-kit" v-for="drumkit in drumkits" @click.prevent="viewDrumkit(drumkit)" :class="{ 'm-2': (drumkits.length == 2) }">
                    <figure class="col-xs-12" :style="{ backgroundImage: `url(${ drumkit.image } )` }">
                        <div :class="{ 'free': (drumkit.isFree) , 'date': (!drumkit.isFree)}"><span class="card-date-day">{{ drumkit.dprice }}</span></div>
                        <figcaption>
                            <h4> <span>{{ drumkit.title }}</span></h4>
                            <p>{{ drumkit.type}}</p>
                        </figcaption>
                    </figure>
                </a>


            </div>
            <div id="more-kits" class=" d-flex justify-content-center container">
                <router-link :to="{ path : '/soundkits' }"class="btn btn-primary  ">ALL SOUND KITS</router-link>
            </div>
        </div>
        <div id="front-blogs" class="my-5">
            <h2 class="text-center">BLOG</h2>

            <section class="cards my-4">
                <article class="blog-card" v-for="blog in blogs" :key="blog.id" @click.prevent="viewBlog(blog)">
                    <div class="card__info-hover">
                        <svg class="card__like"  viewBox="0 0 24 24">
                            <path fill="#000000" d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>
                        <div class="card__clock-info">
                            <svg class="card__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
                            </svg>
                        </div>

                    </div>
                    <div class="card__img" :style="{ backgroundImage: `url(${ blog.image } )` }"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"  :style="{ backgroundImage: `url(${  blog.image } )` }" ></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">{{ (blog.category.length > 15 ) ? sanitizeText(15 , blog.category ) : blog.category }}</span>
                        <h3 class="card__title">{{ (blog.title.length > 45 ) ? sanitizeText(45 , blog.title ) : blog.title }}</h3>
                    </div>
                </article>
            </section>

            <router-link :to="{ path: '/blog-posts' }" class="btn btn-primary mt-md-4 mt-sm-3 mt-xs-3 "> MORE STORIES</router-link>
        </div>
        <div id="gallery" class="my-5">
            <h2 class="text-center">GALLERY</h2>
            <div class="galleryHolder">
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
            </div>
        </div>

        <div id="bio" class="my-5 pt-2">
<!--            <h2 class="text-center mt-2">BIO</h2>-->
            <div class="bio-info" style="background-image: url('/storage/site-img/wood2.jpg'); ">
               <div class="bio-img">
                   <img loading="lazy" class="circle-img" src="https://source.unsplash.com/300x300">
               </div>
                <div class="bio-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda beatae eos explicabo hic minima modi provident quos sapiente sunt. Blanditiis delectus maiores maxime minus necessitatibus, nostrum obcaecati possimus rem soluta, sunt tempora tempore voluptates! Alias animi architecto consequatur doloremque eligendi exercitationem, explicabo minima nam nemo nesciunt nisi non, officia perspiciatis porro quam quod quos recusandae ut veniam, vitae! Architecto cumque odit quod? Assumenda aut eaque fugiat nulla quia, veniam.</p>
                </div>
            </div>
        </div>

        <div id="sign-up" class="my-5">
            <h4 class="text-center">SIGN UP FOR OUR NEWSLETTER</h4>
            <input class="c-checkbox" type="checkbox" id="checkbox">
            <div class="c-formContainer">
                <form class="c-form" action="" @submit="subscribe">
                    <input class="c-form__input" v-model="newsletterMail" placeholder="E-mail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                    <label class="c-form__buttonLabel" for="checkbox" @click="subscribe">
                        <button class="c-form__button"  type="submit">Send</button>
                    </label>
                    <label class="c-form__toggle" for="checkbox" @click="expandSignUp" data-title="Notify me"></label>
                </form>
            </div>
        </div>

        <div id="contact" class=" col-sm-11 col-xs-11 container my-5 ">
            <h2 class="text-center">CONTACT</h2>
            <form class=" col-sm-11 col-xs-11 col-md-12">
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="text" v-model="contact.name" pattern="[aA-zZ]{2,}" title="The name MUST Contain Letters Only!" class="form__field" placeholder="Put Only Your First Name" name="name" id='name' required />
                        <label for="name" class="form__label">First Name</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="email" v-model="contact.email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="The email must be Valid like abc@xyz.com" class="form__field" placeholder="Email" name="email" id='email' required />
                        <label for="email" class="form__label">Email</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="text" v-model="contact.subject" class="form__field" placeholder="subject" name="subject" id='subject' required />
                        <label for="subject" class="form__label">Subject</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <textarea type="text" v-model="contact.message" class="form__field" placeholder="message" name="message" id='message' required ></textarea>
                        <label for="message" class="form__label">Message</label>
                    </div>
                </div>
                <button class="pure-material-button-contained" @click.prevent="sendMsg">SEND</button>
            </form>
        </div>


    </div>
</template>

<script>

    import Share from "./Share";
    export default {
        name : "Home",
        components: {Share},
        data(){
            return{
                beats: [],
                blogs: [],
                drumkits: [],
                newsletterMail:'',
                contact:{
                    name: '',
                    email: '',
                    subject: '',
                    message: '',
                },
                contactErr:{},
                isProcessing: true
            }
        },

        methods:{

            addToCart(item){
                this.isProcessing = true;

                if(this.$store.getters.getBeatCart.find( beat => beat.id == item.id)){
                    Swal.fire({
                        icon: 'error',
                        title: 'Beat Already In Cart'
                    })

                    this.isProcessing = false;
                }else{
                    this.$store.commit('setBeatCart' , item)
                    this.addToLocal('beatCart', JSON.stringify(this.$store.getters.getBeatCart))

                    Swal.fire({
                        icon : 'success',
                        title : 'Beat Added To Cart!',
                    })

                    this.isProcessing = false;

                }

             },
            addToLocal(keyName,newCart){

                if(localStorage.getItem(keyName)){
                    localStorage.removeItem(keyName)
                    localStorage.setItem(keyName , newCart);

                }else{

                    localStorage.setItem(keyName , newCart);

                }


            },
            sendMsg(){
                if(contact.name != '' && contact.email != '' && contact.subject != '' && contact.message != ''){

                    axios.post('/contact', this.contact)
                        .then(res =>{

                            if(res.status == 201){

                                Toast.fire({
                                    icon: 'success',
                                    title: res.data
                                });

                                this.contact.message = ''
                                this.contact.name = ''
                                this.contact.email = ''
                                this.contact.subject = ''

                            }else if(res.status == 403){
                                Toast.fire({
                                    icon: 'error',
                                    title: res.data
                                });
                            }else{
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Please Try Sending Again!'
                                });
                            }
                        })
                        .catch(err =>{
                            Swal.fire({
                                icon: 'error',
                                title : err.message
                            })
                           // this.contactErr = err.errors;
                        });
                }else{
                    Swal.fire({
                        title: 'Check Your Fields',
                        icon: 'error'
                    })
                }
            },
            subscribe(){

                axios.post('/subscribe')
                    .then(response =>{
                        if(response.status == 201){

                            Toast.fire({
                                icon: 'success',
                                title: response.data
                            });

                        }else if(response.status == 403){
                            Toast.fire({
                                icon: 'error',
                                title: response.data
                            });
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: 'Please Try Subscribing Again!'
                            });
                        }
                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            sanitizeText(size,text){

                    return text.slice(0, size)+ '...';

            },
            getImageUrl(folder,imglink){
                return '/storage/'+folder+ '/'+imglink;
            },
            fetchData(){

                axios.get('/frontBeats')
                    .then(response =>{
                        this.beats = response.data.data;

                        this.$store.commit('setBeats', this.beats);
                    })
                    .catch(err =>{
                        console.log(err);
                    });


                axios.get('/getBlogs')
                    .then(response =>{
                        this.blogs = response.data.data;

                    })
                    .catch(err =>{
                        console.log(err);
                    });

                axios.get('/frontDrumkits')
                    .then(response =>{
                        this.drumkits = response.data.data;
                        this.$store.commit('setKits', this.drumkits);
                    })
                    .catch(err =>{
                        console.log(err);
                    });


                this.isProcessing = false;
            },
            viewBlog(blog){

                let title = blog.title.toLowerCase().replace(/ /g , "-");
                let id = blog.id;
                this.$router.push({ name : 'blogPost' , params : {  id , title }})
            },
            viewDrumkit(drumkit){

                let title = drumkit.title.toLowerCase().replace(/ /g , "-");
                let id = drumkit.id;
                this.$router.push({ name : 'drumkitView' , params : {  id , title }})
            },
            selectTrack(song){

                this.$store.commit('setSong',song);

                if(this.$store.getters.getPlayerState != true || this.$store.getters.getPlayerVisibility != true){
                    this.$store.commit('setPlayerVisibility', true);
                    this.$store.commit('setPlayerState', true);
                }

            }
            ,
            checkMeasures(){

            },
            expandSignUp(){
                const cForm = document.querySelector(".c-form")
                const frmContainer = document.querySelector(".c-formContainer")
                const cFrmToggle = document.querySelector(".c-form__toggle")

                if(window.innerWidth < 524)
                {
                    cForm.style.width = '16em';
                    frmContainer.style.width = '16em';
                    cFrmToggle.style.width = '16em';

                }else  if(window.innerWidth < 624)
                {
                    cForm.style.width = '32em';
                    frmContainer.style.width = '32em';
                    cFrmToggle.style.width = '32em';
                }
            }
        },
        mounted() {
            this.isProcessing = true;
            this.fetchData();
        },

    }
</script>

<style scoped>
    #beats h2, #drumkits h2, #front-blogs h2, #gallery h2 {
        font-family: "Poppins", 'Helvetica', sans-serif;
        font-weight: 500 !important;
    }


/*<!--    bio-->*/
#bio{
    display: none;
   /*flex-direction: column;*/
   /* align-items: center;*/
}
.bio-info{
    display: flex;
    justify-content: space-between;
    width: 80%;

    padding: 2%;
    border-radius: 35%;
}
.circle-img{
    border-radius: 1000px;
    border: rgba(189, 195, 199, .2) 10px solid;
    box-shadow: 0 10px 30px 0px #11111144;
}
.bio-img{
   max-width: 35%;
}

.bio-text{
    display: flex;
    align-items: center;
    max-width: 65%;
    text-align: justify;
    text-justify: inter-word;
}


.bio-text p  {
    font-size: 17px;
    font-weight: 700;
    color: #111111;
    /*mix-blend-mode: darken;*/
    text-shadow: 1px 1px ghostwhite;
}


/*end bio*/





    /*BLOG CARDS*/

    .cards {
        width: 100%;
        display: flex;
        display: -webkit-flex;
        justify-content: center;
        -webkit-justify-content: center;
        max-width: 1200px;
        flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
    }


    .card__like {
        width: 18px;
    }

    .card__clock {
        width: 15px;
        vertical-align: middle;
        fill: #AD7D52;
    }
    .card__time {
        font-size: 12px;
        color: #AD7D52;
        vertical-align: middle;
        margin-left: 5px;
    }

    .card__clock-info {
        float: right;
    }

    .card__img {
        visibility: hidden;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 125px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;

    }

    .card__info-hover {
        position: absolute;
        padding: 16px;
        width: 100%;
        opacity: 0;
        top: 0;
    }

    .card__img--hover {
        transition: 0.2s all ease-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        position: absolute;
        height: 100%;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        top: 0;

    }
    .blog-card {
        transition: all .4s cubic-bezier(0.175, 0.885, 0, 1);
        background-color: #fff;
        width: 20%;
        position: relative;
        margin: 8px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 13px 10px -7px rgba(0, 0, 0,0.1);
        height: 300px;
    }
    .blog-card:hover {
        box-shadow: 0px 30px 18px -8px rgba(0, 0, 0,0.1);
        transform: scale(1.05, 1.05);
    }

    /*.card__info {*/
    /*    z-index: 100;*/
    /*    position: absolute;*/
    /*    background-color: #fff;*/
    /*    border-bottom-left-radius: 12px;*/
    /*    border-bottom-right-radius: 12px;*/
    /*    padding: 16px 24px 24px 24px;*/
    /*}*/

    .card__info{
        z-index: 100 ;
        position: absolute;
        bottom: 0px;
        background-color: #ffffffdd;
        width: 100%;
        padding: 10px 16px;
        font-size: 1rem;
    }

    .card__category {
        font-family: 'Raleway', sans-serif;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 2px;
        font-weight: 500;
        color: #868686;
    }

    .card__title {
        /*margin-top: 10px;*/
        /*margin-bottom: 2px;*/
        font-family: 'Roboto Slab', serif;
        font-size: 1rem;
    }

    /*.card__by {*/
    /*    font-size: 12px;*/
    /*    font-family: 'Raleway', sans-serif;*/
    /*    font-weight: 500;*/
    /*}*/

    /*.card__author {*/
    /*    font-weight: 600;*/
    /*    text-decoration: none;*/
    /*    color: #AD7D52;*/
    /*}*/

    .blog-card :hover .card__img--hover {
        height: 100%;
        opacity: 0.9;
    }

    .blog-card :hover .card__info {
        background-color: transparent;
        position: relative;
    }

    .blog-card :hover .card__info-hover {
        opacity: 1;
    }


    /*END BLOG CARDS*/

 /*DRUMKIT*/
.kits{
    display: flex;
    justify-content: center;
    width: 76%;
}
 figure {
     position: relative;
     display: flex;
     align-items: flex-start;
     justify-content: center;
     width: 220px;
     height: 300px;
     padding: 20px 20px;
     background-position: center center;
     background-repeat: no-repeat;
     background-size: 100%;
     border-radius: 10px;
     box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     overflow: hidden;
 }
 figure:before, figure:after {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
 }
 figure:before {
     content: '';
     background-color: rgba(0, 0, 0, 0.1);
     z-index: 0;
 }
 figure:after {
     content: '';
     display: flex;
     align-items: center;
     justify-content: center;
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     overflow: hidden;
 }
 figure:hover {
     background-size: 175%;
 }
 figure:hover:after {
     content: '\2665';
     background-color: rgba(255, 69, 0, 0.7);
     color: white;
     font-size: 72px;
     z-index: 2;
 }
 figure:hover .date {
     bottom: -59px;
 }
 figure:hover figcaption {
     transform: translateY(-110%);
 }
 figure .date {
     position: absolute;
     bottom: 0;
     right: 30px;
     display: flex;
     align-items: center;
     justify-content: center;
     flex-direction: column;
     padding: 10px;
     background-color: rgba(255, 69, 0, 0.85);
     text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
 }

    figure .free{
        position: absolute;
        bottom: 0;
        right: 30px;
        display: flex;
        align-items: center;
        /*justify-content: center;*/
        flex-direction: column;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.85);
        text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

 figure .date span {
     color: white;
     line-height: 1;
 }
 figure .date span:first-child {
     font-family: "Source Code Pro", sans-serif;
     font-size: 20px;
     font-weight: 900;
 }
 figure .date span:last-child {
     font-size: 14px;
     font-weight: 400;
 }
 figure figcaption {
     color: white;
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     z-index: 1;
 }
 figure figcaption h4 {
     margin: 0 0 5px;
     font-family: "Source Code Pro", sans-serif;
     font-size: 24px;
     line-height: 1.35;
     text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
 }
 figure figcaption h4 > span {
     background-color: transparent;
     /*background-color: rgba(255, 69, 0, 0.8);*/
 }
 figure figcaption p {
     margin: 0;
     line-height: 1.5;
 }

 /*END DRUMKIT*/
    #contact form{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
   .download-btn{
       margin: 0 10px;
   }
   .share-btn{
       margin: 0 10px;
   }
    svg:hover{
        transform: scale(1.08);
        transition: 2ms ease-in;
    }

    .price{
        background-color: orangered;
        height: 40px;
        width: 100px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 300;
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
    .price-amount{
        font-size: 19px;
    }
    #labels{
        margin-bottom: 12px;
    }
    .track{

        margin-top: 5px;
        display: flex;
        align-items: center;
        border-bottom: 2px solid rgba(0,0,0,.1);
        height: 60px;
    }
    .cover{
        height: 50px;
        width: 50px;
        cursor: pointer;
    }

    .m-cover{
        height: 50px;
        width: 50px;
    }
    #home{

    }

    #hero > .info {
        text-align: center;
        color: white;
        padding-top: 300px;
    }
    #hero {
        background: url("/storage/site-img/mixer.jpg");
        object-fit: contain;
        background-size: cover;
        background-position: center center;
        height: 550px;
        box-sizing: border-box;
    }

    #beats {

    }

    #drumkits{
        margin-top: 100px !important;
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        align-items: center;

    }
    #front-blogs {
        margin-top: 100px !important;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #bio {

    }

    #gallery {
        margin-top: 100px !important;
    }

    .imgBox{
        display: none;
    }

    #sign-up {
        height: 170px;
        background-color: #152238;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #sign-up div {
        display: flex;
        justify-content: space-between;
    }
    #contact {
        margin-top: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }


/*    GALLERY*/
    .galleryHolder {
        display: -webkit-box;
        display: flex;
        width: 100%;
        padding: 2% 1%;
        box-sizing: border-box;
        height: 60vh;
    }

    .box {
        -webkit-box-flex: 1;
        flex: 1;
        overflow: hidden;
        -webkit-transition: .5s;
        transition: .5s;
        margin: 0 2%;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        line-height: 0;
    }

    .box > img {
        width: 200%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transition: .5s;
        transition: .5s;
    }

    .box:hover {
        -webkit-box-flex: 1;
        flex: 1 1 35%;
    }

    .box:hover > img {
        width: 100%;
        height: 100%;
    }

    /*    END GALLERY*/

/*    MATERIAL SEND BUTTON*/

    .pure-material-button-contained {
        position: relative;
        display: inline-block;
        box-sizing: border-box;
        border: none;
        border-radius: 4px;
        padding: 0 16px;
        min-width: 84px;
        height: 40px;
        vertical-align: middle;
        text-align: center;
        text-overflow: ellipsis;
        text-transform: uppercase;
        color: rgb(255, 255, 255);
        background-color: orangered;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
        0 1px 5px 0 rgba(0, 0, 0, 0.12);
        font-size: 18px;
        font-weight: 700;
        line-height: 36px;
        overflow: hidden;
        outline: none;
        cursor: pointer;
        transition: box-shadow 0.2s;
    }

    .pure-material-button-contained::-moz-focus-inner {
        border: none;
    }

    /* Overlay */
    .pure-material-button-contained::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb( 255, 255, 255);
        opacity: 0;
        transition: opacity 0.2s;
    }

    /* Ripple */
    .pure-material-button-contained::after {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        border-radius: 50%;
        padding: 50%;
        width: 32px; /* Safari */
        height: 32px; /* Safari */
        background-color: rgb(255, 255, 255);
        opacity: 0;
        transform: translate(-50%, -50%) scale(1);
        transition: opacity 1s, transform 0.5s;
    }

    /* Hover, Focus */
    .pure-material-button-contained:hover,
    .pure-material-button-contained:focus {
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.14),
        0 1px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:hover::before {
        opacity: 0.08;
    }

    .pure-material-button-contained:focus::before {
        opacity: 0.24;
    }

    .pure-material-button-contained:hover:focus::before {
        opacity: 0.3;
    }

    /* Active */
    .pure-material-button-contained:active {
        box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2),
        0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:active::after {
        opacity: 0.32;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0s;
    }

    /* Disabled */
    .pure-material-button-contained:disabled {
        color: rgba( 0, 0, 0, 0.38);
        background-color: rgba(0, 0, 0, 0.12);
        box-shadow: none;
        cursor: initial;
    }

    .pure-material-button-contained:disabled::before {
        opacity: 0;
    }

    .pure-material-button-contained:disabled::after {
        opacity: 0;
    }

    /*    END MATERIAL SEND BUTTON*/






/*    notify newsletter */

   .c-checkbox {
       display: none;
   }
   .c-checkbox:checked + .c-formContainer .c-form {
       width: 37.5em;
   }
   .c-checkbox:checked + .c-formContainer .c-form__toggle {
       visibility: hidden;
       opacity: 0;
       transform: scale(0.7);
   }
   .c-checkbox:checked + .c-formContainer .c-form__input,
   .c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
       transition: 0.2s 0.1s;
       visibility: visible;
       opacity: 1;
       transform: scale(1);
   }
   .c-checkbox:not(:checked) + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle::before, .c-checkbox:checked + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle::before {
       content: 'Thank You! \1F60A';
   }
   .c-checkbox:not(:checked) + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle {
       pointer-events: none;
       cursor: default;
   }

   .c-formContainer,
   .c-form,
   .c-form__toggle {
       width: 20em;
       height: 4.25em;
   }

   .c-formContainer {
       position: relative;
       font-weight: 700;
   }

   .c-form,
   .c-form__toggle {
       position: absolute;
       border-radius: 6.25em;
       background-color: #ffffff;
       transition: 0.2s;
   }

   .c-form {
       left: 50%;
       transform: translateX(-50%);
       padding: 0.625em;
       box-sizing: border-box;
       box-shadow: 0 0.125em 0.3125em rgba(0, 0, 0, 0.3);
       display: flex;
       justify-content: center;
   }

   .c-form__toggle {
       color: orangered;
       top: 0;
       cursor: pointer;
       z-index: 1;
       display: flex;
       align-items: center;
       justify-content: center;
   }
   .c-form__toggle::before {
       font-size: 1.75em;
       content: attr(data-title);
   }

   .c-form__input,
   .c-form__button {
       font: inherit;
       border: 0;
       outline: 0;
       border-radius: 5em;
       box-sizing: border-box;
   }

   .c-form__input,
   .c-form__buttonLabel {
       font-size: 1.75em;
       opacity: 0;
       visibility: hidden;
       transform: scale(0.7);
       transition: 0s;
   }

   .c-form__input {
       color: #ff7b73;
       height: 100%;
       width: 100%;
       padding: 0 0.714em;
   }
   .c-form__input::placeholder {
       color: currentColor;
   }
   .c-form__input:required:valid {
       color: #ff7b73;
   }
   .c-form__input:required:valid + .c-form__buttonLabel {
       color: #ffffff;
   }
   .c-form__input:required:valid + .c-form__buttonLabel::before {
       pointer-events: initial;
   }

   .c-form__buttonLabel {
       color: #ffaea9;
       height: 100%;
       width: auto;
   }
   .c-form__buttonLabel::before {
       content: '';
       position: absolute;
       width: 100%;
       height: 100%;
       pointer-events: none;
       cursor: pointer;
   }

   .c-form__button {
       color: white;
       padding: 0;
       height: 100%;
       width: 5em;
       background-color: orangered;
   }

   /*    newsletter end*/
</style>
