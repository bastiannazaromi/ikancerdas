<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Data extends CI_Model {

	public function save()
	{
        $tanggal = date('Y-m-d H:i:s');
        $pakan = $this->input->get('pakan');
        $kekeruhan = $this->input->get('kekeruhan');

        $data = [
            "waktu" => $tanggal,
            "pakan" => $pakan,
            "kekeruhan" => $kekeruhan
        ];

        $this->db->insert('tbrekap', $data);
    }

    public function ambil_data_terakhir()
    {
        $this->db->select('*');
        $this->db->from('tbrekap');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);

        return $this->db->get()->result_array();
    }

    public function ambilJadwal()
    {
        return $this->db->get('tbjadwal')->result_array();
    }

}