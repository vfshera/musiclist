<template>
    <div class="checkout">
        <h2>Checkout</h2>
        <div class="checkout-items">
                <div class="beat-busket">
                    <h6 class="row ml-1 font-weight-bold">Beats ( {{ $store.getters.getBeatCart.length }} )</h6>
                    <hr>
                    <div class="cart-item  d-flex justify-content-center align-items-center mb-2" v-for="(beatItem,index) in $store.getters.getBeatCart">
                        <div class="cart-item-image col-md-2" >
                            <img style="height: 60px;width: 60px" :src="beatItem.cover" :alt="beatItem.title+' Beat Cover' ">
                        </div>
                        <div class="cart-item-title col-md-8">
                            {{ beatItem.title}}
                        </div>
                        <div class="cart-item-price col-md-2">
                           {{  beatItem.Purchase }}
                        </div>

                    </div>
                </div>
                <div class="kit-busket">
                    <h6 class="row ml-1 font-weight-bold">Drumkits ( {{ $store.getters.getKitCart.length }} )</h6>
                    <hr>
                    <div class="cart-item  d-flex justify-content-center align-items-center mb-2" v-for="kitItem in $store.getters.getKitCart">
                        <div class="cart-item-image col-md-2" >
                            <img style="height: 60px;width: 60px" :src="kitItem.image" :alt="kitItem.title+' Beat Cover' ">
                        </div>
                        <div class="cart-item-title col-md-8">
                            {{ kitItem.title }}
                        </div>
                        <div class="cart-item-price col-md-2">
                            $ {{ kitItem.price }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CheckOut',
        methods:{
            scrollToTop() {
                window.scrollTo(0,0)
            },
            getLicPrice(code){
                const lic = this.$store.getters.getBeatLicenses.filter(lic => lic.code == code)

                console.log(lic)
            }
        },
        mounted() {
            this.getLicPrice('BSC')
            this.scrollToTop();
            this.$seohelpers.setSEO('Checkout');
            console.log('CheckOut Component mounted.')
        }
    }
</script>

<style scoped>
    .checkout{
        margin-top: 70px;
        min-height: 65vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .checkout-items{
        margin-top: 20px;
        min-height: 60vh;
        width: 75%;
        display: flex;
        justify-content: space-between;
        /*align-items: center;*/
        padding: 5px;
    }

    .beat-busket,  .kit-busket{
        width: 50%;
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .kit-busket{
        border-left: 1px #11111122 solid;
    }
</style>
