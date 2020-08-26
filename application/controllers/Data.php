<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
    
    public function save()
	{
        $this->load->model('M_Data', 'data');

		$tanggal = date('Y-m-d H:i:s');

        $pakan = $this->input->get('pakan');
        $kekeruhan = $this->input->get('kekeruhan');

        // data dari M_Simpan.php
        $rekap = $this->data->ambil_data_terakhir();

        if ($rekap)
        {
            $pakan_sebelumnya = $rekap[0]["pakan"];
            $kekeruhan_sebelumnya = $rekap[0]["kekeruhan"];

            $awal  = date_create($rekap[0]['waktu']);
            $akhir = date_create(); // waktu sekarang
            $diff  = date_diff( $awal, $akhir );
            
            $hari = $diff->d;
            $jam = $diff->h;

            if ($pakan_sebelumnya == $pakan && $kekeruhan_sebelumnya == $kekeruhan)
            {
                if ($hari >= 1 || $jam >= 1)
                {
                    // Simoan ke database
                    $this->data->save();
                    $this->jadwal();
                }
                else
                {
                    $this->jadwal();
                }
            }
            else
            {
                // Simoan ke database
                $this->data->save();
                $this->jadwal();
            }
        }
        else
        {
            // Simpan ke database
            $this->data->save();
            $this->jadwal();
        }
    }
    
    public function jadwal()
    {
        $this->load->model('M_Data', 'data');

        $jam_sekarang = date('H');

        $jadwal = $this->data->ambilJadwal();

        $pagi = $jadwal[0]['pagi'];
        $siang = $jadwal[0]['siang'];
        $sore = $jadwal[0]['sore'];

        if ($pagi == $jam_sekarang)
        {
            $a_pagi = 1;
        }
        else
        {
            $a_pagi = 0;
        }
        if ($siang == $jam_sekarang)
        {
            $a_siang = 1;
        }
        else
        {
            $a_siang = 0;
        }
        if ($sore == $jam_sekarang)
        {
            $a_sore = 1;
        }
        else
        {
            $a_sore = 0;
        }

        echo $a_pagi.$a_siang.$a_sore;

        // $data = [
        //     "pagi" => $a_pagi,
        //     "siang" => $a_siang,
        //     "sore" => $a_sore
        // ];

        // echo json_encode($data);

    }

}