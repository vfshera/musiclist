<template>
    <div class="blog-post p-4">
        <div class="blog-header" :style="{ backgroundImage: `url(${ post.image } )` }">
            <div class="blog-actions">
                <button class="back-btn" @click.prevent="prevPage"><i class="ti-arrow-left"></i></button>
               <div class="updates">
                   <button class="edit-blog" @click.prevent="editBlog">
                       <i  class="ti-pencil" ></i>
                   </button>
                   <button class="delete-blog" @click.prevent="deleteBlog(post.id)">
                       <i  class="ti-trash" ></i>
                   </button>
               </div>
            </div>
            <h3 class="title text-white">{{ post.title }}</h3>
        </div>
        <div class="blog-content">
            <span class="badge badge-light badge-pill">{{ post.reflink }}<a :href="post.reflink" target="_blank"> <i class="ti-world"></i></a></span>
            <p v-html="post.content"></p>
        </div>


<!--        modal-->

        <div class="modal fade" id="EditBlogModal" tabindex="-1" role="dialog" aria-labelledby="EditBlogModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditBlogModalLongTitle" style="display: inline-block">Edit Blog</h5>
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
                                        <select name="category" v-model="editedBlog.category" class="form-control mt-2" id="cat">
                                            <option value="" selected >- - Choose Category - -</option>
                                            <option :value="cat" v-for="cat in catlist">{{ cat }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="link-n-title col-md-7">
                                    <div class="blog-title ">
                                        <label for="title">Blog Title</label>
                                        <input type="text" required v-model="editedBlog.title" name="title" class="form-control mt-2" placeholder="Blog title goes here ....">
                                    </div>
                                    <div class="content-link">
                                        <label for="link-input">Link <i class="ti-link "></i> <span class="badge badge-info">(optional)</span></label>
                                        <input type="text"  v-model="editedBlog.reflink" name="link-input" class="form-control mt-2" placeholder="Link to more resources eg Fb link ,Youtube etc ....">
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content mt-2">

                                <div class="content-body ">
                                    <vue-editor v-model="editedBlog.content" placeholder="Put blog content here ...."></vue-editor>
<!--                                    <textarea name="blog-content" required v-model="editedBlog.content" class="form-control"  id="" cols="30" rows="14" placeholder="put blog content here ...."></textarea>-->
                                </div>
                                <div class="typing-progress">

                                    <span>{{ numOfCharacters }} / 982 Characters </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="updateBlog" class="btn btn-primary">Update</button>
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
    name: 'BlogPost',
    data(){
        return{
            post:[],
            isPosting: false,
            catlist: ["Entertainment", "Music", "Educational", "Self Help", "Psychology"],
            editedBlog: {
                file:null,
                title: '',
                content: '',
                category: '',
                reflink: '',
                id:'',
            },
        }
    },
    methods:{
        validate(){
            if(this.editedBlog.file != null && this.editedBlog.title != null && this.editedBlog.content != null && this.editedBlog.reflink != null){
                return true;
            }else{
                return false;
            }
        },
        resetBlog(){
            this.editedBlog.file = null
            this.editedBlog.title = ''
            this.editedBlog.content = ''
            this.editedBlog.reflink = ''


        },
        fileSelected(e){
            this.editedBlog.file = e.target.files[0];
        },
        deleteBlog(id){
            Swal.fire({
                title: 'Delete Blog?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/deleteBlog/'+ id)
                        .then(response => {
                           if(response.status == 200) {

                               Toast.fire({
                                   icon: 'success',
                                   title: response.data
                               });

                               localStorage.removeItem('readBlog')
                               this.$store.commit('setReadBlog', {});
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
        updateBlog(){
          if(this.validate()){
              this.isPosting = true;

              let fd = new FormData();
              fd.append('image',this.editedBlog.file)
              fd.append('title',this.editedBlog.title)
              fd.append('reflink',this.editedBlog.reflink)
              fd.append('content',this.editedBlog.content)


              axios.post( '/updateBlog/'+this.editedBlog.id,fd,
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

                      this.modalOpenClose('#EditBlogModal','close');
                      this.refreshBlog();

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
        editBlog(){
            this.editedBlog = this.post;
            this.modalOpenClose('#EditBlogModal','open');
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
        },
        refreshBlog(){

            axios.get( '/getBlog/'+this.editedBlog.id).then(resp => {

                if( localStorage.getItem('readBlog')){
                    localStorage.removeItem('readBlog')
                }

                localStorage.setItem('readBlog' , JSON.stringify(resp.data));
                this.$store.commit('setReadBlog', resp.data);

                this.setBlog()

            }).catch(err => {
                Toast.fire(err)
            })

        }
    },
    computed:{
        numOfCharacters:function () {
            return this.editedBlog.content.length;
        }
    },
    mounted(){
        this.setBlog();
        console.log('BlogPost Mounted')
    }
}
</script>

<style scoped>



/*loader*/

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


/*endloader*/


    .blog-post{
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
        width: 50px;
        height: 50px;
        background-color: #cccccc99;
        color: #111111;
        border-radius: 45px;
    }

    .edit-blog{
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .edit-blog:hover{
        width: 50px;
        height: 50px;
        background-color: #ffffff99;
        color: #007bff;
        border-radius: 45px;
    }

    .delete-blog{
        margin-left: 10px;
        width: 40px;
        height: 40px;
        background-color: red;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .delete-blog:hover{
        width: 50px;
        height: 50px;
        background-color: #ffffff99;
        color: red;
        border-radius: 45px;
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
