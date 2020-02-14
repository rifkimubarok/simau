
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class graf_lib
{
	 private $CI;

   function __construct() {
       $this->CI =& get_instance();
   }

	public function pendaftar_sekolah($asalSekolah){
		$sql =	"select COUNT(a.pilihan1) as Jumlah, b.code as pilihan1 from daftar a right join ref_keahlian b on a.pilihan1 = b.code and a.asal_sekolah = '$asalSekolah' group by b.code";
		$data = $this->CI->db->query($sql);
		return $data->result();
	}
	
}
?>