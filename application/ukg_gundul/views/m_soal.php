<?php 
$uri4 = $this->uri->segment(4);
?>

<div class="panel panel-info" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
    <div class="panel-heading"><b>Data Soal</b>
      <div class="tombol-kanan">
        <a class="btn btn-success btn-xs" href="<?php echo base_url(); ?>adm/m_soal/edit/0"><i class="fa fa-plus"></i> &nbsp;&nbsp;Tambah Data</a>        
        <a class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>upload/format_soal_download.xlsx" ><i class="fa fa-download"></i> &nbsp;&nbsp;Download Format Import</a>
        <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>adm/m_soal/import" ><i class="fa fa-upload"></i> &nbsp;&nbsp;Import</a>
        <a href='<?php echo base_url(); ?>adm/m_soal/cetak/<?php echo $uri4; ?>' class='btn btn-info btn-xs' target='_blank'><i class='fa fa-print'></i> Cetak</a>
      </div>
    </div>
    <div class="panel-body">
        
        <?php echo $this->session->flashdata('k'); ?>
      <div class="col-md-12">
        <div class="row" style="box-sizing: border-box; border: 1px solid #ccc;">
            <m style ="line-height: 30px; padding-left: 17px;">Filter Berdasarkan : </m><br>
            <div class="form-group col-md-3">
                <select class="form-control" id="id_mapel" onchange="getModul();refreshData_filter();">
                </select>
            </div>
            <div class="form-group col-md-3">
                <select class="form-control" id="modulpelajaran" onchange=";refreshData_filter();">
                </select>
            </div>
        </div>
        <br>
      </div>

    <table class="table table-striped table-bordered" id="datatabel">
      <thead>
        <tr>
          <td width="5%">No</td>
          <td width="45%">Soal</td>
          <td width="15%">Mapel/Guru</td>
          <td width="15%">Analisa</td>
          <td width="15%">Aksi</td>
        </tr>
      </thead>

      <tbody>

      </tbody>
    </table>
  </div>
</div>
