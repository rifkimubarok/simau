<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-university fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>SD</div>
                                    <div class="huge"><?php echo $SD ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-university fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>SLB</div>
                                    <div class="huge"><?php echo $SLB ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-id-badge fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Guru</div>
                                    <div class="huge"><?php echo $Total_Guru; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Murid Laki-Laki</div>
                                    <div class="huge"><?php echo $JmlLaki; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-female fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Murid Perempuan</div>
                                    <div class="huge"><?php echo $JmlPerempuan; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-link fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>SIM</div>
                                    <div class="huge"><a target="_blank" style="color: white;" href="https://paspor.simpkb.id/casgpo/login?service=https%3A%2F%2Fapp.simpkb.id%2Fauth%2Flogin">PKB</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                 <div class="col-lg-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-lg-12">
                                <div id="grafik_banyaksiswa_pengelola" class="demo-placeholder"></div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/aplication/grafik/grafikHome.js"></script>
</div>    