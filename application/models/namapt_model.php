<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Namapt_model extends CI_Model {

	public function simpan ($data) {
		return $this->db->insert('namapt', $data);
	}

	public function id_terbaru () {
		//ambil id_penerimaan terakhir
		$this->db->select('id_namapt');
		$this->db->order_by('id_namapt', 'desc');
		$id_terakhir = $this->db->get('namapt', '1')->result()[0]->id_namapt;

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

	public function lihat () {
		return $this->db->get('namapt')->result();
	}
}
