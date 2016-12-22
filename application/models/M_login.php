<?php 
class M_Login extends CI_Model{
 public function __construct()
    {
        parent::__construct();
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
	
	function loadData($user_name)
	{
		$query2 = $this->db->query('select * from user where email="'.$user_name.'"');
		if($query2->result() != null)
		{
			foreach ($query2->result() as $row)
			   {			
					$data = array(
						'username' 	=> $row->username,
						'email' 	=> $row->email,
						'unit' 		=> $row->unit,
						'level' 	=> $row->level,
						'tgl_create'=> $row->tgl_user_create,
						'zona'=> $row->zona,
					);			   
					return $data;
			   }
		}
	}
}
?>