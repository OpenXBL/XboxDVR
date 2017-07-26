<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Share_model extends CI_Model {

    public function get_last_ten_entries()
    {
            $query = $this->db->select('*')
                              ->from('shares')
                              ->join('players', 'players.xuid = shares.xuid')
                              ->limit(10)
                              ->get();

            return $query->result();
    }

    public function get_all()
    {
            $query = $this->db->select('*')
                              ->from('shares')
                              ->join('players', 'players.xuid = shares.xuid')
                              ->get();

            return $query->result();        
    }

    public function get_all_by_title_id($title_id)
    {
            $query = $this->db->select('*')
                              ->from('shares')
                              ->join('players', 'players.xuid = shares.xuid')
                              ->join('titles', 'titles.title_id = shares.title_id')
                              ->where('shares.title_id', $title_id)
                              ->get();

            return $query->result();        
    }

    public function get_media_by_id($id)
    {
            $query = $this->db->select('*')
                              ->from('shares')
                              ->join('players', 'players.xuid = shares.xuid')
                              ->join('titles', 'titles.title_id = shares.title_id')
                              ->where('share_id', $id)
                              ->get();

            return $query->row();
    }

    public function insert($media)
    {
            $this->xuid         = $this->session->userdata('openxbl')['xuid'];
            $this->media_id     = $this->input->post('media_id');
            $this->title_id     = $media['titleId']; 
            $this->title        = ($this->input->post('title'))?$this->input->post('title'):$media['titleName']; 
            $this->description  = $this->input->post('description'); 
            $this->media_type   = $this->input->post('type');

            $this->db->insert('shares', $this);

            return $this->db->insert_id();
    }

    public function is_shared($media_id)
    {
             $query = $this->db->select('*')
                              ->from('shares')
                              ->where('media_id', $media_id)
                              ->get();

            return $query->row();       
    }

}