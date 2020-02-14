$(document).ready(function(){
    getSekolah();
  });

function getSekolah(){
    table = $('#calon_list').DataTable({ 

        "processing": true,
        "serverSide": true,

        "ajax": {
            "url": getbasepath()+"awal/daftar_sekolah/listSekolah",
            "type": "POST"
        },

        "columnDefs": [
            { 
                "targets": [ 0 ],
                "orderable": false,
            },
            { 
                "targets": [ -1 ],
                "orderable": false,
            },

        ],

    });

      $(document).ready(function(){
            $('#kec').on('change', function () { 
          if (!!this.value) { 
            table.column(4).search(this.value).draw(); 
            console.log(this.value);
          } else { 
            table.column(4).search(this.value).draw(); 
            console.log(this.value);
          } 
        });
      });


        $(document).ready(function(){
            $('#jenjang').on('change', function () { 
                if (!!this.value) { 
                  table.column(3).search(this.value).draw(); 
                  console.log(this.value);
                } else { 
                  table.column(3).search(this.value).draw(); 
                  console.log(this.value);
                } 
            });
         });
  }