<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model {

	public function simpan ($data) {
		return $this->db->insert('pengeluaran', $data);
	}

	public function id_terbaru () {
		//ambil id_pengeluaran terakhir
		$this->db->select('id_pengeluaran');
		$this->db->order_by('id_pengeluaran', 'desc');
		$id_terakhir = $this->db->get('pengeluaran', '1')->result()[0]->id_pengeluaran;

		//ambil nomor urut dari id_pengeluaran
		if($id_terakhir != NULL)
		{
			$no_akhir = (int)substr($id_terakhir, 1);
			$no_baru = sprintf("%04d", $no_akhir + 1);
		}
		else
		{
			$no_baru = '0001';
		}

		return 'K' . $no_baru;
	}

	public function lihat () {
        $this->db->select('pengeluaran.*, jenis.nama as nama_jenis, user.username as nama_user, namapt.namapt as nama_pt');
        $this->db->from('pengeluaran');
        $this->db->join('jenis', 'jenis.id_jenis = pengeluaran.id_jenis');
        $this->db->join('user', 'user.id_user = pengeluaran.id_user');
        $this->db->join('namapt', 'namapt.id_namapt = pengeluaran.id_namapt');
		return $this->db->get()->result();
	}
}
