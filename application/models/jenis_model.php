<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model {

	public function lihat () {
		return $this->db->get('jenis')->result();
	}
}
