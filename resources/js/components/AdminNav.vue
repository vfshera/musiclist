<template>
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href=".."><img src="/storage/site-img/adminlogo.png" height="30px" alt="Logo" class="mr-2">ADMIN</a>
                <a class="navbar-brand hidden" href=".."><img src="/storage/site-img/adminlogo.png"  height="30px" alt="Logo" class="mr-2">ADMIN</a>
<!--                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>-->
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
              <div class="username-area">
                  <span>{{ this.username }}</span>
              </div>
            </div>
        </div>
    </header>
</template>

<script>


    export default {
        name: "AdminNav",
        props: ['username'],
        data(){
            return{

            }
        },
        mounted() {

        }
    }
</script>

<style scoped>


</style>
