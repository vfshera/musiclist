<template>
    <div class="frontblogs mb-3">
        <div class="frontblogs-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="blog-menu px-3 py-3">
                <h3>Blogs</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': this.focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search Blog ...">
                </div>
            </div>
            <div class="blog-cards px-3 pt-3">
<!--                <div class="blog-card mx-1 mb-3" v-for="blog in searchableBlogs" @click.prevent="viewBlog(blog)">-->
<!--                    <img :src="blog.image" @load="isProcessing = false" :alt="blog.title" >-->
<!--                    <div class="caption px-1">-->
<!--                        {{ blog.title }}-->
<!--                    </div>-->
<!--                </div>-->
                <article class="blog-card mx-1 mb-3" v-for="blog in searchableBlogs" :key="blog.id" @click.prevent="viewBlog(blog)">
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

            </div>

            <div class="blog-controls px-4" >
                <ul class="pagination" v-show="pagination.last_page > 1">
                    <li :class="{ 'disabled' : !pagination.prev_url }" class="page-item">
                        <a class="page-link" href="" @click.prevent="fetchBlogs(pagination.prev_url)">Prev</a>
                    </li>
                    <li class="page-item disabled" >
                  <span class="page-link text-dark">
                   Page {{ pagination.current_page }} of {{ pagination.last_page }}
                  </span>
                    </li>
                    <li class="page-item" :class="{ 'disabled' : !pagination.next_url }">
                        <a class="page-link" href="" @click.prevent="fetchBlogs(pagination.next_url)">Next</a>
                    </li>
                </ul>
            </div>
        </div>

 </div>
</template>

<script>
    export default {
       name: 'FrontBlogs',
        data(){
            return{
                focused : false,
                allblogs: [],
                search: '',
                isProcessing: true,
                isPosting: false,
                file:null,
                title: '',
                category: '',
                catlist: ["Entertainment", "Music", "Educational", "Self Help", "Psychology"],
                content: '',
                reflink: '',
                pagination: {}

            }
        },
        methods:{

            viewBlog(blog){
                this.isProcessing = true;

                if( localStorage.getItem('readBlog')){
                    localStorage.removeItem('readBlog')
                }

                localStorage.setItem('readBlog' , JSON.stringify(blog));

                 this.$store.commit('setReadBlog', blog);
                this.isProcessing = false;

                let title = blog.title.toLowerCase().replace(/ /g , "-");
                let id = blog.id;
                this.$router.push({ name : 'blogPost' , params : {  id , title }})
            },
            fetchBlogs(blogsurl){
                let blogs_url = blogsurl || '/adminBlogs';

                axios.get(blogs_url)
                    .then(response =>{
                        this.allblogs = response.data.data;

                        this.makePagination(response.data.meta , response.data.links)

                        this.isProcessing = false
                        window.scrollTo(0,0);

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

            searchFocused(value){

                this.focused = value;
            }
        },
        computed:{
            searchableBlogs:function (){
                return this.allblogs.filter(blog => {
                    return blog.title.toLowerCase().match(this.search.toLowerCase());
                });
            }

        },
        mounted() {
            this.fetchBlogs();

            console.log('Blogs Component mounted.')
        }
    }
</script>

<style scoped>

    .content-link input , .blog-title input{
        width: 100%;
    }
    .link-n-title{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .content-body{

    }
    .add-blog-body{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
       min-height:60vh;

    }

    .blog-image{

    }

    .blog-title{

    }

    .blog-head{
        height: 30%;
        width: 100%;
    }

    .blog-content{
        height: 70%;
        width: 100%;
    }

    .content-link{

    }
    .blog-controls{
        display: flex;
        justify-content: flex-end;
    }
    .blog-cards{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .blog-card img{
        height: 80%;
        width: 100%;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        object-fit: contain;
    }
    .caption{
        height: 20%;
        font-size: 13px;
        text-align: center;
    }
    .blog-card{
        width: 17%;
        height: 31vh;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
        transition: .1s ease-in-out;
    }

    .blog-card:hover{
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

    .blog-menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px #11111155 solid;

    }

    .frontblogs{
        margin-top:60px;
        margin-bottom: 80px;
        width: 99.5vw;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .frontblogs-container{
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 75%;
        height: 98%;
        background-color: #FFFFFF;
        box-shadow: #11111122 ;
    }


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
        height: 250px;
    }
    .blog-card:hover {
        box-shadow: 0px 30px 18px -8px rgba(0, 0, 0,0.1);
        transform: scale(1.05, 1.05);
    }


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
</style>
