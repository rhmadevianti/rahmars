<?php
class Pendaftaran_model extends CI_Model {
    public function insert($data) {
        return $this->db->insert('pendaftaran', $data);
    }
}
