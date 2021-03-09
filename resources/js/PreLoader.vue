<template>
 <div  class="pre-loader">
     <img src="/storage/site-img/logo.svg"  alt="tony-on-the-trak-logo" >
 </div>
</template>

<script>

export default {
    name: "PreLoader",
    mounted(){
        document.onreadystatechange = () => {
            if(document.readyState == 'complete'){
                document.querySelector('.pre-loader').style.display = "none"
            }
        }

    }
}
</script>

<style scoped>

.pre-loader{

    top: 0;
    left: 0;
    position: fixed;
    z-index: 99;
    height:100%;
    width:100%;
    display: flex;
    justify-content: center;
    align-items: center;

    animation: bgBreath 3s ease-in infinite;
}
.pre-loader img{
    animation: logoBreath 3s ease-in infinite;
}

    @keyframes logoBreath {
       0%{
           height: 150px;
           opacity: 1;
       }
        70%{
           height: 80px;
            opacity: 1;
       }
        100%{
           height: 150px;
            opacity: 1;
       }
    }
    @keyframes bgBreath {
       0%{
           background: #ffffff99;
       }
        70%{
            background: #ffffffbb;
       }
        100%{
            background: #ffffff99;
       }
    }
</style>
