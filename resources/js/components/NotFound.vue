<template>
    <div class="four-o-four">
       <h1>404</h1>
       <h3>PAGE NOT FOUND</h3>
        <router-link :to="{ path: '/'}" class="nav-link" >GET HOME</router-link>
    </div>
</template>

<script>
    export default {
        name: '404 PAGE',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    .four-o-four{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 75vh;
    }

    .four-o-four h1{
        font-size: 15rem;
        animation: animfour 5s infinite;
    }
    @keyframes animfour {
        0%{
            opacity: 1;
        }
        70%{
            opacity: .5;
            transform: translateY(5px);
         }
        75%{
            opacity: 1;
        }
        80%{
            opacity: .2;
            transform: translateY(7px);
        }
        85%{
            opacity: 1;
        }
        100%{
            opacity: 1;
        }
    }
    .four-o-four a{
        font-size: 1rem;
        font-weight: bold;
        color:white;
        background-color: mediumseagreen;
        padding: .8rem 2rem;
        border-radius: 5%;
    }

    .four-o-four a , .four-o-four h3{
        animation: swing 5s infinite;
    }

    @keyframes swing {
        0%{
            transform: translateY(7px);
        }
        50%{
            transform: translateY(-14px);
        }
        100%{
            transform: translateY(0px);
        }
    }
</style>
