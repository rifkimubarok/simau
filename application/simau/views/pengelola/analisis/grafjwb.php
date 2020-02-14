<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Grafik Analisis Butir Soal</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="jenjang" onchange="reload()">
                                        <option value="SD" selected> SD</option>
                                        <option value="SMP"> SMP</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="kelas"></select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="kecamatan" onchange="reload()">
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="sekolah">
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="matapelajaran">
                                        
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="thn_upload" >
                                        <?php 
                                            $tahun = date('Y');
                                            for ($i=$tahun-5; $i <=$tahun+5 ; $i++) { 
                                                if($i == $tahun){
                                                    echo '<option value="'.$i.'" selected> '.$i.'</option>';
                                                }else{
                                                    echo '<option value="'.$i.'"> '.$i.'</option>';
                                                }
                                            }
                                         ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <button class="btn btn-outline btn-primary" onclick="getAnalisis()">Show</button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row" id="konten_graf"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /.row -->

    </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/script/application/pengelola/grafik/analisis.js"></script>