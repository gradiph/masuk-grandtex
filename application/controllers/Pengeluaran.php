<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function index()
	{
		//ambil data namapt
		$namapt = $this->namapt_model->lihat();
        $jenis = $this->jenis_model->lihat();

		//data ditampilkan
		$data = [
			'namapt' => $namapt,
            'jenis' => $jenis,
		];
		$this->load->view('pengeluaran', $data);
	}

	public function proses ()
	{
		//terima data form
		$tgl = $this->input->get('tgl', true);
		$id_namapt = $this->input->get('id_namapt', true);
		$id_jenis = $this->input->get('id_jenis', true);

        //ambil data
        $total_penerimaan = $this->penerimaan_model->total($id_jenis);

		//data ditampilkan
		$data = [
			'tgl' => $tgl,
			'id_namapt' => $id_namapt,
			'id_jenis' => $id_jenis,
            'total_penerimaan' => $total_penerimaan,
		];
		$this->load->view('pengeluaran-proses', $data);
	}

    public function seluruhnya ()
    {
        //terima data
		$tgl = $this->input->get('tgl', true);
		$id_namapt = $this->input->get('id_namapt', true);
		$id_jenis = $this->input->get('id_jenis', true);

        //ambil data
        $penerimaan = $this->penerimaan_model->lihat($id_jenis, $tgl);

        //data ditampilkan
		$data = [
			'tgl' => $tgl,
			'id_namapt' => $id_namapt,
			'id_jenis' => $id_jenis,
            'penerimaan' => $penerimaan,
		];
		$this->load->view('pengeluaran-proses-seluruhnya', $data);
    }

    public function sebagian ()
    {
        //terima data
		$tgl = $this->input->get('tgl', true);
		$id_namapt = $this->input->get('id_namapt', true);
		$id_jenis = $this->input->get('id_jenis', true);
		$no_box = $this->input->get('no_box', true);

        //ambil data
        $penerimaan = $this->penerimaan_model->lihat($id_jenis, $tgl, $no_box);

        //data ditampilkan
		$data = [
			'tgl' => $tgl,
			'id_namapt' => $id_namapt,
			'id_jenis' => $id_jenis,
            'penerimaan' => $penerimaan,
		];
		$this->load->view('pengeluaran-proses-sebagian', $data);
    }

	public function simpan ()
	{
		//terima data
		$tgl = $this->input->post('tgl', true);
		$id_jenis = $this->input->post('id_jenis', true);
		$id_namapt = $this->input->post('id_namapt', true);
		$no_box = $this->input->post('no_box', true);
		$unit = $this->input->post('unit', true);
		$kilogram = $this->input->post('kilogram', true);
		$id_penerimaan = $this->input->post('id_penerimaan', true);

		//perulangan untuk menyimpan data
		$i = 0;
		foreach ($no_box as $n)
		{
			//susun data pengeluaran
			$data = [
				'id_pengeluaran' => $this->pengeluaran_model->id_terbaru(),
                'id_penerimaan' => $id_penerimaan[$i],
				'tgl_pengeluaran' => $tgl,
				'id_jenis' => $id_jenis,
				'no_box' => $no_box[$i],
				'unit' => $unit[$i],
				'kilogram' => $kilogram[$i],
				'status' => NULL,
				'id_namapt' => $id_namapt,
				'id_user' => $this->session->userdata('id_user'),
			];

			//simpan ke database pengeluaran
			$this->pengeluaran_model->simpan($data);

            //kurangi data stok
            $this->stok_model->kurangi($id_jenis, $no_box[$i], $unit[$i], $kilogram[$i]);

            //ubah status penerimaan
            $this->penerimaan_model->pengeluaran($id_penerimaan[$i]);

			$i++;
		}

		//beralih ke halaman lihatdata
        redirect('Lihatdata?aktif=pengeluaran');
	}
}
