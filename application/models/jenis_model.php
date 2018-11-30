<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model {

	public function lihat ($id_jenis = null) {
        if ($id_jenis == null)
        {
            return $this->db->get('jenis')->result();
        }
        else
        {
            return $this->db->get_where('jenis', array('id_jenis' => $id_jenis))->result()[0];
        }
	}
}
