<template>
    <div class="info">
        <div class="info-header">
            <h3><i class="info-icon ti-info-alt" ></i> {{ tabName }} Info</h3>
            <div class="info-tabs">
                <span class="tab-item " :class="{ 'active-tab':  (1 == currTab)}" @click.prevent="setTab(1)">
                    <a href="#" class="tab-link" >Beats</a>
                </span>
                    <span class="dot">.</span>
                <span class="tab-item " :class="{ 'active-tab':  (2 == currTab)}" @click.prevent="setTab(2)">
                    <a href="#" class="tab-link" >Drumkits</a>
                </span>
                     <span class="dot">.</span>
                <span class="tab-item " :class="{ 'active-tab':  (3 == currTab)}" @click.prevent="setTab(3)">
                    <a href="#" class="tab-link" >Blog</a>
                </span>
                     <span class="dot">.</span>
                <span class="tab-item " :class="{ 'active-tab':  (4 == currTab)}" @click.prevent="setTab(4)">
                    <a href="#" class="tab-link" >Gallery</a>
                </span>
            </div>
        </div>

        <div class="tab-content">
                <div class="beat-info row" v-show="currTab == 1">

                   <div class="info-visual col-md-5">
                        <div class="visual-img">
                            COVER <br>
                            <span>{{ sizes[currTab] }}</span>
                        </div>
                   </div>
                    <div class="info-notes col-md-7">
                        <div class="info-item">
                        <span class="info-param">
                          <i class="info-icon ti-image"></i>  Beat Cover
                        </span>
                            <span class="info-param-value">
                            Size {{ sizes[currTab] }}
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-music"></i> Sample Audio
                        </span>
                            <span class="info-param-value">
                            MUST be of type .mp3
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                            <i class="info-icon ti-text"></i>Title
                        </span>
                            <span class="info-param-value">
                            Write In Sentence Case (without hyphen or underscore)
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                             <i class="info-icon ti-key"></i>BPM & Key
                        </span>
                            <span class="info-param-value">
                            Accepted Format 96.0 , C# Major
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-tag"></i>Tags
                        </span>
                            <span class="info-param-value">
                            Write In Lowercase
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-link"></i>  MP3 LINK
                        </span>
                            <span class="info-param-value">
                            Link To Basic License (BSC)
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-link"></i>  MP3 + WAV LINK
                        </span>
                            <span class="info-param-value">
                            Link To Premium License (PRE)
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                            <i class="info-icon ti-link"></i> MP3 + WAV + STEMS LINK
                        </span>
                            <span class="info-param-value">
                            Link To Unlimited License (UNL)
                        </span>
                        </div>
                    </div>

                </div>
                <div class="kit-info row" v-show="currTab == 2">

                   <div class="info-visual col-md-5">
                        <div class="visual-img">
                            COVER<br>
                            <span>{{ sizes[currTab] }}</span>
                        </div>
                   </div>
                    <div class="info-notes col-md-7">
                        <div class="info-item">
                        <span class="info-param">
                          <i class="info-icon ti-image"></i>  Drumkit Cover
                        </span>
                            <span class="info-param-value">
                            Size {{ sizes[currTab] }}
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-music"></i> Sample Audio
                        </span>
                            <span class="info-param-value">
                            MUST be of type .mp3
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                            <i class="info-icon ti-text"></i>Title
                        </span>
                            <span class="info-param-value">
                            Write In Sentence Case (without hyphen or underscore)
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                             <i class="info-icon ti-money"></i>Price
                        </span>
                            <span class="info-param-value">
                            Accepted ONLY numbers to 2 Decimal Points
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-layers"></i>Type
                        </span>
                            <span class="info-param-value">
                            Write In Sentence Case
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-link"></i>  Drumkit Link
                        </span>
                            <span class="info-param-value">
                            Link To Drumkit Zip File
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-help"></i>  About Kit Area
                        </span>
                            <span class="info-param-value">
                            Use Accepted Formats with Sentence Case
                        </span>
                        </div>

                    </div>

                </div>
                <div class="blog-info row" v-show="currTab == 3">

                   <div class="info-visual col-md-5">
                        <div class="visual-img">
                            IMAGE<br>
                            <span>{{ sizes[currTab] }}</span>
                        </div>
                   </div>
                    <div class="info-notes col-md-7">
                        <div class="info-item">
                        <span class="info-param">
                          <i class="info-icon ti-image"></i> Blog Image
                        </span>
                            <span class="info-param-value">
                            Size {{ sizes[currTab] }}
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                            <i class="info-icon ti-text"></i>Title
                        </span>
                            <span class="info-param-value">
                            Write In Sentence Case (without hyphen or underscore)
                        </span>
                        </div>


                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-layers"></i>Category
                        </span>
                            <span class="info-param-value">
                            Just Choose From Dropdown
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-tag"></i>Add Category Button
                        </span>
                            <span class="info-param-value">
                            Use Sentence Case
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-link"></i>Link
                        </span>
                            <span class="info-param-value">
                            Link To Related Files Accounts etc
                        </span>
                        </div>

                        <div class="info-item">
                        <span class="info-param">
                           <i class="info-icon ti-thought"></i> Content
                        </span>
                            <span class="info-param-value">
                            Use Accepted Formats with The Text Editor
                        </span>
                        </div>

                    </div>

                </div>
                <div class="gallery-info row" v-show="currTab == 4">

                   <div class="info-visual col-md-8">
                        <div class="visual-img">
                            IMAGE<br>
                            <span>{{ sizes[currTab] }}</span>
                        </div>
                   </div>
                    <div class="info-notes col-md-4">
                        <div class="info-item">
                        <span class="info-param">
                          <i class="info-icon ti-image"></i> Gallery Image
                        </span>
                            <span class="info-param-value">
                            Size {{ sizes[currTab] }}
                        </span>
                        </div>

                    </div>

                </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                currTab: 1,
                tabName: 'Beat',
                sizes: [
                    '',
                    '100px by 200px',
                    '1000px by 1500px',
                    '100px by 200px',
                    '1000px by 800px',
                ]
            }
        },
        methods:{
            setTab(tab){

                this.currTab = tab;
                let names = ['','Beat','Drumkit','Blog','Gallery']

                this.tabName = names[this.currTab]
            }
        },
        computed:{

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style scoped>
    .info{
        display: flex;
        flex-direction: column;
        padding: 20px;
    }

    .info-header{
        background-color: white;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom: 1px #11111122 solid;
    }

    .info-tabs{
        display: flex;
        justify-content: space-between;
        width:30%;
    }
    .tab-item{
        width: 20%;
        display: flex;
        justify-content: center;
    }
    .dot{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .active-tab{
        border-bottom: 2px #11111177 solid;
    }


    .active-tab .tab-link {
        color: #111111;
        font-weight: bold;

    }

    .tab-content{
        padding: 10px 30px 10px 20px;
        width: 100%;
        min-height: 70vh;
        background-color: white;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .beat-info , .gallery-info, .blog-info , .kit-info{
        min-height: 65vh;
    }
    .info-notes{
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }
    .info-item{
        display: flex;
        justify-content: space-between;
        border-bottom: 1px #8c8c8c33 dotted;
        padding-bottom: 10px;
    }

    .info-param-value{
        text-align: right;
    }

    .info-visual{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .visual-img{
        height: 90%;
        width: 90%;
        border-radius:10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 5rem;
        font-weight: bolder;
        text-align: center;
        color: #11111177;

        background: linear-gradient(45deg, #8c8c8c33,#8c8c8c77,#8c8c8ccc,#8c8c8c77,#8c8c8c99,#8c8c8c33);
        background-size: 1000%;
        animation: imggradient 20s linear infinite;
    }


    @keyframes imggradient {
        0% {
            background-position: 0%;
        }
        100%{
            background-position: 1000%;

        }
    }
    .visual-img span{
        color: #11111177;
        font-weight: bolder;
        text-align: center;
        font-size: 3rem;
    }
    .ti-info-alt{
        font-size: 1.5rem;
        color: #03a9f3;
    }

    .info-icon{
        margin-right: 10px;
    }


</style>
