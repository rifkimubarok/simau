<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Grafik Rata-rata Nilai</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group col-md-3" onchange="reloadSekolah()">
                                    <select class="form-control" id="matapelajaran">
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <select class="form-control" id="thn_upload" onchange="reloadSekolah()">
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
                            </div>
                            <div class="col-md-12">
                                <div id="konten_graf"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /.row -->

    </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/script/application/uptd/grafik/analisisnilaiv.js"></script>