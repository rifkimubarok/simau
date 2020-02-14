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
                                    <i class="fa fa-vcard-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Pegawai</div>
                                    <div class="huge"><?php echo number_format($jmlmurid->totalpegawai,0); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Murid Laki-Laki</div>
                                    <div class="huge"><?php echo number_format($jmlmurid->siswaL,0); ?></div>
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
                                    <i class="fa fa-female fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Murid Perempuan</div>
                                    <div class="huge"><?php echo number_format($jmlmurid->siswaP,0); ?></div>
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
                                    <i class="fa fa-child fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Murid</div>
                                    <div class="huge"><?php echo number_format($jmlmurid->jmlsiswa,0); ?></div>
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
                                <div id="grafik_banyaksiswa_sekolah" class="demo-placeholder"></div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/script/aplication/grafik/grafikHome.js"></script>
    </div>


    