<?php 
class M_Loginhp extends CI_Model{
 public function __construct()
    {
        parent::__construct();
    }
	
		
	function validateuser($user_name, $password)
	{
		$hasil="";		
		$query2 = $this->db->query('select * from user where username="'.$user_name.'" and password="'.$password.'"');
		if($query2->result() != null)
		{
			foreach ($query2->result() as $row)
			   {				   
					$hasil = $row->nama;						
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