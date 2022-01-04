<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('api_model');
		$this->load->library('form_validation');
	}

	function index()
	{
		$data = $this->api_model->fetch_all();
		echo json_encode($data->result_array());
	}

	function insert()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'nama_lengkap'			=>	$this->input->post('nama_lengkap'),
				'tempat_lahir'			=>	$this->input->post('tempat_lahir'),
				'tanggal_lahir'			=>	$this->input->post('tanggal_lahir'),
				'jenis_kelamin'			=>	$this->input->post('jenis_kelamin'),
				'alamat'				=>	$this->input->post('alamat')
			);

			$this->api_model->insert_api($data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'						=>	true,
				'nama_lengkap_error'		=>	form_error('nama_lengkap'),
				'tempat_lahir_error'		=>	form_error('tempat_lahir'),
				'tanggal_lahir_error'		=>	form_error('tanggal_lahir'),
				'jenis_kelamin_error'		=>	form_error('jenis_kelamin'),
				'alamat_error'				=>	form_error('alamat')
			);
		}
		echo json_encode($array);
	}
	
	function fetch_single()
	{
		if($this->input->post('id_jemaat'))
		{
			$data = $this->api_model->fetch_single_user($this->input->post('id_jemaat'));

			foreach($data as $row)
			{
				$output['nama_lengkap'] 	= $row['nama_lengkap'];
				$output['tempat_lahir'] 	= $row['tempat_lahir'];
				$output['tanggal_lahir'] 	= $row['tanggal_lahir'];
				$output['jenis_kelamin'] 	= $row['jenis_kelamin'];
				$output['alamat'] 			= $row['alamat'];
			}
			echo json_encode($output);
		}
	}

	function update()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'tempat_lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		if($this->form_validation->run())
		{	
			$data = array(
				'nama_lengkap'			=>	$this->input->post('nama_lengkap'),
				'tempat_lahir'			=>	$this->input->post('tempat_lahir'),
				'tanggal_lahir'			=>	$this->input->post('tanggal_lahir'),
				'jenis_kelamin'			=>	$this->input->post('jenis_kelamin'),
				'alamat'				=>	$this->input->post('alamat')
			);

			$this->api_model->update_api($this->input->post('id_jemaat'), $data);

			$array = array(
				'success'		=>	true
			);
		}
		else
		{
			$array = array(
				'error'						=>	true,
				'nama_error'				=>	form_error('nama_lengkap'),
				'tempat_lahir_error'		=>	form_error('tempat_lahir'),
				'tanggal_lahir_error'		=>	form_error('tanggal_lahir'),
				'jenis_kelamin_error'		=>	form_error('jenis_kelamin'),
				'alamat_error'				=>	form_error('alamat')
			);
		}
		echo json_encode($array);
	}

	function delete()
	{
		if($this->input->post('id_jemaat'))
		{
			if($this->api_model->delete_single_user($this->input->post('id_jemaat')))
			{
				$array = array(

					'success'	=>	true
				);
			}
			else
			{
				$array = array(
					'error'		=>	true
				);
			}
			echo json_encode($array);
		}
	}

}


?>