<?php 
class M_Tcash extends CI_Model{
 public function __construct()
    {
        parent::__construct();
    }		
	function getoutlet($lat1, $lat2, $long1, $long2)
	{
		$query = $this->db->query('SELECT toko.nama_toko, des_toko, lat, longi, lantai, judul, deskripsi, start_promo, end_promo, gbr_promo 
				 FROM toko JOIN outlet USING ( nama_toko ) LEFT JOIN promo ON toko.nama_toko = promo.nama_toko  
				 where lat > '.$lat1.' and lat < '.$lat2.' and longi > '.$long1.' and longi < '.$long2.'');		
		return $query;	
	}	
	function getDaftarOutlet($nama_toko)
	{
		$query = $this->db->query('SELECT * from outlet where nama_toko="'.$nama_toko.'"');		
		return $query;	
	}
	
	function gettoko()
	{
		$query = $this->db->query('SELECT nama_toko from toko');		
		return $query;	
	}	
	function getdetailtoko($nama_toko)
	{
		$query = $this->db->query('SELECT * from toko where nama_toko="'.$nama_toko.'"');		
		return $query;	
	}
}
?>