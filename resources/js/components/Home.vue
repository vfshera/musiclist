<template>
    <div id="home">
        <div id="hero" >
          <div class="info">
              <h1>Tony On The Track</h1>
              <p class="container">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum libero perspiciatis, praesentium ratione saepe sapiente sed sint temporibus velit vero! Ab aliquam asperiores consequatur dolore esse ipsam libero necessitatibus neque nesciunt, numquam odio quas similique voluptatibus? Eum libero nulla ullam!</p>
          </div>
        </div>
        <div id="beats"  class=" my-5" >
            <h2 class="text-center">BEATS</h2>

            <!--                mobile-->
            <div class="mobile-track d-none" v-for=" track in beats">
                <div  class="m-cover-container" @click="selectTrack(track)">
                    <img class="m-cover" :src="track.cover" alt="" >
                </div>
                <div class="m-title-container " @click="selectTrack(track)">
                    <span class="m-title" > {{ track.title }}</span>
                </div>
                <div  class=" text-center ">
                    <p class="m-free-price" v-if="track.isFree">
                        <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                            <path fill="black" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                        </svg>
                        <span class="m-price-amount">{{ track.license }}</span>
                    </p>
                    <p class="m-price" v-if="!track.isFree">
                        <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                            <path fill="white" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                        </svg>
                        <span class="m-price-amount">{{ track.license }}</span>
                    </p>
                </div>
            </div>


            <!--                mobile-->


            <div id="beatList " class="container mt-5">
                <div id="labels"class="row mx-2">
                    <div id="cover" class="col-md-1">COVER</div>
                    <div id="title" class="col-md-5">TITLE</div>
                    <div id="time" class="col-md-1 text-center">TIME</div>
                    <div id="bpm" class="col-md-1 text-center">BPM</div>
                    <div id="actions" class="col-md-2"></div>
                    <div id="price" class="col-md-2 text-center">LICENSE</div>
                </div>

                <div class="track row " v-for=" track in beats" >
                    <div  class="col-md-1 ">
                        <img class="cover" :src="track.cover" alt="" @click="selectTrack(track)">
                    </div>
                    <div class="col-md-5 title-container">
                       <span class="title" @click="selectTrack(track)"> {{ track.title }}</span>
                    </div>
                    <div  class="col-md-1 text-center">
                        <span class="time "> {{ track.time }}</span>
                    </div>
                    <div class="col-md-1 text-center">
                        <span class="bpm">{{ track.bpm }}</span>
                    </div>
                    <div class="col-md-2 text-center">
                        <span class="actions ">
                            <span class="download-btn">
                                  <svg version="1.1" id="Capa_1" height="26" width="27" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                       viewBox="0 0 479.925 479.925" style="enable-background:new 0 0 479.925 479.925;" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <path d="M423.924,171.856c0-0.6,0-1.2,0-1.8c0.036-75.111-60.825-136.029-135.936-136.064
                                                C242.303,33.97,199.659,56.888,174.468,95c-50.35-16.807-104.792,10.385-121.599,60.735c-3.263,9.777-4.933,20.014-4.945,30.321
                                                c0,0.68,0,1.368,0,2.056c-34.211,8.887-54.74,43.825-45.853,78.035c7.32,28.179,32.738,47.867,61.853,47.909h143.472
                                                c4.418,0,8-3.582,8-8s-3.582-8-8-8H63.924c-26.509-0.158-47.871-21.775-47.714-48.284c0.141-23.766,17.653-43.85,41.178-47.228
                                                c4.232-0.569,7.271-4.362,6.904-8.616c-0.216-2.576-0.368-5.224-0.368-7.872c0.057-44.24,35.967-80.058,80.207-80.001
                                                c10.491,0.013,20.877,2.088,30.569,6.105c3.673,1.526,7.91,0.122,9.944-3.296c33.745-57.04,107.34-75.924,164.38-42.18
                                                c36.535,21.614,58.932,60.922,58.9,103.372c0,2.648-0.072,5.216-0.288,7.792c-0.371,4.304,2.742,8.125,7.032,8.632
                                                c30.694,3.798,52.497,31.759,48.699,62.453c-3.465,28.004-27.225,49.056-55.443,49.123c-2.406,0.003-4.811-0.138-7.2-0.424
                                                c-1.148-0.141-2.314,0.005-3.392,0.424H271.636c-4.418,0-8,3.582-8,8s3.582,8,8,8h128.288c0.611-0.002,1.219-0.085,1.808-0.248
                                                c2.024,0.168,4.096,0.248,6.192,0.248c39.765,0.001,72.001-32.234,72.001-71.999
                                                C479.926,208.456,456.685,179.322,423.924,171.856z"/>
                                            <path d="M302.148,364.4l-54.224,54.224V194.056c0-4.418-3.582-8-8-8s-8,3.582-8,8v224.568L177.7,364.4
                                                c-3.178-3.07-8.242-2.982-11.312,0.196c-2.994,3.1-2.994,8.015,0,11.116l67.88,67.88c3.124,3.123,8.188,3.123,11.312,0
                                                l67.88-67.88c3.07-3.178,2.982-8.242-0.196-11.312C310.164,361.405,305.248,361.405,302.148,364.4z"/>
                                        </g>
                                    </g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                </svg>
                            </span>

                            <span class="share-btn">
                                <svg height="24" viewBox="0 -28 453.99791 453" width="32" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m345.375 3.410156c-2.863281-2.847656-7.160156-3.695312-10.890625-2.144531s-6.164063 5.195313-6.164063 9.234375v53.359375c-54.011718 2.148437-81.058593 24.539063-85.191406 28.261719-27.25 22.363281-45.855468 53.527344-52.613281 88.121094-3.378906 16.714843-3.984375 33.871093-1.785156 50.78125l.007812.058593c.019531.148438.042969.300781.066407.449219l2.125 12.214844c.714843 4.113281 3.914062 7.351562 8.019531 8.117187 4.109375.765625 8.257812-1.105469 10.40625-4.6875l6.367187-10.613281c19.5625-32.527344 43.941406-54.089844 72.46875-64.085938 12.867188-4.550781 26.5-6.546874 40.128906-5.882812v55.265625c0 4.046875 2.441407 7.699219 6.183594 9.242187 3.746094 1.546876 8.050782.679688 10.90625-2.191406l105.675782-106.210937c3.894531-3.914063 3.878906-10.246094-.035157-14.140625zm2.949219 194.214844v-40.027344c0-4.90625-3.5625-9.089844-8.410157-9.871094-8.554687-1.378906-31.371093-3.570312-58.335937 5.878907-28.765625 10.078125-53.652344 29.910156-74.148437 59.050781-.058594-9.574219.847656-19.132812 2.707031-28.527344 6.078125-30.730468 21.515625-56.542968 45.878906-76.710937.214844-.175781.417969-.359375.617187-.554688.699219-.648437 26.097657-23.578125 81.609376-23.164062h.074218c5.523438 0 10.003906-4.480469 10.007813-10.003907v-39.136718l81.535156 81.125zm0 0"/><path d="m417.351562 294.953125c-5.519531 0-10 4.476563-10 10v42.261719c-.015624 16.5625-13.4375 29.980468-30 30h-327.351562c-16.5625-.019532-29.980469-13.4375-30-30v-238.242188c.019531-16.5625 13.4375-29.980468 30-30h69.160156c5.523438 0 10-4.476562 10-10 0-5.523437-4.476562-10-10-10h-69.160156c-27.601562.03125-49.96875 22.398438-50 50v238.242188c.03125 27.601562 22.398438 49.96875 50 50h327.351562c27.601563-.03125 49.96875-22.398438 50-50v-42.261719c0-5.523437-4.476562-10-10-10zm0 0"/>
                                </svg>
                            </span>
                        </span>
                    </div>
                    <div  class="col-md-2 text-center ">
                        <p class="free-price" v-if="track.isFree">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="22" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="black" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                           <span class="price-amount">{{ track.license }}</span>
                        </p>

                        <p class="price" v-if="!track.isFree">
                            <svg id="Layer_1" enable-background="new 0 0 480 480" height="24" viewBox="0 0 480 480" width="26" xmlns="http://www.w3.org/2000/svg">
                                <path fill="white" d="m372.052 480h-264.104c-23.46 0-41.906-20.152-39.845-43.516l24.353-276c1.835-20.799 18.964-36.484 39.845-36.484h24.699v-41c0-45.767 37.233-83 83-83s83 37.233 83 83v41h24.699c4.418 0 8 3.582 8 8s-3.582 8-8 8h-24.699v36c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-105c-4.418 0-8-3.582-8-8s3.582-8 8-8h105v-41c0-36.944-30.056-67-67-67s-67 30.056-67 67v93c0 4.418-3.582 8-8 8s-8-3.582-8-8v-36h-24.699c-12.528 0-22.806 9.411-23.907 21.891l-24.353 276c-1.241 14.062 9.807 26.109 23.907 26.109h264.104c14.117 0 25.147-12.064 23.907-26.109l-24.353-276c-.388-4.401 2.865-8.284 7.266-8.672 4.399-.385 8.284 2.865 8.672 7.266l24.353 276c2.062 23.369-16.39 43.515-39.845 43.515zm-178.052-69h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8zm0-40h-58c-4.418 0-8 3.582-8 8s3.582 8 8 8h58c4.418 0 8-3.582 8-8s-3.582-8-8-8z"/>
                            </svg>
                            <span class="price-amount">{{ track.license }}</span>
                        </p>
                    </div>
                </div>



            </div>

            <div id="more-beats" class="mt-md-4 mt-sm-2 mt-xs-2  d-flex justify-content-center container">
                <a href="#" class="btn btn-primary  ">BROWSE MORE BEATS</a>
            </div>
        </div>

        <div id="drumkits" class="my-5">
            <h2 class="text-center">DRUMKITS</h2>
            <div class="kits my-2 " :class="{ 'd-flex justify-content-between': (drumkits.length > 2) ,  'd-flex justify-content-center': (drumkits.length == 1)}">
                <a href="#" v-for="drumkit in drumkits" @click.prevent="viewDrumkit(drumkit)" :class="{ 'm-2': (drumkits.length == 2) }">
                    <figure class="col-xs-12" :style="{ backgroundImage: `url(${ drumkit.image } )` }">
                        <div :class="{ 'free': (drumkit.isFree) , 'date': (!drumkit.isFree)}"><span class="card-date-day">{{ drumkit.price }}</span></div>
                        <figcaption>
                            <h4> <span>{{ drumkit.title }}</span></h4>
                            <p>{{ drumkit.type}}</p>
                        </figcaption>
                    </figure>
                </a>


            </div>
            <div id="more-kits" class=" d-flex justify-content-center container">
                <a href="#" class="btn btn-primary  ">ALL SOUND KITS</a>
            </div>
        </div>
        <div id="blog" class="my-5">
            <h2 class="text-center">BLOG</h2>

            <section class="cards my-2">
                <article class="blog-card" v-for="blog in blogs" :key="blog.id" @click.prevent="viewBlog(blog)">
                    <div class="card__info-hover">
                        <svg class="card__like"  viewBox="0 0 24 24">
                            <path fill="#000000" d="M12.1,18.55L12,18.65L11.89,18.55C7.14,14.24 4,11.39 4,8.5C4,6.5 5.5,5 7.5,5C9.04,5 10.54,6 11.07,7.36H12.93C13.46,6 14.96,5 16.5,5C18.5,5 20,6.5 20,8.5C20,11.39 16.86,14.24 12.1,18.55M16.5,3C14.76,3 13.09,3.81 12,5.08C10.91,3.81 9.24,3 7.5,3C4.42,3 2,5.41 2,8.5C2,12.27 5.4,15.36 10.55,20.03L12,21.35L13.45,20.03C18.6,15.36 22,12.27 22,8.5C22,5.41 19.58,3 16.5,3Z" />
                        </svg>
                        <div class="card__clock-info">
                            <svg class="card__clock"  viewBox="0 0 24 24"><path d="M12,20A7,7 0 0,1 5,13A7,7 0 0,1 12,6A7,7 0 0,1 19,13A7,7 0 0,1 12,20M19.03,7.39L20.45,5.97C20,5.46 19.55,5 19.04,4.56L17.62,6C16.07,4.74 14.12,4 12,4A9,9 0 0,0 3,13A9,9 0 0,0 12,22C17,22 21,17.97 21,13C21,10.88 20.26,8.93 19.03,7.39M11,14H13V8H11M15,1H9V3H15V1Z" />
                            </svg>
                        </div>

                    </div>
                    <div class="card__img" :style="{ backgroundImage: `url(${ blog.image } )` }"></div>
                    <a href="#" class="card_link">
                        <div class="card__img--hover"  :style="{ backgroundImage: `url(${  blog.image } )` }" ></div>
                    </a>
                    <div class="card__info">
                        <span class="card__category">{{ (blog.type.length > 15 ) ? sanitizeText(15 , blog.type ) : blog.type }}</span>
                        <h3 class="card__title">{{ (blog.title.length > 45 ) ? sanitizeText(45 , blog.title ) : blog.title }}</h3>
                    </div>
                </article>
            </section>

            <a href="#" class="btn btn-primary mt-md-4 mt-sm-3 mt-xs-3 "> MORE STORIES</a>
        </div>
        <div id="gallery" class="my-5">
            <h2 class="text-center">GALLERY</h2>
            <div class="galleryHolder">
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="box">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x806">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x800">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x802">
                </div>
                <div class="imgBox">
                    <img loading="lazy" src="https://source.unsplash.com/1000x804">
                </div>
            </div>
        </div>

        <div id="bio" class="my-5 pt-2">
<!--            <h2 class="text-center mt-2">BIO</h2>-->
            <div class="bio-info" style="background-image: url('/storage/site-img/wood2.jpg'); ">
               <div class="bio-img">
                   <img loading="lazy" class="circle-img" src="https://source.unsplash.com/300x300">
               </div>
                <div class="bio-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores assumenda beatae eos explicabo hic minima modi provident quos sapiente sunt. Blanditiis delectus maiores maxime minus necessitatibus, nostrum obcaecati possimus rem soluta, sunt tempora tempore voluptates! Alias animi architecto consequatur doloremque eligendi exercitationem, explicabo minima nam nemo nesciunt nisi non, officia perspiciatis porro quam quod quos recusandae ut veniam, vitae! Architecto cumque odit quod? Assumenda aut eaque fugiat nulla quia, veniam.</p>
                </div>
            </div>
        </div>

        <div id="sign-up" class="my-5">
            <h4 class="text-center">SIGN UP FOR OUR NEWSLETTER</h4>
            <input class="c-checkbox" type="checkbox" id="checkbox">
            <div class="c-formContainer">
                <form class="c-form" action="">
                    <input class="c-form__input" placeholder="E-mail" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" required>
                    <label class="c-form__buttonLabel" for="checkbox">
                        <button class="c-form__button" type="button">Send</button>
                    </label>
                    <label class="c-form__toggle" for="checkbox" @click="expandSignUp" data-title="Notify me"></label>
                </form>
            </div>
        </div>

        <div id="contact" class=" col-sm-11 col-xs-11 container my-5 ">
            <h2 class="text-center">CONTACT</h2>
            <form class=" col-sm-11 col-xs-11 col-md-12">
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="input" class="form__field" placeholder="Name" name="name" id='name' required />
                        <label for="name" class="form__label">Name</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="email" class="form__field" placeholder="Email" name="email" id='email' required />
                        <label for="email" class="form__label">Email</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <input type="input" class="form__field" placeholder="subject" name="subject" id='subject' required />
                        <label for="subject" class="form__label">SUBJECT</label>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class=" col-sm-11 col-xs-11 form__group field col-md-12">
                        <textarea type="input" class="form__field" placeholder="message" name="message" id='message' required ></textarea>
                        <label for="message" class="form__label">MESSAGE</label>
                    </div>
                </div>
                <button class="pure-material-button-contained">SEND</button>
            </form>
        </div>


    </div>
</template>

<script>

    import Share from "./Share";
    export default {
        name : "Home",
        components: {Share},
        data(){
            return{
                beats: [],
                blogs: [],
                drumkits: [],

            }
        },

        methods:{

            sanitizeText(size,text){

                    return text.slice(0, size)+ '...';

            },
            getImageUrl(folder,imglink){
                return '/storage/'+folder+ '/'+imglink;
            },
            fetchData(){

                this.beats = this.$store.getters.getBeats;

                axios.get('/getBlogs')
                    .then(response =>{
                        this.blogs = response.data.data;

                    })
                    .catch(err =>{
                        console.log(err);
                    });

                axios.get('/frontDrumkits')
                    .then(response =>{
                        this.drumkits = response.data.data;

                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            viewBlog(blog){

                let title = blog.title.toLowerCase().replace(/ /g , "-");
                let id = blog.id;
                this.$router.push({ name : 'blogPost' , params : {  id , title }})
            },
            viewDrumkit(drumkit){

                let title = drumkit.title.toLowerCase().replace(/ /g , "-");
                let id = drumkit.id;
                this.$router.push({ name : 'drumkitView' , params : {  id , title }})
            },
            selectTrack(song){

                this.$store.commit('setSong',song);

                if(this.$store.getters.getPlayerState != true || this.$store.getters.getPlayerVisibility != true){
                    this.$store.commit('setPlayerVisibility', true);
                    this.$store.commit('setPlayerState', true);
                }

            }
            ,
            checkMeasures(){

            },
            expandSignUp(){
                const cForm = document.querySelector(".c-form")
                const frmContainer = document.querySelector(".c-formContainer")
                const cFrmToggle = document.querySelector(".c-form__toggle")

                if(window.innerWidth < 524)
                {
                    cForm.style.width = '16em';
                    frmContainer.style.width = '16em';
                    cFrmToggle.style.width = '16em';

                }else  if(window.innerWidth < 624)
                {
                    cForm.style.width = '32em';
                    frmContainer.style.width = '32em';
                    cFrmToggle.style.width = '32em';
                }
            }
        },
        mounted() {
            this.fetchData();
        },

    }
</script>

<style scoped>
    #beats h2, #drumkits h2, #blog h2, #gallery h2 {
        font-family: "Poppins", 'Helvetica', sans-serif;
        font-weight: 500 !important;
    }


/*<!--    bio-->*/
#bio{
    display: none;
   /*flex-direction: column;*/
   /* align-items: center;*/
}
.bio-info{
    display: flex;
    justify-content: space-between;
    width: 80%;

    padding: 2%;
    border-radius: 35%;
}
.circle-img{
    border-radius: 1000px;
    border: rgba(189, 195, 199, .2) 10px solid;
    box-shadow: 0 10px 30px 0px #11111144;
}
.bio-img{
   max-width: 35%;
}

.bio-text{
    display: flex;
    align-items: center;
    max-width: 65%;
    text-align: justify;
    text-justify: inter-word;
}


.bio-text p  {
    font-size: 17px;
    font-weight: 700;
    color: #111111;
    /*mix-blend-mode: darken;*/
    text-shadow: 1px 1px ghostwhite;
}


/*end bio*/





    /*BLOG CARDS*/

    .cards {
        width: 100%;
        display: flex;
        display: -webkit-flex;
        justify-content: center;
        -webkit-justify-content: center;
        max-width: 1200px;
        flex-wrap: wrap;
        -webkit-flex-wrap: wrap;
    }

    /*.card--1 .card__img, .card--1 .card__img--hover {*/
    /*    background-image: url('https://images.pexels.com/photos/45202/brownie-dessert-cake-sweet-45202.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260');*/
    /*}*/

    /*.card--2 .card__img, .card--2 .card__img--hover {*/
    /*    background-image: url('https://images.pexels.com/photos/307008/pexels-photo-307008.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260');*/
    /*}*/

    .card__like {
        width: 18px;
    }

    .card__clock {
        width: 15px;
        vertical-align: middle;
        fill: #AD7D52;
    }
    .card__time {
        font-size: 12px;
        color: #AD7D52;
        vertical-align: middle;
        margin-left: 5px;
    }

    .card__clock-info {
        float: right;
    }

    .card__img {
        visibility: hidden;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 125px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;

    }

    .card__info-hover {
        position: absolute;
        padding: 16px;
        width: 100%;
        opacity: 0;
        top: 0;
    }

    .card__img--hover {
        transition: 0.2s all ease-out;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        position: absolute;
        height: 100%;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        top: 0;

    }
    .blog-card {
        transition: all .4s cubic-bezier(0.175, 0.885, 0, 1);
        background-color: #fff;
        width: 20%;
        position: relative;
        margin: 8px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0px 13px 10px -7px rgba(0, 0, 0,0.1);
        height: 300px;
    }
    .blog-card:hover {
        box-shadow: 0px 30px 18px -8px rgba(0, 0, 0,0.1);
        transform: scale(1.05, 1.05);
    }

    /*.card__info {*/
    /*    z-index: 100;*/
    /*    position: absolute;*/
    /*    background-color: #fff;*/
    /*    border-bottom-left-radius: 12px;*/
    /*    border-bottom-right-radius: 12px;*/
    /*    padding: 16px 24px 24px 24px;*/
    /*}*/

    .card__info{
        z-index: 100 ;
        position: absolute;
        bottom: 0px;
        background-color: #ffffffdd;
        width: 100%;
        padding: 10px 16px;
        font-size: 1rem;
    }

    .card__category {
        font-family: 'Raleway', sans-serif;
        text-transform: uppercase;
        font-size: 13px;
        letter-spacing: 2px;
        font-weight: 500;
        color: #868686;
    }

    .card__title {
        /*margin-top: 10px;*/
        /*margin-bottom: 2px;*/
        font-family: 'Roboto Slab', serif;
        font-size: 1rem;
    }

    /*.card__by {*/
    /*    font-size: 12px;*/
    /*    font-family: 'Raleway', sans-serif;*/
    /*    font-weight: 500;*/
    /*}*/

    /*.card__author {*/
    /*    font-weight: 600;*/
    /*    text-decoration: none;*/
    /*    color: #AD7D52;*/
    /*}*/

    .blog-card :hover .card__img--hover {
        height: 100%;
        opacity: 0.9;
    }

    .blog-card :hover .card__info {
        background-color: transparent;
        position: relative;
    }

    .blog-card :hover .card__info-hover {
        opacity: 1;
    }


    /*END BLOG CARDS*/

 /*DRUMKIT*/
.kits{
    display: flex;
    justify-content: center;
    width: 76%;
}
 figure {
     position: relative;
     display: flex;
     align-items: flex-start;
     justify-content: center;
     width: 220px;
     height: 300px;
     padding: 20px 20px;
     background-position: center center;
     background-repeat: no-repeat;
     background-size: 100%;
     border-radius: 10px;
     box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     overflow: hidden;
 }
 figure:before, figure:after {
     position: absolute;
     top: 0;
     left: 0;
     width: 100%;
     height: 100%;
 }
 figure:before {
     content: '';
     background-color: rgba(0, 0, 0, 0.1);
     z-index: 0;
 }
 figure:after {
     content: '';
     display: flex;
     align-items: center;
     justify-content: center;
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     overflow: hidden;
 }
 figure:hover {
     background-size: 175%;
 }
 figure:hover:after {
     content: '♣︎';
     background-color: rgba(255, 69, 0, 0.8);
     color: white;
     font-size: 72px;
     z-index: 2;
 }
 figure:hover .date {
     bottom: -59px;
 }
 figure:hover figcaption {
     transform: translateY(-110%);
 }
 figure .date {
     position: absolute;
     bottom: 0;
     right: 30px;
     display: flex;
     align-items: center;
     justify-content: center;
     flex-direction: column;
     padding: 10px;
     background-color: rgba(255, 69, 0, 0.85);
     text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
 }

    figure .free{
        position: absolute;
        bottom: 0;
        right: 30px;
        display: flex;
        align-items: center;
        /*justify-content: center;*/
        flex-direction: column;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.85);
        text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
        transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

 figure .date span {
     color: white;
     line-height: 1;
 }
 figure .date span:first-child {
     font-family: "Source Code Pro", sans-serif;
     font-size: 20px;
     font-weight: 900;
 }
 figure .date span:last-child {
     font-size: 14px;
     font-weight: 400;
 }
 figure figcaption {
     color: white;
     transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
     z-index: 1;
 }
 figure figcaption h4 {
     margin: 0 0 5px;
     font-family: "Source Code Pro", sans-serif;
     font-size: 24px;
     line-height: 1.35;
     text-shadow: 1px 1px rgba(0, 0, 0, 0.7);
 }
 figure figcaption h4 > span {
     background-color: transparent;
     /*background-color: rgba(255, 69, 0, 0.8);*/
 }
 figure figcaption p {
     margin: 0;
     line-height: 1.5;
 }

 /*END DRUMKIT*/
    #contact form{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
   .download-btn{
       margin: 0 10px;
   }
   .share-btn{
       margin: 0 10px;
   }
    svg:hover{
        transform: scale(1.08);
        transition: 2ms ease-in;
    }

    .price{
        background-color: orangered;
        height: 40px;
        width: 100px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 300;
    }

    .m-title{

        font-size: .8rem;

    }
    .title-container{
        cursor: pointer;
    }
    .m-title-container{
        padding: 0 5px;
    }
    .m-price{
        background-color: orangered;
        height: 40px;
        width: 70px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-weight: 300;
        font-size: 14px !important;
    }

    .free-price{
        background-color: #F4F3F155;
        height: 40px;
        width: 100px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black;
        font-weight: 500;
    }

    .m-free-price{
        background-color: #F4F3F155;
        height: 20px;
        width: 50px;
        border-radius: 10px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        color: black;
        font-weight: 500;
    }

    .mobile-track{
        margin-top: 5px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid rgba(0,0,0,.1);
        height: 60px;
        width: 99%;
    }
    .price-amount{
        font-size: 19px;
    }
    #labels{
        margin-bottom: 12px;
    }
    .track{

        margin-top: 5px;
        display: flex;
        align-items: center;
        border-bottom: 2px solid rgba(0,0,0,.1);
        height: 60px;
    }
    .cover{
        height: 50px;
        width: 50px;
        cursor: pointer;
    }

    .m-cover{
        height: 50px;
        width: 50px;
    }
    #home{

    }

    #hero > .info {
        text-align: center;
        color: white;
        padding-top: 300px;
    }
    #hero {
        background: url("/storage/site-img/mixer.jpg");
        object-fit: contain;
        background-size: cover;
        background-position: center center;
        height: 550px;
        box-sizing: border-box;
    }

    #beats {

    }
    #drumkits{
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        align-items: center;

    }
    #blog {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #bio {

    }

    #gallery {

    }

    .imgBox{
        display: none;
    }

    #sign-up {
        height: 170px;
        background-color: #152238;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #sign-up div {
        display: flex;
        justify-content: space-between;
    }
    #contact {
        margin-top: 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }


/*    GALLERY*/
    .galleryHolder {
        display: -webkit-box;
        display: flex;
        width: 100%;
        padding: 2% 1%;
        box-sizing: border-box;
        height: 60vh;
    }

    .box {
        -webkit-box-flex: 1;
        flex: 1;
        overflow: hidden;
        -webkit-transition: .5s;
        transition: .5s;
        margin: 0 2%;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.1);
        line-height: 0;
    }

    .box > img {
        width: 200%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -webkit-transition: .5s;
        transition: .5s;
    }

    .box:hover {
        -webkit-box-flex: 1;
        flex: 1 1 35%;
    }

    .box:hover > img {
        width: 100%;
        height: 100%;
    }

    /*    END GALLERY*/

/*    MATERIAL SEND BUTTON*/

    .pure-material-button-contained {
        position: relative;
        display: inline-block;
        box-sizing: border-box;
        border: none;
        border-radius: 4px;
        padding: 0 16px;
        min-width: 64px;
        height: 36px;
        vertical-align: middle;
        text-align: center;
        text-overflow: ellipsis;
        text-transform: uppercase;
        color: rgb(255, 255, 255);
        background-color: orangered;
        box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
        0 1px 5px 0 rgba(0, 0, 0, 0.12);
        font-size: 14px;
        font-weight: 500;
        line-height: 36px;
        overflow: hidden;
        outline: none;
        cursor: pointer;
        transition: box-shadow 0.2s;
    }

    .pure-material-button-contained::-moz-focus-inner {
        border: none;
    }

    /* Overlay */
    .pure-material-button-contained::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgb( 255, 255, 255);
        opacity: 0;
        transition: opacity 0.2s;
    }

    /* Ripple */
    .pure-material-button-contained::after {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        border-radius: 50%;
        padding: 50%;
        width: 32px; /* Safari */
        height: 32px; /* Safari */
        background-color: rgb(255, 255, 255);
        opacity: 0;
        transform: translate(-50%, -50%) scale(1);
        transition: opacity 1s, transform 0.5s;
    }

    /* Hover, Focus */
    .pure-material-button-contained:hover,
    .pure-material-button-contained:focus {
        box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.2), 0 4px 5px 0 rgba(0, 0, 0, 0.14),
        0 1px 10px 0 rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:hover::before {
        opacity: 0.08;
    }

    .pure-material-button-contained:focus::before {
        opacity: 0.24;
    }

    .pure-material-button-contained:hover:focus::before {
        opacity: 0.3;
    }

    /* Active */
    .pure-material-button-contained:active {
        box-shadow: 0 5px 5px -3px rgba(0, 0, 0, 0.2),
        0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12);
    }

    .pure-material-button-contained:active::after {
        opacity: 0.32;
        transform: translate(-50%, -50%) scale(0);
        transition: transform 0s;
    }

    /* Disabled */
    .pure-material-button-contained:disabled {
        color: rgba( 0, 0, 0, 0.38);
        background-color: rgba(0, 0, 0, 0.12);
        box-shadow: none;
        cursor: initial;
    }

    .pure-material-button-contained:disabled::before {
        opacity: 0;
    }

    .pure-material-button-contained:disabled::after {
        opacity: 0;
    }

    /*    END MATERIAL SEND BUTTON*/



/*MATERIAL like FORM*/

   .form__group {
       position: relative;
       padding: 15px 0 0;
       margin-top: 10px;
       width: 50%;
   }

   .form__field {
       font-family: inherit;
       width: 600px;
       border: 0;
       border-bottom: 2px solid #9b9b9b;
       outline: 0;
       font-size: 1.3rem;
       color: #152238;
       padding: 7px 0;
       background: transparent;
       transition: border-color 0.2s;
   }
   .form__field::placeholder {
       color: transparent;
   }
   .form__field:placeholder-shown ~ .form__label {
       font-size: 1.3rem;
       cursor: text;
       top: 20px;
   }

   .form__label {
       position: absolute;
       top: 0;
       display: block;
       transition: 0.2s;
       font-size: 1rem;
       color: #9b9b9b;
   }

   .form__field:focus {
       padding-bottom: 6px;
       font-weight: 700;
       border-width: 3px;
       border-image: linear-gradient(to right, #152238,#5d8ee3);
       border-image-slice: 1;
   }
   .form__field:focus ~ .form__label {
       position: absolute;
       top: 0;
       display: block;
       transition: 0.2s;
       font-size: 1rem;
       color: #4569a8;
       font-weight: 700;
   }

   /* reset input */
   .form__field:required, .form__field:invalid {
       box-shadow: none;
   }



   /*   end material form*/


/*    notify newsletter */

   .c-checkbox {
       display: none;
   }
   .c-checkbox:checked + .c-formContainer .c-form {
       width: 37.5em;
   }
   .c-checkbox:checked + .c-formContainer .c-form__toggle {
       visibility: hidden;
       opacity: 0;
       transform: scale(0.7);
   }
   .c-checkbox:checked + .c-formContainer .c-form__input,
   .c-checkbox:checked + .c-formContainer .c-form__buttonLabel {
       transition: 0.2s 0.1s;
       visibility: visible;
       opacity: 1;
       transform: scale(1);
   }
   .c-checkbox:not(:checked) + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle::before, .c-checkbox:checked + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle::before {
       content: 'Thank You! \1F60A';
   }
   .c-checkbox:not(:checked) + .c-formContainer .c-form__input:required:valid ~ .c-form__toggle {
       pointer-events: none;
       cursor: default;
   }

   .c-formContainer,
   .c-form,
   .c-form__toggle {
       width: 20em;
       height: 4.25em;
   }

   .c-formContainer {
       position: relative;
       font-weight: 700;
   }

   .c-form,
   .c-form__toggle {
       position: absolute;
       border-radius: 6.25em;
       background-color: #ffffff;
       transition: 0.2s;
   }

   .c-form {
       left: 50%;
       transform: translateX(-50%);
       padding: 0.625em;
       box-sizing: border-box;
       box-shadow: 0 0.125em 0.3125em rgba(0, 0, 0, 0.3);
       display: flex;
       justify-content: center;
   }

   .c-form__toggle {
       color: orangered;
       top: 0;
       cursor: pointer;
       z-index: 1;
       display: flex;
       align-items: center;
       justify-content: center;
   }
   .c-form__toggle::before {
       font-size: 1.75em;
       content: attr(data-title);
   }

   .c-form__input,
   .c-form__button {
       font: inherit;
       border: 0;
       outline: 0;
       border-radius: 5em;
       box-sizing: border-box;
   }

   .c-form__input,
   .c-form__buttonLabel {
       font-size: 1.75em;
       opacity: 0;
       visibility: hidden;
       transform: scale(0.7);
       transition: 0s;
   }

   .c-form__input {
       color: #ff7b73;
       height: 100%;
       width: 100%;
       padding: 0 0.714em;
   }
   .c-form__input::placeholder {
       color: currentColor;
   }
   .c-form__input:required:valid {
       color: #ff7b73;
   }
   .c-form__input:required:valid + .c-form__buttonLabel {
       color: #ffffff;
   }
   .c-form__input:required:valid + .c-form__buttonLabel::before {
       pointer-events: initial;
   }

   .c-form__buttonLabel {
       color: #ffaea9;
       height: 100%;
       width: auto;
   }
   .c-form__buttonLabel::before {
       content: '';
       position: absolute;
       width: 100%;
       height: 100%;
       pointer-events: none;
       cursor: pointer;
   }

   .c-form__button {
       color: white;
       padding: 0;
       height: 100%;
       width: 5em;
       background-color: orangered;
   }

   /*    newsletter end*/
</style>
