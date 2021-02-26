<template>
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm col-md-12">
        <div class="container">
            <router-link :to="{ path: '/'}" class="logo-link" >
                <img src="/storage/site-img/logo.svg" height="30px" alt="tony-on-the-trak-logo" @mouseover="hoverImg(true)" @mouseout="hoverImg(false)">
            </router-link>
            <ul class="mx-auto tott-name">
                TONY GREGORY
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
                        <a href="/#hero" class="nav-link"  :class="{ 'active-link':  ('/' == currPath)}">Home</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#beats" class="nav-link" :class="{ 'active-link': ('/#beats' == currPath) }">Beats</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#drumkits" class="nav-link" :class="{ 'active-link': ('/#drumkits' == currPath) }">Drumkits</a>
                    </li>
                    <li class="nav-item ">
                        <a href="/#front-blogs" class="nav-link" :class="{ 'active-link': ('/#front-blogs' == currPath) }">Blog</a>
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
                    <li class="nav-item" id="cart"  data-toggle="modal"  data-target="#miniCartModal" :class="{ 'hideCart' : cartCount < 1 , 'cart' : cartCount > 0}" >
                        <div class="inner-cart">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" fill="#FFFFFF">
                                <path d="M4.4160156 1.9960938L1.0039062 2.0136719L1.0136719 4.0136719L3.0839844 4.0039062L6.3789062 11.908203L5.1816406 13.822266C4.3432852 15.161017 5.3626785 17 6.9414062 17L19 17L19 15L6.9414062 15C6.8301342 15 6.8173041 14.978071 6.8769531 14.882812L8.0527344 13L15.521484 13C16.247484 13 16.917531 12.605703 17.269531 11.970703L20.871094 5.484375C21.242094 4.818375 20.760047 4 19.998047 4L5.25 4L4.4160156 1.9960938 z M 7 18 A 2 2 0 0 0 5 20 A 2 2 0 0 0 7 22 A 2 2 0 0 0 9 20 A 2 2 0 0 0 7 18 z M 17 18 A 2 2 0 0 0 15 20 A 2 2 0 0 0 17 22 A 2 2 0 0 0 19 20 A 2 2 0 0 0 17 18 z" fill="#FFFFFF" />
                            </svg>
                            <span class="cart-items" >
                                {{ cartCount }}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>



        <!--        minicart modal-->
        <div class="modal fade" id="miniCartModal" tabindex="-1" data-backdrop="false"  role="dialog" aria-labelledby="miniCartModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="miniCartModalTitle" style="display: inline-block">Cart</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mini-cart">

                            <div class="beat-cart pb-2" v-show="$store.getters.getBeatCart.length > 0">
                                <h5 class="row ml-1 font-weight-bold">Beats ( {{ $store.getters.getBeatCart.length }} )</h5>
                                <hr>
                                <div class="cart-item  d-flex justify-content-center align-items-center mb-2" v-for="(beatItem,index) in $store.getters.getBeatCart">
                                    <div class="cart-item-image col-md-2" >
                                        <img style="height: 60px;width: 60px" :src="beatItem.cover" :alt="beatItem.title+' Beat Cover' ">
                                    </div>
                                    <div class="cart-item-title col-md-6">
                                        {{ beatItem.title}}
                                    </div>
                                    <div class="cart-item-price col-md-3">
                                        <select name="beat-pack" id="beat-pack" class="form-control" >
                                            <option :value="lic.code" v-for="lic in $store.getters.getBeatLicenses">${{ lic.amount }} {{ lic.code }}</option>
                                        </select>
                                    </div>
                                    <div class="remove-cart-item col-md-1">
                                        <span @click="removeFromCart(0,beatItem)">&times;</span>
                                    </div>
                                </div>
                            </div>

                           <div class="kit-cart px-2" v-show="$store.getters.getKitCart.length > 0">
                               <h5 class="row ml-1 font-weight-bold">Drumkits ( {{ $store.getters.getKitCart.length }} )</h5>
                               <hr>
                               <div class="cart-item  d-flex justify-content-center align-items-center mb-2" v-for="kitItem in $store.getters.getKitCart">
                                   <div class="cart-item-image col-md-2" >
                                       <img style="height: 60px;width: 60px" :src="kitItem.image" :alt="kitItem.title+' Beat Cover' ">
                                   </div>
                                   <div class="cart-item-title col-md-6">
                                       {{ kitItem.title }}
                                   </div>
                                   <div class="cart-item-price col-md-3">
                                       $ {{ kitItem.price }}
                                   </div>
                                   <div class="remove-cart-item col-md-1">
                                       <span @click="removeFromCart(1,kitItem)">&times;</span>
                                   </div>
                               </div>
                           </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Shopping</button>
                        <button type="button" class="btn btn-primary">Checkout</button>
                    </div>
                </div>
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
            removeFromCart(type,item){
                if(type == 0){

                    let index = this.$store.getters.getBeatCart.indexOf(item)
                    this.$store.getters.getBeatCart.splice(index,1)

                    if(localStorage.getItem('beatCart')){
                        localStorage.removeItem('beatCart')
                    }

                    if(this.$store.getters.getBeatCart.length > 0) {
                        localStorage.setItem('beatCart' ,  JSON.stringify(...this.$store.getters.getBeatCart));
                    }


                }else if(type == 1){

                    let index = this.$store.getters.getKitCart.indexOf(item)
                    this.$store.getters.getKitCart.splice(index,1)

                    if(localStorage.getItem('kitCart')){
                        localStorage.removeItem('kitCart')
                    }

                    if(this.$store.getters.getKitCart.length > 0){
                        localStorage.setItem('kitCart' ,  JSON.stringify(...this.$store.getters.getKitCart));
                    }

                }


                if(this.$store.getters.getBeatCart.length == 0 && this.$store.getters.getKitCart.length > 0) {
                    $('miniCartModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            },
            hoverImg(value){
                const logo = document.querySelector('.logo-link img')
                if(value){
                    logo.src = '/storage/site-img/adminlogo.png';

                }else{
                    logo.src = '/storage/site-img/logo.svg';
                }
            }
        },
        computed:{
            cartCount: function() {
                return this.$store.getters.getKitCart.length + this.$store.getters.getBeatCart.length
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
    .hideCart{
        display: none;
    }
    .remove-cart-item{
        transform: scale(1.5);
        color: orangered;
        transition: .9ms ease-in-out;
    }
    .remove-cart-item:hover{
       transform: scale(2);
    }

    .remove-cart-item span{
        cursor: pointer;
        padding: 2px 8px;
        border-radius: 50%;
        transition: 1ms ease-in-out;
    }
    .remove-cart-item span:hover{
        background-color: #8c8c8c11;

    }
    .cart{
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
        transition: .5ms ease-in-out;
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
