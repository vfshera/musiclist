<template>
    <div class="donate-page container" >
       <div class="donate  col-md-8 ">
           <div class="donation-loc ">
               <h1>
                   Welcome To The Donation Page!
               </h1>
           </div>
           <div class="donation-body">
               <form class=" col-sm-11 col-xs-11 col-md-12">
                   <div class="form-group row ">
                       <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                           <input type="number" min="2" step="1" class="form__field" placeholder="Donation Amount..." pattern="[0-9]{8}" title="Donation is expressed in USD$.Minimum Amount 2$" name="amount" id='amount' required />
                           <label for="amount" class="form__label">Amount</label>
                       </div>
                   </div>
                   <div class="form-group row ">
                       <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                           <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="The email must be Valid like abc@xyz.com" class="form__field" placeholder="Your Email Address..." name="email" id='email' required />
                           <label for="email" class="form__label">Email</label>
                       </div>
                   </div>

                   <div class="form-group row ">
                       <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                           <textarea type="input" class="form__field" placeholder="Any Special Message..." name="message" id='message' required ></textarea>
                           <label for="message" class="form__label">Message (optional)</label>
                       </div>
                   </div>
                   <button class="pure-material-button-contained col-md-8 font-weight-bold py-2">SEND</button>
               </form>
           </div>
           <div class="supported-methods mt-5">
               Paypal | M-PESA
           </div>
       </div>
    </div>
</template>

<script>
    export default {
        name: "Donate",
        data(){
            return{
              amount: 5
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .donate-page{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .donate{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
