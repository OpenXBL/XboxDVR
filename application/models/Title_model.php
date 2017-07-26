<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Title_model extends CI_Model {

    public function get_all()
    {
            $query = $this->db->select('*')
                              ->from('titles')
                              ->get();

            return $query->result();    
    }

    public function get_by_id($title_id)
    {
            $query = $this->db->select('*')
                              ->from('titles')
                              ->where('title_id', $title_id)
                              ->get();

            return $query->row();  
    }

    public function insert($media)
    {
            $query = $this->db->get_where('titles', array('title_id' => $media['titleId']));

            if($query->row() == null)
            {

                $this->title_id        = $media['titleId'];
                $this->name            = $media['titleName'];

                $this->db->insert('titles', $this);
            }

    }

}