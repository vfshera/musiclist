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
                        <router-link :to="{ path: '/'}" class="nav-link"  :class="{ 'active-link':  ('/' == currPath)}">Home</router-link>
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
                    <li class="nav-item" id="cart">
                        <div class="inner-cart">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M4.4160156 1.9960938L1.0039062 2.0136719L1.0136719 4.0136719L3.0839844 4.0039062L6.3789062 11.908203L5.1816406 13.822266C4.3432852 15.161017 5.3626785 17 6.9414062 17L19 17L19 15L6.9414062 15C6.8301342 15 6.8173041 14.978071 6.8769531 14.882812L8.0527344 13L15.521484 13C16.247484 13 16.917531 12.605703 17.269531 11.970703L20.871094 5.484375C21.242094 4.818375 20.760047 4 19.998047 4L5.25 4L4.4160156 1.9960938 z M 7 18 A 2 2 0 0 0 5 20 A 2 2 0 0 0 7 22 A 2 2 0 0 0 9 20 A 2 2 0 0 0 7 18 z M 17 18 A 2 2 0 0 0 15 20 A 2 2 0 0 0 17 22 A 2 2 0 0 0 19 20 A 2 2 0 0 0 17 18 z" fill="#FFFFFF" />
                            </svg>
                            <span class="cart-items">
                                7
                            </span>
                        </div>
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
    #cart{
        position: fixed;
        top: 100px;
        right: 0px;
    }

    .cart-items{
        font-size: .4rem;
        position: absolute;
        top:5px;
        right: 5px;
        background-color: #2a62bc;
        padding: 3px 6px;
        border-radius: 50%;
    }

    .inner-cart svg {
        transition: .3ms ease-in-out;
    }
    .inner-cart svg :hover{
        transform: scale(1.1);
    }

    .inner-cart:hover{
        background-color: #ff4500cc;
        color: white;
    }

    .inner-cart{
        display: flex;
        justify-content: center;
        align-items: center;

        height: 40px;
        width: 40px;
        padding:5px 8px;
        background-color: orangered;
        color: white;
        border-bottom-left-radius: 10%;
        border-top-left-radius: 10%;
        transition: .3s ease-in-out;
    }


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
