<?php
class M_user extends CI_Model{
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
	
	function loadUser(){
		$query = $this->db->query("select * from user order by tgl_user_create desc");
		return $query;
	}
	
	function insertUser($nama, $username, $password, $unit, $level,$zona){
		$query = $this->db->query("insert into user values('','".$nama."','".$password."','".$username."', '".$unit."', '".$level."', '".date('Y-m-d')."','".$zona."')");
		/* $data = array(
		'id_user' 	=> '',
        'username' 	=> $username,
        'password' 	=> $password,
		'email'		=> $username.'@mail.com',
        'unit' 		=> $unit,
        'level' 	=> $level,
        'tgl_user_create' => ''.date('Y-m-d'),
		);

		$this->db->insert('user', $data); */
	}
	
	function getpass($email) {
		$query = $this->db->query("select password from user where email='".$email."' ");
		return $query;
	}
	
	function updatepassword($email,$pass) {
		$this->db->query("update user set password='".$pass."' where email='".$email."' ");
	}
	function deleteUser($id_user){
		$this->db->query("DELETE FROM user WHERE id_user=".$id_user."");
	}	

}
?>