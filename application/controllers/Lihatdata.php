<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lihatdata extends CI_Controller {

	public function index()
	{
        //cek input get
        $aktif = $this->input->get('aktif');

        //ambil data
        $jenis = $this->jenis_model->lihat();
        $penerimaan = $this->penerimaan_model->lihat();
        $pengeluaran = $this->pengeluaran_model->lihat();
        $stok = $this->stok_model->lihat();

        //siapkan data
        $total = [];
        foreach ($jenis as $j)
        {
            $total['unit'][$j->id_jenis] = $this->stok_model->total('unit', $j->id_jenis);
            $total['kilogram'][$j->id_jenis] = $this->stok_model->total('kilogram', $j->id_jenis);
        }
        $data = array(
            'aktif' => $aktif,
            'jenis' => $jenis,
            'penerimaan' => $penerimaan,
            'pengeluaran' => $pengeluaran,
            'stok' => $stok,
            'total' => $total
        );
		$this->load->view('lihatdata', $data);
	}

}
