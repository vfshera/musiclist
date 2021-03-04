<template>
    <div class="cancel-news">
        <div class="news-form">
            <h2>Enter Email To Opt Out</h2>
            <form @submit.prevent="optOut" class="mt-2">
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" v-model="email" class="form-control" required >
                </div>
                <button class="btn btn-primary" type="submit">Opt Out</button>
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
               }

                Swal.fire({
                    icon: 'question',
                    title: 'Removing '+this.email+ 'From Newsletter'
                })
            }
        },
        mounted() {

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

    form , form button{
        width: 100%;
    }

</style>
