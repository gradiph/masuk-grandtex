<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_model extends CI_Model {

	public function simpan ($data) {
		return $this->db->insert('penerimaan', $data);
	}

	public function id_terbaru () {
		//ambil id_penerimaan terakhir
		$this->db->select('id_penerimaan');
		$this->db->order_by('id_penerimaan', 'desc');
		$id_terakhir = $this->db->get('penerimaan', '1')->result()[0]->id_penerimaan;

		//ambil nomor urut dari id_penerimaan
		if($id_terakhir != NULL)
		{
			$no_akhir = (int)substr($id_terakhir, 1);
			$no_baru = sprintf("%04d", $no_akhir + 1);
		}
		else
		{
			$no_baru = '0001';
		}

		return 'T' . $no_baru;
	}
}
