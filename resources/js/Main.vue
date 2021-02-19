<template>
 <div  id="tott" >
       <Navbar />
        <PreLoader/>
       <router-view></router-view>
       <Footer />
     <MusicPlayer/>
 </div>
</template>

<script>
    import Navbar from './components/Navbar'
    import Footer from './components/Footer'
    import MusicPlayer from "./components/MusicPlayer";
    import PreLoader from "./PreLoader";

    export default {
        name: "Entry",
        components :{
            MusicPlayer,
            Navbar,
            Footer,
            PreLoader
        }
    }
</script>

<style scoped>

#tott{

}


</style>
