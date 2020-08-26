<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('data_login'))) {
			$this->session->set_flashdata('flash-error', 'Anda Belum Login');
			redirect('Auth','refresh');
		}

		$this->load->model('M_Rekap', 'rekap');
		$this->load->model('M_jadwal', 'jadwal');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['page'] = 'backend/dashboard';
		$data['data'] = $this->rekap->getOneData();

		if ($data['data'] == null)
		{
			$data['data'][] = [
				"id" => 0,
				"waktu" => null,
				"pakan" => 0,
				"kekeruhan" => 0
			];
		}
		
		$this->load->view('backend/index', $data);
	}

	public function profile()
	{
		$data['title'] = 'Profile';
		$data['page'] = 'backend/profile';
		$this->load->view('backend/index', $data);	
	}

	public function editProfile()
	{
		if ($this->input->post('password', true))
		{
			$data = [
	            "nama" => $this->input->post('nama', true),
	            "password" => password_hash($this->input->post('password', true), PASSWORD_DEFAULT)
	        ];
		}
		else
		{
			$data = [
	            "nama" => $this->input->post('nama', true)
	        ];
		}
		
        $this->db->where('id', $this->input->post('id', true));
        $this->db->update('tbuser', $data);

		$this->session->set_flashdata('flash-sukses', 'Profile berhasil diedit');
		redirect('Dashboard/profile');
	}

	public function rekap()
	{
		$data['title'] = 'Data Rekap';
		$data['page'] = 'backend/rekap';
		$data['rekap'] = $this->rekap->getAll();
		$this->load->view('backend/index', $data);
	}

	function grafik(){
		$data['title'] = 'Garfik';
		$data['page'] = 'backend/grafik';
		$this->load->view('backend/index', $data, false);
	}

	function get_realtime(){
		$data_tabel = $this->rekap->getGrafik();
		echo json_encode($data_tabel);
	}

	public function jadwal()
	{
		$data['title'] = 'Jadwal Pakan Ikan';
		$data['page'] = 'backend/jadwal';
		$data['jadwal'] = $this->jadwal->get();
		$this->load->view('backend/index', $data);
	}

	public function editJadwal()
	{
		$this->jadwal->editJadwal();
		$this->session->set_flashdata('flash-sukses', 'Jadwal berhasil diedit');
		redirect('Dashboard/jadwal');
	}

	public function hapusRekap($id)
	{
		$this->rekap->deleteRekap($id);
		$this->session->set_flashdata('flash-sukses', 'data berhasil dihapus');
		redirect('Dashboard/rekap');
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */