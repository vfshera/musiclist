<template>
    <div class="terms-conditions">
       <h3>Terms & Conditions</h3>
    </div>
</template>

<script>
    export default {
        name: "TermsNConditions",
        mounted() {
            window.scrollTo(0,0)
            console.log('TnC   Component mounted.')
        }
    }
</script>
<style scoped>
    .terms-conditions{
        margin-top: 60px;
        padding-top:20px;
        display: flex;
        justify-content: center;
        min-height:70vh;
    }
</style>
