<template>
    <nav class="navbar navbar-expand-sm navbar-default">
        <form id="logout-form" action="/logout" method="POST" style="display: none;">

        </form>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li  :class="{ 'selected-menu': ('/home' == currPath) }">
                    <router-link :to="{ path: '/home'}" class="" ><i class="menu-icon fa fa-laptop"></i>Dashboard</router-link>
                </li>

                <li  :class="{ 'selected-menu': ('/blogs' == currPath) }">
                    <router-link :to="{ path: '/blogs'}" class="" ><i class="menu-icon ti-comments"></i>Blog</router-link>
                </li>

                 <li  :class="{ 'selected-menu': ('/gallery' == currPath) }">
                    <router-link :to="{ path: '/gallery'}" class="" ><i class="menu-icon ti-image"></i>Gallery</router-link>
                </li>

                 <li  :class="{ 'selected-menu': ('/drumkits' == currPath) }">
                    <router-link :to="{ path: '/drumkits'}" class="" ><i class="menu-icon fas fa-drum" ></i>Drumkits</router-link>
                 </li>

                 <li  :class="{ 'selected-menu': ('/beats' == currPath) }">
                    <router-link :to="{ path: '/beats'}" class="" ><i class="menu-icon ti-headphone"></i>Beats</router-link>
                 </li>

                <li  :class="{ 'selected-menu': ('/' == currPath) }">
                    <router-link :to="{ path: '/home'}" class="" ><i class="menu-icon ti-info-alt"></i>Info</router-link>
                </li>

                <li @click="logoutUser" class="logout-btn">
                    <router-link :to="{ path: ''}" class="" ><i class="menu-icon ti-arrow-circle-right" ></i>Logout</router-link>
                </li>

            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: 'AdminSidebar',
        data(){
            return{
            currPath: '/home'
            }
        },
        methods:{

            logoutUser(){
                axios.post('/logout')
                    .then(() => {
                        localStorage.removeItem('isLoggedIn');
                        localStorage.removeItem('LoggedInAs');

                        location.href = '/'
                    })
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
    .selected-menu a , .selected-menu a i{
        color: #03a9f3 !important;
        font-weight: bold !important;
        font-size: 18px !important;
    }
    .logout-btn{
        cursor: pointer;
    }

    .logout-btn i,.logout-btn a{
        color: orangered !important;
    }


</style>
