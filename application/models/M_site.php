<?php 
class M_site extends CI_Model{
 public function __construct()
    {
        parent::__construct();
    }
	function getPromo(){
		$query = $this->db->query("select * from promo");
		return $query;
	}
	function getSite($lac, $cell_id){
		$query = $this->db->query("SELECT * FROM data_cell join site using (site_id) WHERE lac =".$lac." and cellid=".$cell_id."  group by site_id");
		return $query;
	}
	
	function getJumlahUser() {
		$query = $this->db->query("select email from user where id_user = '1' ");
		/*$query = $this->db->get('user');*/
		$hasil = "asd";
		if ($query->result() != null){
			foreach ($query->result() as $row)
			   {				   
					$hasil = $row->email;
			   }			
		}
		return $hasil;
	}
	
		
	function validateuser($user_name, $password)
	{
		$hasil="";
		$query2 = $this->db->query('select * from user where email="'.$user_name.'" and password="'.$password.'"');
		if($query2->result() != null)
		{
			foreach ($query2->result() as $row)
			   {				   
					$hasil = $row->level;						
			   }
		}else
		{
			$hasil = "gagal";		
		}	
		return $hasil;	
	}
	function insert_laporan($id_lap, $site_id, $username, $tanggal, $foto, $foto2, $foto3, $foto4, $sn2, $sn3, $sn4, $dl2, $dl3, $dl4, $catatan) {
		$this->db->query("insert into laporan values('".$id_lap."','".$site_id."','".$username."','".$tanggal."','".$foto."','".$foto2."','".$foto3."','".$foto4."',".$sn2.",".$sn3.",".$sn4.",".$dl2.",".$dl3.",".$dl4.",'".$catatan."') ");		
	}
	function getLaporan(){
		$query = $this->db->query("SELECT * FROM laporan ORDER BY tanggal desc LIMIT 10");
		return $query;
	}
	function getNama($username){
		$query = $this->db->query("SELECT * FROM user where username ='".$username."'");
		return $query;
	}
	function selectLap($id_lap){
		$query = $this->db->query('SELECT * FROM laporan where id_laporan="'.$id_lap.'"');
		return $query;
	}
	function getPeta($lat1, $lat2, $long1, $long2)
	{
		$query = $this->db->query('SELECT MAX(laporan.tanggal) tanggal, site.site_id, id_laporan, nama, laporan.username, foto, foto2, foto3, foto4, sinyal_2g, sinyal_3g, sinyal_4g, dl_2g, dl_3g, dl_4g, nama_site, lac, latit, longi, branch, subbranch, status, catatan  
			FROM laporan JOIN user USING (username) RIGHT JOIN site ON laporan.site_id = site.site_id 
			where latit > '.$lat1.' and latit < '.$lat2.' and longi > '.$long1.' and longi < '.$long2.' GROUP BY site_id');		
		return $query;	
	}

}
?>