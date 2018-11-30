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

        //ambil data jenis
        $jenis = $this->jenis_model->lihat($id_jenis);

		//data ditampilkan
		$data = [
			'tgl' => $tgl,
			'id_jenis' => $id_jenis,
			'jumlah' => $jumlah,
            'nama_jenis' => $jenis->nama,
		];
		$this->load->view('penerimaan-proses', $data);
	}

	public function simpan ()
	{
		//terima data
		$tgl = $this->input->post('tgl', true);
		$id_jenis = $this->input->post('id_jenis', true);
		$no_box = $this->input->post('no_box', true);
		$unit = $this->input->post('unit', true);
		$kilogram = $this->input->post('kilogram', true);

		//perulangan untuk menyimpan data
		$i = 0;
		foreach ($no_box as $n)
		{
			//susun data penerimaan
			$data_penerimaan = [
				'id_penerimaan' => $this->penerimaan_model->id_terbaru(),
				'tgl' => $tgl,
				'id_jenis' => $id_jenis,
				'no_box' => $no_box[$i],
				'unit' => $unit[$i],
				'kilogram' => $kilogram[$i],
				'status' => '0',
				'id_user' => $this->session->userdata('id_user'),
			];

			//simpan ke database penerimaan
			$this->penerimaan_model->simpan($data_penerimaan);

            //periksa apakah jenis dan no box sudah ada
            $stok = $this->stok_model->lihat($id_jenis, $no_box);

            if ($stok != null)
            {
                //tambah data stok
                $this->stok_model->tambah($id_stok, $unit[$i], $kilogram[$i]);
            }
            else
            {
                //buat data stok baru
                //susun data stok
                $data_stok = [
                    'id_stok' => $this->stok_model->id_terbaru(),
                    'id_jenis' => $id_jenis,
                    'no_box' => $no_box[$i],
                    'unit' => $unit[$i],
                    'kilogram' => $kilogram[$i],
                ];

                //simpan ke database stok
                $this->stok_model->simpan($data_stok);
            }

			$i++;
		}

		//beralih ke halaman lihatdata
        redirect('Lihatdata?aktif=penerimaan');
	}
}
