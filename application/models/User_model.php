<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function data_user(){
        $this->db->from('user');
        return $this->db->get()->result_array();
    }

    public function dataUserEdit($id){
        $this->db->from('user');
        $this->db->where('id_user', $id);
        return $this->db->get()->row();
    }

    public function editDataUser($data, $id){
        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }

    public function dataUserHapus($id){
        $this->db->from('user');
        $this->db->where('id_user', $id);
        $this->db->delete();
    }

    public function dataLogUserHapus($id){
        $this->db->from('log_user');
        $this->db->where('id_log', $id);
        $this->db->delete();
    }

    public function delete_items($item_ids) {
        $this->db->where_in('id_log', $item_ids)->delete('log_user');
    }

    public function tambah_user($data){
        $dataPenggunaSebelumnya = $this->db->where('username', $data['username'])->get('user'); 
        if ($dataPenggunaSebelumnya->num_rows() > 0){
            return false;
        } else {
            $this->db->insert('user', $data);
            return true;
        }
    }

    public function log_dataUser(){
        return $this->db->get('log_user')->result_array();
    }
}