<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_model extends CI_Model {

	public function simpan ($data) {
		return $this->db->insert('stok', $data);
	}

	public function id_terbaru () {
		//ambil id_stok terakhir
		$this->db->select('id_stok');
		$this->db->order_by('id_stok', 'desc');
		$id_terakhir = $this->db->get('stok', '1')->result()[0]->id_stok;

		//ambil nomor urut dari id_stok
		if($id_terakhir != NULL)
		{
			$no_akhir = (int)substr($id_terakhir, 1);
			$no_baru = sprintf("%04d", $no_akhir + 1);
		}
		else
		{
			$no_baru = '0001';
		}

		return 'S' . $no_baru;
	}

    public function lihat () {
        $this->db->select('stok.*, jenis.nama as nama_jenis');
        $this->db->from('stok');
        $this->db->join('jenis', 'jenis.id_jenis = stok.id_jenis');
        return $this->db->get()->result();
    }

    public function total ($kolom, $id_jenis) {
        $this->db->select('sum('.$kolom.') as total');
        $this->db->from('stok');
        $this->db->where('id_jenis', $id_jenis);
        return $this->db->get()->result()[0]->total;
    }

    public function tambah ($id_stok, $unit, $kilogram) {
        $this->db->set('unit', 'unit + '.$unit, false);
        $this->db->set('kilogram', 'kilogram + '.$kilogram, false);
        $this->db->where('id_stok', $id_stok);
        $this->db->update('stok');
    }

    public function kurangi ($id_jenis, $no_box, $unit, $kilogram) {
        $this->db->set('unit', 'unit - '.$unit, false);
        $this->db->set('kilogram', 'kilogram - '.$kilogram, false);
        $this->db->where('id_jenis', $id_jenis);
        $this->db->where('no_box', $no_box);
        $this->db->update('stok');
    }
}
