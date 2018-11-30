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

	public function lihat ($id_jenis = null, $tgl = null, $no_box = null) {
        $this->db->select('id_penerimaan, tgl, no_box, unit, kilogram, status, jenis.nama as nama_jenis, username as nama_user');
        $this->db->from('penerimaan');
        $this->db->join('jenis', 'jenis.id_jenis = penerimaan.id_jenis');
        $this->db->join('user', 'user.id_user = penerimaan.id_user');
        if ($id_jenis != null)
        {
            $this->db->where('penerimaan.id_jenis', $id_jenis);
        }
        if ($tgl != null)
        {
            $this->db->where('tgl', $tgl);
        }
        if ($no_box != null)
        {
            $this->db->where('no_box', $no_box);
        }
		return $this->db->get()->result();
	}

    public function total ($id_jenis = null, $tgl = null) {
        if ($id_jenis == null)
        {
            $this->db->select('penerimaan.id_jenis, penerimaan.tgl as tgl, jenis.nama as nama_jenis, sum(penerimaan.unit) as total_unit, sum(penerimaan.kilogram) as total_kilogram');
        }
        else
        {
            $this->db->select('penerimaan.tgl, penerimaan.no_box');
        }
        $this->db->from('penerimaan');
        $this->db->join('jenis', 'jenis.id_jenis = penerimaan.id_jenis');
        if ($id_jenis != null)
        {
            $this->db->where('penerimaan.id_jenis', $id_jenis);
        }
        if ($tgl != null)
        {
            $this->db->where('tgl', $tgl);
        }
        $this->db->group_by(array('penerimaan.id_jenis', 'tgl'));
        return $this->db->get()->result();
    }

    public function pengeluaran ($id_penerimaan) {
        $this->db->set('status', '1');
        $this->db->where('id_penerimaan', $id_penerimaan);
        $this->db->update('penerimaan');
    }
}
