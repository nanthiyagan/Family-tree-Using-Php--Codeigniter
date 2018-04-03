<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class familytree_m extends CI_Model {

    var $table = 'familytree';
    // var $column_order = array(null, 'employee_name','employee_salary','employee_age'); //set column field database for datatable orderable
    //var $column_search = array('employee_name','employee_salary','employee_age'); //set column field database for datatable searchable
    var $order = array('id' => 'asc'); // default order

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function get_node($limit, $start, $id=0)
    {
        if(empty($id)){
            $this->db->limit($limit, $start);
            $query = $this->db->get('familytree');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        } else {
            $query = $this->db->get_where('familytree', array('id' => $id));
            return $query->row_array();
        }

    }

    function getAll()
    {
        $query = $this->db->query('SELECT * FROM familytree');
        return $query->result();
    }
    public function saveNode($id = 0,$file_name)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'id' => $id,
            'place_of_stay' => $this->input->post('place_of_stay'),
            'contact_no' => $this->input->post('contact_no'),
            'alt_contact_no' => $this->input->post('alt_contact_no'),
            'email' => $this->input->post('email'),
            'alive_status' => $this->input->post('alive_status'),
            'spouse_details' => $this->input->post('spouse_details'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'gender' => $this->input->post('gender'),
            'parent_id' => $this->input->post('parent_id'),
            'profile_image_localtion'=>$file_name
        );

        if ($id == 0) {
            return $this->db->insert('familytree', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('familytree', $data);
        }
    }
    public function record_count() {
        return $this->db->count_all("familytree");
    }
    public function delete_node($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('familytree');
    }
}