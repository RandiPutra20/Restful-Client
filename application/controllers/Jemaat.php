<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jemaat extends CI_Controller {

	function index()
	{
		$this->load->view('jemaat_view');
	}

	function action()
	{
		if($this->input->post('data_action'))
		{
			$data_action = $this->input->post('data_action');

			if($data_action == "Delete")
			{
				$api_url = "http://localhost/restclient/api/delete";

				$form_data = array(
					'id_jemaat'		=>	$this->input->post('id_jemaat')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;




			}

			if($data_action == "Edit")
			{
				$api_url = "http://localhost/restclient/api/update";

				$form_data = array(
					'nama_lengkap'			=>	$this->input->post('nama_lengkap'),
					'tempat_lahir'			=>	$this->input->post('tempat_lahir'),
					'tanggal_lahir'			=>	$this->input->post('tanggal_lahir'),
					'jenis_kelamin'			=>	$this->input->post('jenis_kelamin'),
					'alamat'			=>	$this->input->post('alamat'),
					'id_jemaat'			=>	$this->input->post('id_jemaat')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;







			}

			if($data_action == "fetch_single")
			{
				$api_url = "http://localhost/restclient/api/fetch_single";

				$form_data = array(
					'id_jemaat'		=>	$this->input->post('id_jemaat')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;






			}

			if($data_action == "Insert")
			{
				$api_url = "http://localhost/restclient/api/insert";
			

				$form_data = array(
					'nama_lengkap'			=>	$this->input->post('nama_lengkap'),
					'tempat_lahir'			=>	$this->input->post('tempat_lahir'),
					'tanggal_lahir'			=>	$this->input->post('tanggal_lahir'),
					'jenis_kelamin'			=>	$this->input->post('jenis_kelamin'),
					'alamat'				=>	$this->input->post('alamat')
				);

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_POST, true);

				curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				echo $response;


			}





			if($data_action == "fetch_all")
			{
				$api_url = "http://localhost/restclient/api";

				$client = curl_init($api_url);

				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);

				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if(count($result) > 0)
				{
					foreach($result as $row)
					{
						$output .= '
						<tr>
							<td>'.$row->nama_lengkap.'</td>
							<td>'.$row->tempat_lahir.'</td>
							<td>'.$row->tanggal_lahir.'</td>
							<td>'.$row->jenis_kelamin.'</td>
							<td>'.$row->alamat.'</td>
							<td><butto type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id_jemaat.'">Edit</button></td>
							<td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id_jemaat.'">Delete</button></td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>
					';
				}

				echo $output;
			}
		}
	}
	
}

?>