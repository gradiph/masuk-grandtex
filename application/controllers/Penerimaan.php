<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends CI_Controller {

	public function index()
	{
		//ambil data jenis
		$jenis = $this->jenis_model->lihat();

		//data ditampilkan
		$data = [
			'jenis' => $jenis,
		];
		$this->load->view('penerimaan', $data);
	}

	public function proses ()
	{
		//terima data form
		$tgl = $this->input->get('tgl', true);
		$id_jenis = $this->input->get('id_jenis', true);
		$jumlah = $this->input->get('jumlah', true);

		//data ditampilkan
		$data = [
			'tgl' => $tgl,
			'id_jenis' => $id_jenis,
			'jumlah' => $jumlah,
		];
		$this->load->view('penerimaan-proses', $data);
	}

	public function simpan ()
	{
		//terima data
		$tgl = $this->input->post('tgl', true);
		$id_jenis = $this->input->post('id_jenis', true);
		$nomor = $this->input->post('nomor', true);
		$unit = $this->input->post('unit', true);
		$kilogram = $this->input->post('kilogram', true);

		//perulangan untuk menyimpan data
		$i = 0;
		foreach ($nomor as $n)
		{
			//susun data
			$data = [
				'id_penerimaan' => $this->penerimaan_model->id_terbaru(),
				'tgl' => $tgl,
				'id_jenis' => $id_jenis,
				'nomor' => $nomor[$i],
				'unit' => $unit[$i],
				'kilogram' => $kilogram[$i],
				'status' => '0',
				'id_user' => $this->session->userdata('id_user'),
			];

			//simpan ke database
			$this->penerimaan_model->simpan($data);

			$i++;
		}

		//beralih ke halaman lihatdata

	}
}
