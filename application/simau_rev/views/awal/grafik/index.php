
<!-- Tampil Grafik -->
<div class="col col-sm-8 col-md-10 col-centered">
  <div class="panel">
    <div class="panel-body">
      <h5 class="post-title"> <span>GRAFIK SEKOLAH BINAAN DISDIKPORA KAB. GUNUNG KIDUL</span> </h5>  
      <!-- <form style="display: inline-block;" method="post" class="form-inline" action="<?php echo base_url().'awal/grafik_sekolah/param' ?>">

        <div class="form-group">
          <select class="form-control" id="kabupaten" name="cbbkab">
          </select>
        </div>
        <div class="form-group">
          <select class="form-control" id="jenjang" name="cbbjenjang">
          </select>
        </div>
        <div class="form-group">
            <button class="btn btn-outline btn-primary" type="submit">Show</button>
        </div>
      </form>
      <form class="form-inline" action="<?php echo base_url().'awal/grafik_sekolah/delete_session' ?>" style="float: right; display: inline;">
      <button class="btn btn-outline btn-primary">Tampilkan Semua Data</button></form>
      <br><br>  -->  

        <div class="form-group col-md-3">
            <div class="form-group">
              <select class="form-control" id="kecamatan" onchange="tampil_grafik()">
              </select>
            </div>
        </div>                
        <div class="row">
           <div class="col-lg-12 col-md-6">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <div class="col-lg-12">
                        <!-- <div id="grafik_banyaksiswa" class="demo-placeholder"></div> -->     
                          <div class="box">
                            <div class="box-header">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                              <div class="row">
                                <div class="col-md-6">

                                    <div class="chart">
                                      <!-- Sales Chart Canvas -->
                                      <div id="container" style="height: 300px;"></div>
                                    </div>
                                  <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">

                                  <div class="chart">
                                    <div id="pie_chart" style="height: 300px;"></div>
                                  </div>
                                </div>
                                <!-- /.col -->
                              </div>
                              <!-- /.row -->
                            </div>
                          </div>         
                              <time><i class="fa fa-calendar"></i>Terakhir dilihat : 
                              <?php 
                              echo date('l, d-m-Y');
                              echo (' ');
                              echo date('H:i:s');
                              ?></time>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <div class="row">
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-vcard-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div>Total Guru</div>
                                    <div class="huge" id="totpeg">1000</div>
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
                                    <div class="huge" id="totmula">1000</div>
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
                                    <div class="huge" id="totmupe">1000</div>
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
                                    <div class="huge" id="totmu">1000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/script/application/awal/grafik/grafsekolah.js"></script>
<!-- End Grafik -->