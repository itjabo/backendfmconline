<?php 
class M_promo extends CI_Model{
 public function __construct()
    {
        parent::__construct();
    }
	function getPromo(){
		$query = $this->db->query("select * from promo");
		return $query;
	}
	function getPromoToko($nama_toko){
		$query = $this->db->query("select * from promo where nama_toko='".$nama_toko."'");
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

}
?>