<template>
    <div class="front-drumkits">
        <div class="frontkits-container">
            <div class="lds-dual-ring" v-show="isProcessing"></div>

            <div class="drumkit-menu px-3 py-3">
                <h3>Drumkits</h3>
                <div class="search-bar px-2" :class="{ 'search-bar-focused': this.focused }" >
                    <input type="text" v-model="search" @focus="searchFocused(true)" @blur="searchFocused(false)" placeholder="Search Drumkit ...">
                </div>
            </div>
            <div class="px-3 pt-3 frontkits " :class="{ 'd-flex justify-content-between': (drumkits.length > 2) ,  'd-flex justify-content-center': (drumkits.length == 1)}">
                        <a href="#" class="mobile-kit" v-for="drumkit in searchableDrumkits" @click.prevent="viewDrumkit(drumkit)" :class="{ 'm-2': (drumkits.length == 2) }">
                            <figure class="col-xs-12" :style="{ backgroundImage: `url(${ drumkit.image } )` }">
                                <div :class="{ 'free': (drumkit.isFree) , 'date': (!drumkit.isFree)}"><span class="card-date-day">{{ drumkit.dprice }}</span></div>
                                <figcaption>
                                    <h4> <span>{{ drumkit.title }}</span></h4>
                                    <p>{{ drumkit.type}}</p>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
            </div>

            <div class="drumkit-controls px-4" >
                <ul class="pagination" v-show="pagination.last_page > 1">
                    <li :class="{ 'disabled' : !pagination.prev_url }" class="page-item">
                        <a class="page-link" href="" @click.prevent="fetchDrumkits(pagination.prev_url)">Prev</a>
                    </li>
                    <li class="page-item disabled" >
                  <span class="page-link text-dark">
                   Page {{ pagination.current_page }} of {{ pagination.last_page }}
                  </span>
                    </li>
                    <li class="page-item" :class="{ 'disabled' : !pagination.next_url }">
                        <a class="page-link" href="" @click.prevent="fetchDrumkits(pagination.next_url)">Next</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</template>

<script>

    export default {

        data(){
            return{
                focused : false,
                drumkits: [],
                search: '',
                isProcessing: true,
                pagination: {}

            }
        },
        methods:{

            searchFocused(value){

                this.focused = value;
            },
            viewDrumkit(drumkit){
                this.isProcessing = true;

                if( localStorage.getItem('viewDrumkit')){
                    localStorage.removeItem('viewDrumkit')
                }

                localStorage.setItem('viewDrumkit' , JSON.stringify(drumkit));

                this.$store.commit('setViewDrumkit', drumkit);
                this.isProcessing = false;

                let title = drumkit.title.toLowerCase().replace(/ /g , "-");
                let id = drumkit.id;
                this.$router.push({ name : 'drumkitView' , params : {  id , title }})

            },

            fetchDrumkits(drumkitsurl){
                let drumkits_url = drumkitsurl || '/frontDrumkits';

                axios.get(drumkits_url)
                    .then(response =>{
                        this.drumkits = response.data.data;

                        this.makePagination(response.data.meta , response.data.links)

                        this.isProcessing = false;

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
            }
        },
        computed:{
            searchableDrumkits:function (){
                return this.drumkits.filter(drumkit => {
                    return drumkit.title.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        mounted() {
            this.fetchDrumkits();

            console.log('Drumkits Component mounted.')
        }
    }
</script>

<style scoped>




    .content-link input , .drumkit-title input{
        width: 100%;
    }



    .drumkit-controls{
        display: flex;
        justify-content: flex-end;
    }
    .frontkits{
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
    .drumkit-card img{
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
    .drumkit-card{
        width: 17%;
        height: 31vh;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1);
        transition: .1s ease-in-out;
    }

    .drumkit-card:hover{
        transform: scale(1.02);
        border: 2px #007bff33 solid;
        box-shadow: 0 4px 10px 0 #007bff45 , 0 6px 22px 0 #007bff45;
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

    .drumkit-menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 3px #11111155 solid;

    }

    .front-drumkits{
        margin-top: 60px;
        width: 99.5vw;
        height: 83vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .frontkits-container{

        display: flex;
        flex-direction: column;
        border-radius: 10px;
        width: 75%;
        height: 98%;
        background-color: #FFFFFF;
        box-shadow: #11111122 ;
    }
</style>
