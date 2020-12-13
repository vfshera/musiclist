<template>
 <div  id="tott" >
       <Navbar />
       <router-view></router-view>
       <Footer />
     <MusicPlayer/>
 </div>
</template>

<script>
    import Navbar from './components/Navbar'
    import Footer from './components/Footer'
    import MusicPlayer from "./components/MusicPlayer";

    export default {
        name: "Entry",
        components :{
            MusicPlayer,
            Navbar,Footer
        }
    }
</script>

<style scoped>

#tott{

}


</style>
