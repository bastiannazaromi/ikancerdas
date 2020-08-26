<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jadwal extends CI_Model {

	public function get()
	{
        return $this->db->get('tbjadwal')->result_array();
    }
    
    public function editJadwal()
    {
        $data = [
            "pagi" => $this->input->post('pagi', true),
            "siang" => $this->input->post('siang', true),
            "sore" => $this->input->post('sore', true)
        ];
        $this->db->where('id', 1);
        $this->db->update('tbjadwal', $data);
    }

}