<template>
    <div class="blog-drumkit p-4">
       <div class="drumkit-outer">
           <button class="back-btn p-2" @click.prevent="prevPage"><i class="ti-arrow-left"></i></button>
           <div class="drumkit-inner">
                <div class="kit-sample-img col-md-5">
                    <div class="blog-header  mt-5" :style="{ backgroundImage: `url(${ drumkit.image } )` }">

                    </div>

                    <audio :src="drumkit.sample" controls class="mt-5"></audio>
                </div>
               <div class="drumkit-info col-md-6">
                   <h3 class="title">{{ drumkit.title }}</h3>
                   <p v-html="drumkit.about"></p>
               </div>
           </div>
           <div class="updates p-2">
              <button class="edit-drumkit" @click.prevent="editDrumkit">
                  <i  class="ti-pencil" ></i>
              </button>
              <button class="delete-drumkit" @click.prevent="deleteDrumkit(drumkit.id)">
                  <i  class="ti-trash" ></i>
              </button>
           </div>

       </div>


<!--        modal-->
        <div class="modal fade" id="EditDrumkitModal" tabindex="-1" role="dialog" aria-labelledby="EditDrumkitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditDrumkitModalLongTitle" style="display: inline-block">Update Drumkit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="posting-drumkit" v-if="isPosting">
                            <div class="loader"><div></div><div></div><div></div><div></div></div>
                            <h6>Posting...</h6>
                        </div>
                        <div class="add-drumkit-body px-1 ">
                            <div class="row drumkit-head ">
                                <div class="drumkit-cover col-md-6">
                                    <div class="drumkit-title ">
                                        <label for="title">Drumkit Title</label>
                                        <input type="text" id="title" required v-model="editedDrumkit.title" name="title" class="form-control mt-2" placeholder="Drumkit title goes here ....">
                                    </div>
                                    <div class="cover">
                                        <label for="drumkit-cover">Drumkit Cover</label>
                                        <input @change="getDrumkitCover" id="drumkit-cover" class="form-control mt-2" required type="file">
                                    </div>
                                    <div class="drumlink">
                                        <label for="drumkit-link">Drumkit Link</label>
                                        <input  id="drumkit-link" v-model="editedDrumkit.drumlink" required type="url" class="form-control mt-2" placeholder="Kit Link goes here ....">
                                    </div>
                                </div>
                                <div class="link-n-title col-md-6">
                                    <div class="drumkit-type">
                                        <label for="type">Drumkit Type</label>
                                        <input type="text" id="type" required v-model="editedDrumkit.type" name="title" class="form-control mt-2" placeholder="Kit type goes here ....">
                                    </div>
                                    <div class="content-link">
                                        <label for="sample">Sample Audio</label>
                                        <input @change="getDrumkitSample" id="sample" required type="file" class="form-control mt-2">
                                    </div>
                                    <div class="drumkit-price ">
                                        <label for="type">Drumkit Price</label>
                                        <input type="number" min="0" step="0.1"    id="price" required v-model="editedDrumkit.price" name="price" class="form-control mt-2" placeholder="Enter Kit Price ...">
                                    </div>
                                </div>
                            </div>
                            <div class="drumkit-content mt-2">
                                <div class="content-body ">
                                    <vue-editor required v-model="editedDrumkit.about"   placeholder="Put drumkit content here ...."></vue-editor>
                                 </div>
                                <div class="typing-progress">
                                    <span>{{ numOfCharacters }} / 982 Characters </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" @click="updateDrumkit" class="btn btn-primary">Update</button>
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
    name: 'DrumkitPost',
    data(){
        return{
            drumkit:[],
            isPosting: false,
            editedDrumkit: {
                id:'',
                drumlink:'',
                price: 0,
                title: '',
                type: '',
                about: '',
                cover:null,
                sample: null,
            },
        }
    },
    methods:{
        validate(){
            if(this.editedDrumkit.drumkit != null && this.editedDrumkit.title  != null &&  this.editedDrumkit.about != null &&    this.editedDrumkit.cover != null &&   this.editedDrumkit.sample != null){
                return true;
            }else{
                return false;
            }
        },
        resetDrumkit(){

            this.editedDrumkit.drumkit = null;
            this.editedDrumkit.title = '';
            this.editedDrumkit.type = '';
            this.editedDrumkit.price = 0;
            this.editedDrumkit.about = '';
            this.editedDrumkit.cover = null;
            this.editedDrumkit.sample = null;

               },
        getDrumkitZip(e){
            this.editedDrumkit.drumkit = e.target.files[0];
        },
        getDrumkitCover(e){
            this.editedDrumkit.cover = e.target.files[0];
        },
        getDrumkitSample(e){
            this.editedDrumkit.sample = e.target.files[0];
        },
        deleteDrumkit(id){
            Swal.fire({
                title: 'Delete Drumkit?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/deleteDrumkit/'+ id)
                        .then(response => {
                           if(response.status == 200) {

                               Toast.fire({
                                   icon: 'success',
                                   title: response.data
                               });

                               localStorage.removeItem('readDrumkit')
                               this.$store.commit('setReadDrumkit', {});
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
        updateDrumkit(){
          if(this.validate()){
              this.isPosting = true;

              let fd = new FormData();

              fd.append('image',this.editedDrumkit.cover)
              fd.append('title',this.editedDrumkit.title)
              fd.append('type',this.editedDrumkit.type)
              fd.append('sample',this.editedDrumkit.sample)
              fd.append('drumkit',this.editedDrumkit.drumkit)
              fd.append('price',this.price)
              fd.append('about',this.editedDrumkit.about)

              axios.post( '/updateDrumkit/'+this.editedDrumkit.id,fd,
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

                      this.modalOpenClose('#EditDrumkitModal','close');
                      this.refreshDrumkit();

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
        editDrumkit(){
            this.editedDrumkit = this.drumkit;
            this.modalOpenClose('#EditDrumkitModal','open');
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
        setDrumkit(){
            axios.get('/getDrumkit/'+ this.$route.params.id)
                .then(response =>{
                    if(response.status == 200){
                        this.drumkit = response.data.data;

                        if( localStorage.getItem('readDrumkit')){
                            localStorage.removeItem('readDrumkit')
                        }

                        localStorage.setItem('readDrumkit' , JSON.stringify(response.data.data));

                        this.$store.commit('setReadDrumkit', response.data.data);

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
        refreshDrumkit(){

            axios.get( '/getDrumkit/'+this.editedDrumkit.id).then(resp => {

                if( localStorage.getItem('readDrumkit')){
                    localStorage.removeItem('readDrumkit')
                }

                localStorage.setItem('readDrumkit' , JSON.stringify(resp.data));
                this.$store.commit('setReadDrumkit', resp.data);

                this.setDrumkit()

            }).catch(err => {
                Toast.fire(err)
            })

        }
    },
    computed:{
        numOfCharacters:function () {
            return this.editedDrumkit.about.length;
        }
    },
    mounted(){
        this.setDrumkit();
        console.log('Drumkit Post Mounted')
    }
}
</script>

<style scoped>
.kit-sample-img{
    display: flex;
    flex-direction: column;
}

.drumkit-outer{
    display: flex;
    justify-content: space-around;
    width: 78vw;
    padding: 10px;
    background-color: white;
    border-radius: 10px;
}

.drumkit-inner{
    display: flex;
    justify-content: space-around;
    width: 78vw;
}

.updates{
    display: flex;
    justify-content: space-around;
}

/*loader*/

.drumkiting-blog{
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


    .blog-drumkit{
        width: 81.4vw;
        min-height: 100vh;
        display: flex;
        border-radius: 15px;
        box-shadow: 0px 0px 10px -10px #111111;
    }
    .title{
        padding: 15px;
        color: black;
    }
    .blog-header{
        height: 50vh;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 7px;
        object-fit: cover;
        background-position: center;
        background-size: cover;
    }


    .back-btn{
        width: 45px;
        height: 40px;
        margin: .5rem !important;
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

    .edit-drumkit{
        width: 40px;
        height: 40px;
        background-color: #007bff;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .edit-drumkit:hover{
        width: 50px;
        height: 50px;
        background-color: #ffffff99;
        color: #007bff;
        border-radius: 45px;
    }

    .delete-drumkit{
        margin-left: 10px;
        width: 40px;
        height: 40px;
        background-color: red;
        color: white;
        border-radius: 25px;
        transition: .4s ease-in-out;
    }

    .delete-drumkit:hover{
        width: 50px;
        height: 50px;
        background-color: #ffffff99;
        color: red;
        border-radius: 45px;
    }

    .drumkit-info{
        display: flex;
        flex-direction: column;
        padding:15px;
        min-height: 50vh;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        background-image: linear-gradient(0deg,#11111111,#ffffff77);
    }

    .drumkit-info p {
        margin-top: 15px;
        background-color: #ffffff;
        min-height: 42vh;
        border-radius: 15px;
        padding:15px;
        color: black;
    }
</style>
