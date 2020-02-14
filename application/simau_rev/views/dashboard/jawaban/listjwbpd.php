<div id="page-wrapper">
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">List Jawaban Terupload</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p align="right"><button class="btn btn-outline btn-primary" onclick="importData()"><i class="fa fa-file-excel-o"></i>  Upload Jawaban </button></p>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="row" style="box-sizing: border-box; border: 1px solid #ccc;">
                                <m style ="line-height: 30px; padding-left: 17px;">Filter Berdasarkan : </m><br>
                                <div class="form-group col-md-3">
                                    <select class="form-control" id="thn_upload" onchange="refreshData()">
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
                            <br>
                        <div class="">
                            <table class="table table-striped table-bordered table-hover" id="tblkeahlian" width="100%">
                                <thead style="white-space: nowrap;">
                                    <tr>
                                        <th width="4%">No</th>
                                        <th width="20%">Mata Pelajaran</th>
                                        <th width="5%">Kelas</th>
                                        <th width="20%">Sekolah</th>
                                        <th width="5%">Jml. Peserta</th>
                                        <th  width="4%">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="white-space: nowrap;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/application/jawaban.js"></script>
<div class="modal fade in" id="modaluploadfile" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Jawaban Peserta Didik <i class="fa fa-file-excel-o"></i></h4>
    </div>
    <div class="modal-body">
        <div class="row" id="isiModalImport">
        </div>
        </div>
    </div>
    </div>
</div>
    