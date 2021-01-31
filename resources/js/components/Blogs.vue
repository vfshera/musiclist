<template>
    <div class="blogs">
        <div class="blogs-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="blog-menu px-3 py-3">
                <h3>Blogs</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': this.focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search Blog ...">
                </div>
                <button class="btn btn-primary rounded-pill new-btn" data-toggle="modal" data-target="#addBlogModal"> <span class="ti-pencil-alt mr-2"></span>NEW</button>
            </div>
            <div class="blog-cards px-3 pt-3">
                <div class="blog-card mx-1 mb-3" v-for="blog in searchableBlogs" @click.prevent="viewBlog(blog)">
                    <img :src="blog.image" @load="isProcessing = false" :alt="blog.title" >
                    <div class="caption px-1">
                        {{ blog.title }}
                    </div>
                </div>

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

<!--        add blog modal-->
        <div class="modal fade" id="addBlogModal" tabindex="-1" role="dialog" aria-labelledby="addBlogModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBlogModalLongTitle" style="display: inline-block">Add Blog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="posting-blog" v-if="isPosting">
                            <div class="loader"><div></div><div></div><div></div><div></div></div>
                            <h6>Posting...</h6>
                        </div>
                       <div class="add-blog-body px-1 ">
                          <div class="row blog-head ">
                              <div class="blog-img-cat col-md-5">
                                  <div class="blog-image ">
                                      <label for="">CHOOSE IMAGE</label>
                                      <input @change="fileSelected" class="form-control mt-2"  required type="file">

                                  </div>

                                  <div class="blog-category mt-2">
                                      <label for="category">Category</label>
                                      <select name="category" v-model="category" class="form-control mt-2" id="cat">
                                          <option value="" selected disabled>- - Choose Category - -</option>
                                          <option :value="cat" v-for="cat in catlist">{{ cat }}</option>
                                      </select>
                                  </div>
                              </div>
                             <div class="link-n-title col-md-7">
                                 <div class="blog-title ">
                                     <label for="title">Blog Title</label>
                                     <input type="text" required v-model="title" name="title" class="form-control mt-2" placeholder="Blog title goes here ....">
                                 </div>
                                 <div class="content-link">
                                     <label for="link-input">Link <i class="ti-link "></i> <span class="badge badge-info">(optional)</span></label>
                                     <input type="text"  v-model="reflink" name="link-input" class="form-control mt-2" placeholder="Link to more resources eg Fb link ,Youtube etc ....">
                                 </div>
                             </div>
                          </div>
                           <div class="blog-content mt-2">

                               <div class="content-body ">
                                   <vue-editor v-model="content"></vue-editor>
<!--                                   <textarea name="blog-content" required v-model="content" class="form-control"  id="" cols="30" rows="14" placeholder="put blog content here ...."></textarea>-->
                               </div>
                               <div class="typing-progress">

                                   <span>{{ numOfCharacters }} / 982 Characters </span>
                               </div>
                           </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="postBlog" class="btn btn-primary">Post</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'
    export default {
        components:{
            VueEditor
        },
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


            resetBlog(){
                this.file = null
                this.title = ''
                this.content = ''
                this.reflink = ''
                this.category = ''
            },
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
                this.$router.push({ name : 'blog' , params : {  id , title }})
            },
            postBlog(){
                this.isPosting = true;

                let fd = new FormData();
                fd.append('image',this.file)
                fd.append('title',this.title)
                fd.append('reflink',this.reflink)
                fd.append('type',this.category)
                fd.append('content',this.content)



                axios.post( '/addBlog',fd,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then( res =>{
                        this.isPosting = false;

                        if(res.status == 201){
                            Fire.$emit('BlogChanged');

                            Toast.fire({
                                icon: 'success',
                                title: res.data
                            });

                            this.resetBlog();

                            this.modalOpenClose('#addBlogModal', 'close');

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
            fetchBlogs(blogsurl){
                let blogs_url = blogsurl || '/adminBlogs';

                axios.get(blogs_url)
                    .then(response =>{
                        this.allblogs = response.data.data;

                        this.makePagination(response.data.meta , response.data.links)
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
            fileSelected(e){
               this.file = e.target.files[0];
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
            },
            numOfCharacters:function () {
                return this.content.length;
            }

        },
        mounted() {
            this.fetchBlogs();

            Fire.$on('BlogChanged',()=>{
                this.fetchBlogs();

               console.log("Blog Changed");
            });

            console.log('Blogs Component mounted.')
        }
    }
</script>

<style scoped>
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

    .posting-blog{
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

    .blogs{
        width: 80.5vw;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .blogs-container{
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 98%;
        height: 98%;
        background-color: #FFFFFF;
        box-shadow: #11111122 ;
    }
</style>
