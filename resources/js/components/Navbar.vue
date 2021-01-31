<template>
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm col-md-12">
        <div class="container">
            <router-link :to="{ path: '/'}" class="logo-link" >
                <img src="/storage/site-img/logo.svg" height="30px" alt="tony-on-the-trak-logo" @mouseover="hoverImg(true)" @mouseout="hoverImg(false)">
            </router-link>
            <ul class="mx-auto tott-name">
                TONY ON THE TRACK
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#tottlinks" aria-controls="tottlinks" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="tottlinks">

             <!--  left navbar-->
                <ul class="navbar-nav mr-auto">

                </ul>

             <!--   right navbar-->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item " >
                        <router-link :to="{ path: '/'}" href="/#home" class="nav-link"  :class="{ 'active-link': ('/#home' == currPath) || ('/' == currPath)}">Home</router-link>
                    </li>
                    <li class="nav-item ">
                        <a href="/#beats" class="nav-link" :class="{ 'active-link': ('/#beats' == currPath) }">Beats</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#drumkits" class="nav-link" :class="{ 'active-link': ('/#drumkits' == currPath) }">Drumkits</a>
                    </li>
                    <li class="nav-item ">
                        <a href="#blog" class="nav-link" :class="{ 'active-link': ('/#blog' == currPath) }">Blog</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#gallery" class="nav-link" :class="{ 'active-link': ('/#gallery' == currPath) }">Gallery</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#contact" class="nav-link" :class="{ 'active-link': ('/#contact' == currPath) }">Contact</a>
                    </li>
                    <li class="nav-item " id="donate">
                        <router-link :to="{ path: '/donate'}" class="nav-link">Donate <span id="donate-heart">&hearts;</span></router-link>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'Navbar',
        data(){
            return{
            currPath: '/'
            }
        },
        methods:{
            hoverImg(value){
                const logo = document.querySelector('.logo-link img')
                if(value){
                    logo.src = '/storage/site-img/adminlogo.png';

                }else{
                    logo.src = '/storage/site-img/logo.svg';
                }
            }
        },
        watch:{
        $route (to, from){
            this.currPath = to.fullPath;
        }
    },

    mounted() {

           this.currPath = this.$route.fullPath;
    },

    }
</script>
<style scoped>
    .logo-link img{
        display: inherit !important;
        height: inherit;
    }

.active-link{
    border-bottom:2px solid #152238;
    font-weight: bold;
    color: black !important;
}

.nav-item:hover{
    border-bottom:2px solid #15223822;
}

#donate:hover{
    border-bottom:none;
}

#donate-heart {
    animation: pulse 1000ms linear infinite;
}

@keyframes pulse {
    0%{
        opacity: .99;
    }

    70%{
        opacity: .5;
    }

    100%{
        opacity: .2;
    }
}


#donate{
    background-color: orangered;
    border-radius: 20px;
    width: 100px;
    display: flex;
    justify-content: center;
}

#donate .nav-link{
    color: white;
}
.nav-item{
    list-style: none;
}
 .nav-link{
        text-decoration: none;
        cursor: pointer;
 }
</style>
