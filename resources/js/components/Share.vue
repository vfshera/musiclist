<template>
    <div class="container">
        <!--        share modal-->

        <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Share {{ this.shared }}</p>
                        <div class="sharables">

                            <a :href="shareTweeter" class="share-items" onclick="window.open(this.href, 'twitterwindow','left=70,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;"><i class="ti-twitter share-icons"></i></a>
                            <a :href="shareFacebook" class="share-items" onclick="window.open(this.href, 'facebookwindow','left=70,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;"><i class="ti-facebook share-icons"></i></a>
                            <a :href="shareWhatsApp" class="share-items" onclick="window.open(this.href, 'whatsappwindow','left=70,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;" ><i class="fa fa-whatsapp share-icons"></i></a>
                            <i class="ti-clipboard share-items share-icons">

                            </i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--       end share modal-->
    </div>
</template>

<script>
    export default {
        name: 'Share',
        props: ["title","summary","image","shared"],
        data(){
            return{

            }
        },
        computed:{
            sharableLink:function () {
                return window.location.href;
            },
            shareTweeter: function () {
                return 'http://twitter.com/intent/tweet?text='+this.sharableLink;
            },
            shareFacebook:function () {
                return 'http://www.facebook.com/sharer.php?s=100&amp;p[title]=['+ this.title +']&amp;p[summary]=['+ this.content +']&amp;p[url]=['+this.$route.fullPath+']&amp;p[images[0]=['+ this.image +']';
            }
            ,
            shareWhatsApp:function () {
                return 'https://api.whatsapp.com/send?text='+ this.sharableLink;
            }


        },
        mounted() {
            console.log('Share Component mounted.')
        }
    }
</script>

<style scoped>

    .modal-body p{
        font-size: 1.7rem;
    }
    .modal-body{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .sharables{
        display: flex;
        justify-content: space-between;
    }

</style>
