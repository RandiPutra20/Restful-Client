<?php
class Api_model extends CI_Model
{
	function fetch_all()
	{
		$this->db->order_by('id_jemaat', 'ASC');
		return $this->db->get('jemaat');
	}

	function insert_api($data)
	{
		$this->db->insert('jemaat', $data);
	}

	function fetch_single_user($user_id)
	{
		$this->db->where('id_jemaat', $user_id);
		$query = $this->db->get('jemaat');
		return $query->result_array();
	}

	function update_api($user_id, $data)
	{
		$this->db->where('id_jemaat', $user_id);
		$this->db->update('jemaat', $data);
	}

	function delete_single_user($user_id)
	{
		$this->db->where('id_jemaat', $user_id);
		$this->db->delete('jemaat');
		if($this->db->affected_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>