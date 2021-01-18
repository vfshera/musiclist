<template>
 <div id="master">

     <aside id="left-panel" class="left-panel">
         <AdminSidebar />
     </aside>


     <div id="right-panel" class="right-panel">

            <AdminNav :username=" this.user.name "/>

         <div class="">

             <router-view></router-view>

         </div>
         <div class="clearfix"></div>


         <footer class="site-footer">
             <div class="footer-inner bg-white">
                 <div class="row">
                     <div class="col-sm-6">
                         Copyright &copy; {{ new Date().getFullYear() }} Tony On The Track
                     </div>
                     <div class="col-sm-6 text-right">
                     </div>
                 </div>
             </div>
         </footer>
     </div>


 </div>
</template>

<script>
    import AdminSidebar from './components/AdminSidebar'
    import AdminNav from './components/AdminNav'

    export default {
        name: "Master",
        components :{
            AdminNav,AdminSidebar
        },
        props: ['user'],
        methods:{
            setUser(){
                let token = document.querySelector('meta[name="csrf-token"]').attributes[1].value
                this.$store.commit('setLoggedUser',this.user)
                this.$store.commit('setCSRF', token)

                localStorage.setItem('isLoggedIn',true);
                localStorage.setItem('LoggedInAs',JSON.stringify(this.user));
            }

        },
        mounted() {
            this.setUser();
        }
    }
</script>

<style scoped>



</style>
