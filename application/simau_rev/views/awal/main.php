<!-- 
<div class="col col-sm-8 col-md-10 col-centered">
    <div class="panel">
        <div class="panel-body">    
            <div class="panel panel-default">   
                <div class="panel-heading">
                    <h5 class="panel-title">PETA SEKOLAH BINAAN DINAS PENDIDIKAN GUNUNG KIDUL</h5>
                </div>  
            </div>          
                <div class="col-md-12">
                    <div id="map_canvas" style="height:500px">
                </div>
                <br>
            </div>
        </div>
    </div>
</div>


<script src="http://maps.google.com/maps/api/js?key=AIzaSyAiWlZhewddMv8EhGF9-5rv6VxWhwVPItQ"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/markerclusterer.js"></script> -->

 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
   integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
   crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
   integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
   crossorigin=""></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/script/application/awal/maps/custom.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/script/application/awal/maps/leaflet.css"/>
<script type="text/javascript" src="<?php echo base_url()?>assets/script/application/awal/maps/zoomslider.js"></script>

<style>
    body {
        padding: 0;
        margin: 0;
    }
    html, body, #map {
        height: 100%;
    }
    .select2-dropdown {
        z-index: 9001;
    }
    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255,255,255,0.8);
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
        border-radius: 5px;
    }
    .legend {
        text-align: left;
        line-height: 18px;
        color: #555;
    }
    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>

<?php //echo $map['js']; ?>
<div class="col col-sm-8 col-md-12 col-centered">
    <div class="panel">
        <div class="panel-body">    
            <div class="panel panel-default">   
                <div class="panel-heading">
                    <h5 class="panel-title">PETA SEKOLAH BINAAN DISDIKPORA KAB. GUNUNG KIDUL</h5>
                </div>  
            </div>          
            <div class="col-md-12">
                <form class="form-inline">
                <div class='form-group'>
                    <select class='form-control' id='kecamatan' onchange="reload()">
                        <option value=''>Semua Kecamatan</option>
                        <?php 
                            foreach ($kecamatan as $a) {
                                echo "<option value='$a->kecamatan'>$a->kecamatan</option>";
                            }
                        ?>
                    </select>
                </div>
        
                <div class='form-group'>
                    <select class='form-control' id='jenjang' onchange="reload()">
                        <option value=''>Semua Jenjang</option>
                        <?php 
                            foreach ($jenjang as $a) {
                                echo "<option value='$a->jenjang'>$a->jenjang</option>";
                            }
                        ?>
                    </select>
                </div>
            </form>
                            
            <br>
                <div id="aa">
                    <div id="map" style="height: 450px"></div>
                </div>                                               
                <br>
                <!-- <div>
                    <img src="<?php echo base_url();?>assets/images/university2.png" width="24" height="24"> Nilai Sekolah <b> Diatas KCM </b>
                    <img src="<?php echo base_url();?>assets/images/university3.png" width="24" height="24"> Nilai Sekolah <b> Rata-rata KCM </b>
                    <img src="<?php echo base_url();?>assets/images/university4.png" width="24" height="24"> Nilai Sekolah <b> Dibawah KCM </b>
                </div> -->
            </div>
        </div>
    </div>
</div>