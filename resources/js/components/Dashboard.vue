<template>
    <div class="dashboard">
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="ti-wallet"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">$<span class="count">235</span></div>
                                            <div class="stat-heading">Revenue</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="ti-shopping-cart-full"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">84</span></div>
                                            <div class="stat-heading">Orders</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="ti-headphone"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ stats.beats }}</span></div>
                                            <div class="stat-heading">Beats</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-4">
                                        <i class="fas fa-drum"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ stats.kits }}</span></div>
                                            <div class="stat-heading">Drumkits</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->

                <div class="clearfix"></div>
                <!-- PURCHASES -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Orders </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                        <table class="table ">
                                            <thead>
                                            <tr>
                                                <th class="serial">#</th>
                                                <th class="avatar">Avatar</th>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="serial">1.</td>
                                                <td class="avatar">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="images/avatar/1.jpg" alt=""></a>
                                                    </div>
                                                </td>
                                                <td> #5469 </td>
                                                <td>  <span class="name">Louis Stanley</span> </td>
                                                <td> <span class="product">iMax</span> </td>
                                                <td><span class="count">231</span></td>
                                                <td>
                                                    <span class="badge badge-complete">Complete</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="serial">2.</td>
                                                <td class="avatar">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="images/avatar/2.jpg" alt=""></a>
                                                    </div>
                                                </td>
                                                <td> #5468 </td>
                                                <td>  <span class="name">Gregory Dixon</span> </td>
                                                <td> <span class="product">iPad</span> </td>
                                                <td><span class="count">250</span></td>
                                                <td>
                                                    <span class="badge badge-complete">Complete</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="serial">3.</td>
                                                <td class="avatar">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="images/avatar/3.jpg" alt=""></a>
                                                    </div>
                                                </td>
                                                <td> #5467 </td>
                                                <td>  <span class="name">Catherine Dixon</span> </td>
                                                <td> <span class="product">SSD</span> </td>
                                                <td><span class="count">250</span></td>
                                                <td>
                                                    <span class="badge badge-complete">Complete</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="serial">4.</td>
                                                <td class="avatar">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="images/avatar/4.jpg" alt=""></a>
                                                    </div>
                                                </td>
                                                <td> #5466 </td>
                                                <td>  <span class="name">Mary Silva</span> </td>
                                                <td> <span class="product">Magic Mouse</span> </td>
                                                <td><span class="count">250</span></td>
                                                <td>
                                                    <span class="badge badge-pending">Pending</span>
                                                </td>
                                            </tr>
                                            <tr class=" pb-0">
                                                <td class="serial">5.</td>
                                                <td class="avatar pb-0">
                                                    <div class="round-img">
                                                        <a href="#"><img class="rounded-circle" src="images/avatar/6.jpg" alt=""></a>
                                                    </div>
                                                </td>
                                                <td> #5465 </td>
                                                <td>  <span class="name">Johnny Stephens</span> </td>
                                                <td> <span class="product">Monitor</span> </td>
                                                <td><span class="count">250</span></td>
                                                <td>
                                                    <span class="badge badge-complete">Complete</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- /.table-stats -->
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->
                    </div>
                </div>

            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: "Dashboard",
        data(){
            return{
                stats:{}
            }
        },
        methods:{
            getStats(){
                axios.get('/adminstats')
                    .then(response =>{
                        this.stats = response.data;
                    })
                    .catch(err =>{
                        console.log(err);
                    });
            },
            getOrders(){

            }
        },
        mounted() {
            this.getOrders();
            this.getStats();
            console.log('Component mounted.')
        }
    }
</script>
