<template>
    <div class="cancel-news">
        <div class="news-form">
            <h2>Enter Email To Opt Out</h2>
            <form @submit.prevent="optOut" class="mt-2">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" v-model="email" class="form-control" required >
                </div>
                <div class="form-group btns">
                    <button class="btn btn-primary resend" type="submit">No Code?</button>
                    <button class="btn btn-success optout" type="submit">Opt Out</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CancelNewsletter',
        data(){
            return{
                email: '',
            }
        },
        methods:{
            optOut(){
               if(this.email == ''){
                   Swal.fire({
                       icon: 'error',
                       title: 'Email Incorrect!'
                   })

               }else{
                   Swal.fire({
                       icon: 'question',
                       title: 'Removing '+this.email+ 'From Newsletter'
                   })
               }
            }
        },
        mounted() {
            this.email = this.$route.params.mail
            console.log('Cancel News Component mounted.')
        }
    }
</script>

<style scoped>
    .cancel-news{
        display:flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .news-form{
        width: 40%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
    }

    form {
        width: 100%;
    }

    label , input{

        font-size: 18px;
    }
    .btns{
        display: flex;
        justify-content: space-between;
    }
    .resend , .optout{
        width:40%;
        padding: 10px 0px;
        font-size: 18px;
        font-weight: bold;
    }
</style>
