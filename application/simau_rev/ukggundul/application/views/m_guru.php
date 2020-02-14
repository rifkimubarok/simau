
  <div class="panel panel-info">
    <div class="panel-heading">Data Guru
      <div class="tombol-kanan">
        <a class="btn btn-success btn-sm tombol-kanan" href="#" onclick="return m_guru_e(0);"><i class="glyphicon glyphicon-plus"></i> &nbsp;&nbsp;Tambah</a>       
        <a class="btn btn-warning btn-sm tombol-kanan" href="<?php echo base_url(); ?>upload/format_import_guru.xlsx" ><i class="glyphicon glyphicon-download"></i> &nbsp;&nbsp;Download Format Import</a>
        <a class="btn btn-info btn-sm tombol-kanan" href="<?php echo base_url(); ?>adm/m_guru/import" ><i class="glyphicon glyphicon-upload"></i> &nbsp;&nbsp;Import</a>
      </div>
    </div>
    <div class="panel-body">
      <table class="table table-bordered" id="datatabel">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th width="40%">Nama</th>
            <th width="18%">NIP/Username</th>
            <th width="39%">Aksi</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    
      </div>
    </div>
                    
<div class="modal fade" id="m_guru" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 id="myModalLabel">Data Guru</h4>
      </div>
      <div class="modal-body">
          <form name="f_guru" id="f_guru" onsubmit="return m_guru_s();">
            <input type="hidden" name="id" id="id" value="0">
              <table class="table table-form">
                <tr><td style="width: 25%">NIP</td><td style="width: 75%"><input type="text" class="form-control" name="nip" id="nip" required></td></tr>
                <tr><td style="width: 25%">Nama</td><td style="width: 75%"><input type="text" class="form-control" name="nama" id="nama" required></td></tr>
              </table>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="fa fa-minus-circle"></i> Tutup</button>
      </div>
        </form>
    </div>
  </div>
</div>


<div id="tampilkan_modal"><div class="modal fade" id="m_siswa_matkul" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 id="myModalLabel">Setting Mata Kuliah</h4></div><div class="modal-body"><form name="f_siswa_matkul" id="f_siswa_matkul" method="post" onsubmit="return m_guru_matkul_s();"><input type="hidden" name="id_mhs" id="id_mhs" value="2"><div id="konfirmasi"></div><label><input type="checkbox" value="1" name="id_mapel_1" checked=""> &nbsp;Bahasa Indonesia</label> &nbsp;&nbsp; <label><input type="checkbox" value="2" name="id_mapel_2" checked=""> &nbsp;Bahasa Inggris</label> &nbsp;&nbsp; <label><input type="checkbox" value="3" name="id_mapel_3"> &nbsp;Matematika</label> &nbsp;&nbsp; <label><input type="checkbox" value="4" name="id_mapel_4"> &nbsp;IPA</label> &nbsp;&nbsp; <div class="modal-footer"><button class="btn btn-primary" type="submit">Simpan</button><button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button></div></form></div></div></div></div></div>
